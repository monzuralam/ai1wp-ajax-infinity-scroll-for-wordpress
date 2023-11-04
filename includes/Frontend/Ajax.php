<?php
namespace Aaisfw\Frontend;

use WP_Query;

class Ajax{
    /**
     * Constructor
     */
    public function __construct(){
        add_action( 'wp_ajax_infinity_scroll', [$this, 'aaisfw_infinity_scroll_content'] );
        add_action( 'wp_ajax_nopriv_infinity_scroll', [$this, 'aaisfw_infinity_scroll_content'] );
    }

    /**
     * Ajax loaded content
     */
    function aaisfw_infinity_scroll_content(){
        $args = array(
            'post_type'     =>  'post',
            'post_per_page' =>  get_option('posts_per_page'),
            'post_status'   =>  'publish',
            'paged'         =>  $_POST['page'] + 1
        );

        $query = new WP_Query( $args );
        
        if( $query->have_posts() ){
            while( $query->have_posts() ){
                $query->the_post();
                ?>
                    <div class="aaisfw_item">
                        <h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
                        <?php the_post_thumbnail(); ?>
                        <p><?php the_excerpt(); ?></p>
                    </div>
                <?php
            }
        }
        wp_reset_postdata();
        wp_die();
    }
}