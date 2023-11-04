<?php
namespace Aaisfw;

/**
 * Frontend Class
 */
class Frontend{
    /**
     * initialize the class
     */
    public function __construct(){
        new \Aaisfw\Frontend\Shortcode();
        add_action( 'wp_enqueue_scripts', [$this, 'aaisfw_assets'] );
    }

    /**
     * Assets
     */
    public function aaisfw_assets(){
        global $wp_query;
        wp_register_style('aaisfw-main', AAISFW_ASSETS . '/css/aaisfw.css' );
        wp_register_script('aaisfw-main', AAISFW_ASSETS . '/js/main.js', array('jquery'), time(), true );
        wp_localize_script('aaisfw-main', 'aaisfw_data', array(
            'ajaxurl'       =>  admin_url('admin-ajax.php'),
            'posts'         =>  json_encode($wp_query->query_vars),
            'current_page'  =>  get_query_var('paged') ? get_query_var( 'paged' ) : 1,
            'max_page'      =>  $wp_query->max_num_pages
        ));
    }
}