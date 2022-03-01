<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment', 'embed'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__.'\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    collect(['get_header', 'wp_head'])->each(function ($tag) {
        ob_start();
        do_action($tag);
        $output = ob_get_clean();
        remove_all_actions($tag);
        add_action($tag, function () use ($output) {
            echo $output;
        });
    });
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory().'/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Render comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );

    $data = collect(get_body_class())->reduce(function ($data, $class) use ($comments_template) {
        return apply_filters("sage/template/{$class}/data", $data, $comments_template);
    }, []);

    $theme_template = locate_template(["views/{$comments_template}", $comments_template]);

    if ($theme_template) {
        echo template($theme_template, $data);
        return get_stylesheet_directory().'/index.php';
    }

    return $comments_template;
}, 100);

add_filter( 'the_title', function( $title ) { return '<strong>' . (count(wp_get_post_terms(get_the_ID(), 'state')) > 1 ? 'National - ' : '') . $title . '</strong>'; } );

/**
 * Register the 'State' taxonomy
 */
add_action('init', function() {

    $labels = array(
        'name' => _x('State', 'taxonomy general name', 'prepsports-func'),
        'singular_name' => _x('state', 'taxonomy singular name', 'prepsports-func'),
        'search_items' => __('Search State', 'prepsports-func'),
        'all_items' => __('All State', 'prepsports-func'),
        'parent_item' => __('Parent State', 'prepsports-func'),
        'parent_item_colon' => __('Parent State:', 'prepsports-func'),
        'edit_item' => __('Edit State', 'prepsports-func'),
        'update_item' => __('Update State', 'prepsports-func'),
        'add_new_item' => __('Add New State', 'prepsports-func'),
        'new_item_name' => __('New State Name', 'prepsports-func'),
        'menu_name' => __('States', 'prepsports-func'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'state'),
    );

    register_taxonomy('state', 'post', $args);
});

/**
 * Create aggregator pages
 */
add_action('init', function() {

    $existing_page = get_page_by_title('Post Aggregator', 'OBJECT', 'page');

    if (empty($existing_page)) {
        $page = wp_insert_post(
            array(
            'comment_status' => 'close',
            'ping_status'    => 'close',
            'post_author'    => 1,
            'post_title'     => 'Post Aggregator',
            'post_name'      => 'post-aggregator',
            'post_status'    => 'publish',
            'post_type'      => 'page',
            )
        );

        add_post_meta($page, '_wp_page_template', 'views/template-post-aggregator.blade.php', true);
    }

    $existing_page = get_page_by_title('Event Aggregator', 'OBJECT', 'page');

    if (empty($existing_page)) {
        $page = wp_insert_post(
            array(
            'comment_status' => 'close',
            'ping_status'    => 'close',
            'post_author'    => 1,
            'post_title'     => 'Event Aggregator',
            'post_name'      => 'event-aggregator',
            'post_status'    => 'publish',
            'post_type'      => 'page',
            )
        );

        add_post_meta($page, '_wp_page_template', 'views/template-event-aggregator.blade.php', true);
    }
});
