<?php



if ( ! function_exists( 'cb_is_woocommerce' ) ) :
function cb_is_woocommerce() {

    if ( class_exists( 'Woocommerce' )  && ( ( is_woocommerce() ) || is_product() || ( is_cart() ) || ( is_account_page() ) || ( is_order_received_page() ) || ( is_checkout() ) ) ) {
        return true;
    }
       
    return false;
}
endif;

if ( ! function_exists( 'cb_woocommerce_theme_support' ) ) :
function cb_woocommerce_theme_support() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
endif;
add_action( 'after_setup_theme', 'cb_woocommerce_theme_support' );

/*********************
WooCommerce
*********************/
function woocommerce_get_sidebar() {}
if ( class_exists('Woocommerce') ) {

    if ( ! function_exists( 'cb_woocommerce_show_page_title' ) ) {

        function cb_woocommerce_show_page_title() {
           return false;
        }
    }
    add_filter( 'woocommerce_show_page_title', 'cb_woocommerce_show_page_title' );

    if ( ! function_exists( 'cb_Woocommerce_pagi' ) ) {

        function cb_Woocommerce_pagi() {

           return  array(
                'prev_text'     => '<i class="fa fa-long-arrow-left"></i>',
                'next_text'     => '<i class="fa fa-long-arrow-right"></i>',
                'type'         => 'list',
            );
        }
    }
    add_filter( 'woocommerce_pagination_args', 'cb_Woocommerce_pagi' );

    if ( ! function_exists( 'cb_woocommerce_loop_count' ) ) {
        function cb_woocommerce_loop_count() {
            if ( ot_get_option('cb_woocommerce_sidebar', NULL ) == 'nosidebar' ) {
                return 4;
            } else {
                return 3;
            }

        }
    }
    add_filter( 'loop_shop_columns', 'cb_woocommerce_loop_count' );

    if ( ! function_exists( 'cb_add_cart_loop' ) ) {
        function cb_add_cart_loop(){
            remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
        }
    }

    add_action('init','cb_add_cart_loop');

    if ( ! function_exists( 'cb_row_number' ) ) {
        function cb_row_number() {

            $cb_woocommerce_sidebar = ot_get_option('cb_woocommerce_sidebar', 'sidebar');
            $cb_woocommerce_sidebar_override = ot_get_option('cb_woocommerce_sidebar_override', 'cb_off');

            if ( ( ( $cb_woocommerce_sidebar_override == 'cb_no_shop' ) && ( is_shop() == true ) ) || ( $cb_woocommerce_sidebar == 'nosidebar' ) ) {
                 $cb_woo_per_row = 4;
            } else {
                $cb_woo_per_row = 3;
            }

            return $cb_woo_per_row;
        }
    }

    add_filter('loop_shop_columns', 'cb_row_number');

    if ( ! function_exists( 'cb_woocommerce_return_false' ) ) {
        function cb_woocommerce_return_false() {
            return false;
        }
    }

    add_filter( 'woocommerce_show_page_title', 'cb_woocommerce_return_false' );

    if ( ! function_exists( 'woocommerce_output_related_products' ) ) {
        function woocommerce_output_related_products() {
            woocommerce_related_products( array( 'posts_per_page' => 3, 'columns' => 3 ), 3 );

        }
    }

    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

    add_action('woocommerce_before_main_content', 'cb_woo_start_wrap', 10);
    add_action('woocommerce_after_main_content', 'cb_woo_end_wrap', 10);

    if ( ! function_exists( 'cb_woo_title' ) ) {

        function cb_woo_title() {
           $cb_output = '<div class="cb-cat-header cb-woocommerce-page"><h1 id="cb-cat-title">';
            if ( is_shop() ) {
                $cb_output .= woocommerce_page_title( false );
            } elseif ( ( is_product_category() ) || ( is_product_tag() ) ) {
                global $wp_query;
                $cb_current_object = $wp_query->get_queried_object();
                $cb_output .= $cb_current_object->name;

            } else {
                $cb_output .= get_the_title();
            }
            $cb_output .= '</h1></div>';

            echo $cb_output;
        }
    }
    if ( ! function_exists( 'cb_woo_breadcrumbs' ) ) {
        function cb_woo_breadcrumbs() {
            $cb_icon = '<i class="fa fa-angle-right"></i>';
            return array(
                        'delimiter'   =>  $cb_icon,
                        'wrap_before' => '<div class="cb-breadcrumbs " ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>',
                        'wrap_after'  => '</div>',
                        'before'      => '',
                        'after'       => '',
                        'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
                     );
        }
    }
    add_filter('woocommerce_breadcrumb_defaults' , 'cb_woo_breadcrumbs');
}

if ( ! function_exists( 'cb_woo_start_wrap' ) ) :
function cb_woo_start_wrap() {

    echo '<div id="cb-content" class="wrap clearfix">';
    cb_woo_title();
    woocommerce_breadcrumb();
    echo '<div id="main" class="cb-main clearfix">';

}
endif;

if ( ! function_exists( 'cb_woo_end_wrap' ) ) :
function cb_woo_end_wrap() {
    echo '</div> <!-- end #main -->';
    $cb_woocommerce_sidebar_override = false;
    if ( is_shop() ) {
        if ( ot_get_option('cb_woocommerce_sidebar_override', 'sidebar') == 'cb_no_shop' ) {
            $cb_woocommerce_sidebar_override = true;

        }
    }

    if ( is_product() ) {
        if ( ot_get_option('cb_woocommerce_sidebar_override', 'sidebar') == 'cb_no_posts' ) {
            $cb_woocommerce_sidebar_override = true;

        }
    }

    if ( ( $cb_woocommerce_sidebar_override == false ) && ( ot_get_option( 'cb_woocommerce_sidebar', 'sidebar' ) != 'nosidebar' )) { get_sidebar(); }
    echo '</div><!-- end #cb-content -->';
}
endif;
add_action('sensei_before_main_content', 'cb_woo_start_wrap', 10);
add_action('sensei_after_main_content', 'cb_woo_end_wrap', 10);