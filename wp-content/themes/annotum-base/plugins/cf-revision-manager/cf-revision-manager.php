<?php
/*
Plugin Name: CF Revision Manager
Plugin URI: http://crowdfavorite.com
Description: Revision management functionality so that plugins can add metadata to revisions as well as restore that metadata from revisions
Version: 1.0.1
Author: Crowd Favorite
Author URI: http://crowdfavorite.com
*/

if (!class_exists('cf_revisions')) {

load_plugin_textdomain('cfrm');

define('CF_REVISIONS_DEBUG', false);

function cfr_register_metadata($postmeta_key, $display_func = '') {
	static $cfr;
	if (empty($cfr)) {
		$cfr = cf_revisions::get_instance();
	}
	return $cfr->register($postmeta_key, $display_func);
}

class cf_revisions {
	private static $_instance;
	protected $postmeta_keys = array();
	protected $prefix = 'cfrm';

	public function __construct() {
		# save & restore
		add_action('wp_insert_post', array($this, 'save_post_revision'), 1, 2);
		add_action('wp_restore_post_revision', array($this, 'restore_post_revision'), 10, 2);
		add_action('wp_save_post_revision_check_for_changes', array($this, 'check_for_changes'), 10, 3);
		add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));


		if (is_admin()) {
			# revision display
			global $pagenow;
			if ($pagenow == 'revision.php' ||  ('admin-ajax.php' && isset($_REQUEST['action']) && $_REQUEST['action'] == 'get-revision-diffs')) {
				add_filter('_wp_post_revision_fields', array($this, 'post_revision_fields'), 10, 1);
			}
		}
	}

	public function register($postmeta_key, $display = 'deprecated') {
		if (!in_array($postmeta_key, $this->postmeta_keys, true)) {
			$this->postmeta_keys[] = $postmeta_key;
			add_filter('_wp_post_revision_field_'.$this->prefix.$postmeta_key, array($this, 'post_revision_field'), 1, 4);
		}
		return true;
	}

	public function enqueue_scripts() {
		if (file_exists(trailingslashit(WP_PLUGIN_DIR).basename(__DIR__).'/autosave.js')) {
			$path = trailingslashit(plugin_dir_url(__FILE__)).'autosave.js';
		}
		else if (file_exists(trailingslashit(get_template_directory()).'plugins/'.basename(__DIR__).'/autosave.js')) {
			$path = trailingslashit(get_template_directory_uri()).'plugins/'.basename(__DIR__).'/autosave.js';
		}
		$path = apply_filters('cfrm_js_path', $path, __DIR__);

		wp_enqueue_script('cfrm-autosave', $path, array('autosave', 'jquery'));
		$cfrm = array(
			'prefix' => apply_filters('cfrm_prefix', '_'),
			'selector' => apply_filters('cfrm_selector', ''),
		);

		wp_localize_script('cfrm-autosave', 'cfrm', $cfrm);

	}

	/**
	 * This is a paranoid check. There will be no object to register the
	 * actions and filters if nobody adds any postmeta to be handled
	 *
	 * @return bool
	 */
	public function have_keys() {
		return (bool) count($this->postmeta_keys);
	}

	/**
	 * Save the revision data
	 *
	 * @param int $post_id
	 * @param object $post
	 * @return void
	 */
	public function save_post_revision($post_id, $post) {
		if ($post->post_type != 'revision' || !$this->have_keys()) {
			return false;
		}

		// revision generated by insert post
		foreach ($this->postmeta_keys as $meta_key) {
			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
				// Dont update if not set.
				$postmeta_values = isset($_POST['cfrm_meta'][$meta_key]) ? (array) $_POST['cfrm_meta'][$meta_key] : false;
			}
			else {
				$postmeta_values = get_post_meta($post->post_parent, $meta_key);
			}

			if ($postmeta_values) {
				foreach ($postmeta_values as $postmeta_value) {
					update_metadata('post', $post_id, $meta_key, $postmeta_value);
					$this->log('Added postmeta for: '.$meta_key.' to revision: '.$post_id.' from post: '.$post->post_parent.
					' '.$postmeta_value);
				}

			}
		}
	}

	/**
	 * Revert the revision data
	 *
	 * @param int $post_id
	 * @param int $revision_id
	 * @return void
	 */
	public function restore_post_revision($post_id, $revision_id) {
		if (!$this->have_keys()) {
			return false;
		}
		foreach ($this->postmeta_keys as $postmeta_type) {
			$postmeta_key = $postmeta_type;
			delete_metadata('post', $post_id, $postmeta_key);
			$postmeta_values = get_metadata('post', $revision_id, $postmeta_key);
			if ($postmeta_values !== false && is_array($postmeta_values)) {
				foreach ($postmeta_values as $postmeta_value) {
					$this->log('Setting postmeta: '.$postmeta_key.' for post: '.$post_id);
					add_metadata('post', $post_id, $postmeta_key, $postmeta_value, true);
				}
				$this->log('Restored post_id: '.$post_id.' metadata from: '.$postmeta_key);
			}
		}

		// A post revision gets saved when the post is restored, but its before the tracked meta keys are restored
		// Thus we need to resave the keys on the latest revision here
		$revision_query = new WP_Query(array(
			'post_type' => 'revision',
			'post_status' => 'inherit',
			'post_parent' => $post_id,
			'posts_per_page' => 1,
			'cache_results' => false,
			'fields' => 'ids',
			'order' => 'DESC',
		));
		if (!empty($revision_query->posts)) {
			$latest_revision_id = $revision_query->posts[0];
			$latest_revision = get_post($latest_revision_id);
			if ($latest_revision) {
				$this->save_post_revision($latest_revision_id, $latest_revision);
			}
		}

	}

	public function post_revision_fields($fields) {
		$name_base = apply_filters('cfrm_compare_header', __('Post Meta: ', 'cfrm'));
		foreach ($this->postmeta_keys as $key) {
			$fields[$this->prefix.$key] = apply_filters('cfrm_compare_header_'.$key, $name_base.$key, $key);
		}
		return $fields;
	}

	public function post_revision_field($field_id, $field, $comparison_post, $type) {
		// remove prefix
		if (substr($field, 0, strlen($this->prefix)) == $this->prefix) {

			$key = substr($field, strlen($this->prefix));
		}
		else {
			return '';
		}
		if (in_array($key, $this->postmeta_keys)) {
			$html = print_r(get_post_meta($comparison_post->ID, $key, true),1). "\n";
		}
		return $html;
	}

	// Check for changes refers to WP Core doing the check, thus returning false forces a revision to be saved
	//
	public function check_for_changes($true_false, $last_revision, $post) {

		if ($this->have_keys()) {
			foreach ($this->postmeta_keys as $meta_key) {
				$old_data = get_post_meta($last_revision->ID, $meta_key);
				$current_data = get_post_meta($post->ID, $meta_key, true);
				if (serialize($old_data) != serialize($current_data)) {
					$true_false = false;
				}
			}
		}
		return $true_false;
	}

	/**
	 * Singleton
	 *
	 * @return object
	 */
	public function get_instance() {
		if (!(self::$_instance instanceof cf_revisions)) {
			self::$_instance = new cf_revisions;
		}
		return self::$_instance;
	}

	protected function log($message) {
		if (CF_REVISIONS_DEBUG) {
			error_log($message);
		}
	}
}

if (defined('CF_REVISIONS_DEBUG') && CF_REVISIONS_DEBUG) {
	include('tests.php');
}
}
