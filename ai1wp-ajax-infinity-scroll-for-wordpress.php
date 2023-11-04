<?php

/**
 * Plugin Name: Ai1wp Ajax Inifity Scroll for WordPress
 * Description: Load post on ajax infinity scroll in WordPress.
 * Plugin URI:  #
 * Version:     1.0.0
 * Author:      Monzur Alam
 * Author URI:  https://profiles.wordpress.org/monzuralam
 * Text Domain: aaisfw
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

final class Ai1wp_Ajax_Infinity_Scroll_for_WordPress {
    /**
     * Constructor
     */
    public function __construct() {
        $this->aaisfw_constant();
        add_action( 'plugins_loaded', [ $this, 'init_plugin'] );
        add_action( 'init', [ $this, 'ajax_request'] );
    }

    /**
     * Initializes a singleton instance
     */
    public static function init(){
        static $instance = false;

        if( ! $instance ){
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Constants
     */
    public function aaisfw_constant() {
        define('AAISFW_FILE', __FILE__);
        define('AAISFW_PATH', plugin_dir_path(AAISFW_FILE));
        define('AAISFW_URL', plugins_url('', AAISFW_FILE));
        define('AAISFW_ASSETS', AAISFW_URL . '/assets');
    }

    /**
     * Initialize the plugin
     */
    public function init_plugin(){
        if( is_admin() ){
            new \Aaisfw\Admin();
        }else{
            new \Aaisfw\Frontend();
        }
    }

    /**
     * Ajax Request handle
     */
    public function ajax_request(){
        new \Aaisfw\Frontend\Ajax();
    }

}

/**
 * Initialize main plugin
 */
function kickstart(){
    return Ai1wp_Ajax_Infinity_Scroll_for_WordPress::init();
}

// kickoff the plugin
kickstart();
