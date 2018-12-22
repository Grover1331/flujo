<?php 

/*--------------Departamento---------------*/

$labels = array(
    'name' => _x('department_category', 'Categoría de departamento'),
    'singular_name' => _x('Categoría de departamento', 'Categoría de departamento'),
    'search_items' => __('Search Categoría de departamento'),
    'all_items' => __('All Categoría de departamento'),
    'parent_item' => __('Parent Categoría de departamento'),
    'parent_item_colon' => __('Parent Categoría de departamento'),
    'edit_item' => __('Edit Categoría de departamento'),
    'update_item' => __('Update Categoría de departamento'),
    'add_new_item' => __('Add New Categoría de departamento'),
    'new_item_name' => __('New Categoría de departamento'),
    'menu_name' => __('Categoría de departamento'),
);

$args = array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'department_category'),
);

// register_taxonomy('department_category', array('department_category'), $args);
function codex_int_Departamento()
{
    $labels = array(
        'name' => 'Departamento',
        'singular_name' => 'Departamento',
        'add_new' => 'Add Departamento',
        'add_new_item' => 'Add New Departamento',
        'edit_item' => 'Edit Departamento',
        'new_item' => 'New Departamento',
        'all_items' => 'All Departamento',
        'view_item' => 'View Departamento',
        'search_items' => 'Search Departamento',
        'not_found' => 'No Departamento found',
        'not_found_in_trash' => 'No Departamento found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Departamento'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'departamento'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'taxonomies' => array('department_category'),
        
        'map_meta_cap' => true,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')
    );

    register_post_type('Departamento', $args);
}
add_action('init', 'codex_int_Departamento');
/*--------------/Departamento---------------*/
?>