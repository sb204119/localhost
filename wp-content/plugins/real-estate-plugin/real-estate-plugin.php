<?php
/*
Plugin Name: Real Estate Plugin
Description: Плагин для управления объектами недвижимости.
Version: 1.0
*/
function create_real_estate_post_type() {
    register_post_type('real_estate',
        array(
            'labels' => array(
                'name' => __('Объекты недвижимости'),
                'singular_name' => __('Объект недвижимости')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'real-estate'),
        )
    );

    register_taxonomy('district', 'real_estate',
        array(
            'label' => __('Район'),
            'rewrite' => array('slug' => 'district'),
            'hierarchical' => true,
        )
    );
}

add_action('init', 'create_real_estate_post_type');

function real_estate_filter_shortcode($atts) {
    ob_start();
    include(plugin_dir_path(__FILE__) . 'templates/filter-form.php');
    return ob_get_clean();
}

add_shortcode('real_estate_filter', 'real_estate_filter_shortcode');

function custom_real_estate_search() {

    $district = $_POST['district'];
    $page = $_POST['page'];

    $args = array(
        'post_type' => 'real_estate',
        'posts_per_page' => 3,
        'paged' => $page,
    );

    if (!empty($district)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'district',
                'field' => 'slug',
                'terms' => $district,
            ),
        );
    }

    $query = new WP_Query($args);
    $results = array();

    while ($query->have_posts()) {
        $query->the_post();
        $post_data = array(
            'title' => get_the_title(),
            'district' => get_the_terms(get_the_ID(), 'district')[0]->name,

        );
        $results[] = $post_data;
    }

    wp_reset_postdata();

    echo json_encode($results);
    die();
}

add_action('wp_ajax_custom_real_estate_search', 'custom_real_estate_search');
add_action('wp_ajax_nopriv_custom_real_estate_search', 'custom_real_estate_search');

class Real_Estate_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'real_estate_widget',
            'Real Estate Widget',
            array('description' => 'Виджет для отображения результатов поиска объектов недвижимости.')
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        echo $args['after_widget'];
    }

    public function form($instance) {

    }

    public function update($new_instance, $old_instance) {

    }
}

function register_real_estate_widget() {
    register_widget('Real_Estate_Widget');
}

add_action('widgets_init', 'register_real_estate_widget');
