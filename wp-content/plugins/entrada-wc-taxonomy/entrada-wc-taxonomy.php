<?php
/*
Plugin Name: Entrada WC Taxonomy
Plugin URI: http://waituk.com/
Description: Declares a plugin that will create custom taxonomy to WooCommerce Products.
Version: 4.0.7
Author: WAITUK
Author URI: http://waituk.com/
License: GPLv2
*/


if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

    add_action('init', 'entrada_create_product_taxnomy');
    require_once 'WDS_Class.php';
    if (!class_exists('WDS_Taxonomy_Radio')) {
        $custom_tax_mb = new WDS_Taxonomy_Radio('activity_level');
    }
} else {
    add_action('admin_notices', 'admin_notice_ewc_activation');
}

function admin_notice_ewc_activation()
{
    echo '<div class="error"><p>' . __('The <strong>Entrada WC Taxonomy</strong> plugin requires <strong>WooCommerce </strong> installed and activated.', 'showcase-visual-composer-addon') . '</p></div>';
}

function entrada_create_product_taxnomy()
{
    register_taxonomy(
        'holiday_type',
        'product',
        array(
            'hierarchical' => true,
            'label' => 'Holiday Type',  //Display name
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'holiday-type',
                'with_front' => false // Don't display the category base before
            ),
            'capabilities' => array(
                'assign_terms' => 'assign_product_terms'  // means administrator', 'editor', 'author', 'contributor'
            )
        )
    );

    register_taxonomy(
        'destination',
        'product',
        array(
            'hierarchical' => true,
            'label' => 'Destinations',  //Display name
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'destination', // This controls the base slug that will display before each term
                'with_front' => false,
                'hierarchical' => true
            ),
            'capabilities' => array(
                'assign_terms' => 'assign_product_terms'  // means administrator', 'editor', 'author', 'contributor'
            )
        )
    );

    register_taxonomy(
        'activity_level',
        'product',
        array(
            'hierarchical' => true,
            'label' => 'Activity Levels',  //Display name
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'activity-levels', // This controls the base slug that will display before each term
                'with_front' => false // Don't display the category base before
            )
        )
    );
}
