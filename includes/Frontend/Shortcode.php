<?php

namespace Aaisfw\Frontend;

use WP_Query;

class Shortcode {
    public function __construct() {
        add_shortcode('aaisfw', [$this, 'aaisfw_shortcode']);
    }

    public function aaisfw_shortcode($atts, $content=null){
        $atts = shortcode_atts(array(
            'post_type'         =>  'post',
            'posts_per_page'    =>  4
        ), $atts);
        
        ob_start();
        wp_enqueue_style('aaisfw-main');
        wp_enqueue_script('aaisfw-main');
        $args = array(
            'post_type'         =>  $atts['post_type'],
            'post_per_page'     =>  $atts['posts_per_page'],
            'post_status'       =>  'publish'
        );

        $query = new WP_Query($args);
        ?>
        <div class="aaisfw_wrapper">
        <?php
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
        ?>
        </div>
        <?php
        if( 1 < $query->max_num_pages ){
            ?>
            <div class="aaisfw_loadmore"><?php echo esc_html__( 'Load More', 'aaisfw' ); ?></div>
            <?php
        }
        return ob_get_clean();
    }
}
