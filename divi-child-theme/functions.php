<?php

/* LOADING CSS STYLESHEET FILE */
add_action('wp_enqueue_scripts', 'allwell_register_styles');

function allwell_register_styles()
{
  $parenthandle = 'divi-style';
  $theme = wp_get_theme();
  wp_enqueue_style(
    $parenthandle,
    get_template_directory_uri() . '/style.css',
    array(),
    $theme->parent()->get('Version')
  );
  wp_enqueue_style(
    'divi-child-theme-style',
    get_stylesheet_uri(),
    array($parenthandle),
    /* $theme->get('Version') */ filemtime(get_stylesheet_directory() . '/style.css')
  );
}

// remove projects post type in divi elegante themes
add_filter('et_project_posttype_args', 'mytheme_et_project_posttype_args', 10, 1);
function mytheme_et_project_posttype_args($args)
{
  return array_merge($args, array(
    'public' => false,
    'exclude_from_search' => false,
    'publicly_queryable' => false,
    'show_in_nav_menus' => false,
    'show_ui' => false
  )
  );
}

// ADDING CUSTOM POST TYPES - EVENTS

function cptui_register_my_cpts()
{

  /**
   * Post Type: Events.
   */

  $labels = [
    "name" => esc_html__("Events", "custom-post-type-ui"),
    "singular_name" => esc_html__("Event", "custom-post-type-ui"),
    "menu_name" => esc_html__("Events", "custom-post-type-ui"),
    "all_items" => esc_html__("All Events", "custom-post-type-ui"),
    "add_new" => esc_html__("Add new", "custom-post-type-ui"),
    "add_new_item" => esc_html__("Add new Event", "custom-post-type-ui"),
    "edit_item" => esc_html__("Edit Event", "custom-post-type-ui"),
    "new_item" => esc_html__("New Event", "custom-post-type-ui"),
    "view_item" => esc_html__("View Event", "custom-post-type-ui"),
    "view_items" => esc_html__("View Events", "custom-post-type-ui"),
    "search_items" => esc_html__("Search Events", "custom-post-type-ui"),
    "not_found" => esc_html__("No Events found", "custom-post-type-ui"),
    "not_found_in_trash" => esc_html__("No Events found in trash", "custom-post-type-ui"),
    "parent" => esc_html__("Parent Event:", "custom-post-type-ui"),
    "featured_image" => esc_html__("Featured image for this Event", "custom-post-type-ui"),
    "set_featured_image" => esc_html__("Set featured image for this Event", "custom-post-type-ui"),
    "remove_featured_image" => esc_html__("Remove featured image for this Event", "custom-post-type-ui"),
    "use_featured_image" => esc_html__("Use as featured image for this Event", "custom-post-type-ui"),
    "archives" => esc_html__("Event archives", "custom-post-type-ui"),
    "insert_into_item" => esc_html__("Insert into Event", "custom-post-type-ui"),
    "uploaded_to_this_item" => esc_html__("Upload to this Event", "custom-post-type-ui"),
    "filter_items_list" => esc_html__("Filter Events list", "custom-post-type-ui"),
    "items_list_navigation" => esc_html__("Events list navigation", "custom-post-type-ui"),
    "items_list" => esc_html__("Events list", "custom-post-type-ui"),
    "attributes" => esc_html__("Events attributes", "custom-post-type-ui"),
    "name_admin_bar" => esc_html__("Event", "custom-post-type-ui"),
    "item_published" => esc_html__("Event published", "custom-post-type-ui"),
    "item_published_privately" => esc_html__("Event published privately.", "custom-post-type-ui"),
    "item_reverted_to_draft" => esc_html__("Event reverted to draft.", "custom-post-type-ui"),
    "item_scheduled" => esc_html__("Event scheduled", "custom-post-type-ui"),
    "item_updated" => esc_html__("Event updated.", "custom-post-type-ui"),
    "parent_item_colon" => esc_html__("Parent Event:", "custom-post-type-ui"),
  ];

  $args = [
    "label" => esc_html__("Events", "custom-post-type-ui"),
    "labels" => $labels,
    "description" => "",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => true,
    "rest_base" => "",
    "rest_controller_class" => "WP_REST_Posts_Controller",
    "rest_namespace" => "wp/v2",
    "has_archive" => false,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "delete_with_user" => false,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "can_export" => true,
    "rewrite" => ["slug" => "event", "with_front" => false],
    "query_var" => true,
    "menu_position" => 6,
    "menu_icon" => "dashicons-tickets-alt",
    "supports" => ["title", "editor", "thumbnail", "excerpt", "custom-fields", "revisions"],
    "taxonomies" => ["event_type"],
    "show_in_graphql" => false,
  ];

  register_post_type("event", $args);
}

add_action('init', 'cptui_register_my_cpts');

// END CUSTOM POST TYPES - EVENTS

// ADDING CUSTOM TAXONOMIES - TYPE

function cptui_register_my_taxes()
{

  /**
   * Taxonomy: Types.
   */

  $labels = [
    "name" => esc_html__("Types", "custom-post-type-ui"),
    "singular_name" => esc_html__("Type", "custom-post-type-ui"),
    "menu_name" => esc_html__("Types", "custom-post-type-ui"),
    "all_items" => esc_html__("All Types", "custom-post-type-ui"),
    "edit_item" => esc_html__("Edit Type", "custom-post-type-ui"),
    "view_item" => esc_html__("View Type", "custom-post-type-ui"),
    "update_item" => esc_html__("Update Type name", "custom-post-type-ui"),
    "add_new_item" => esc_html__("Add new Type", "custom-post-type-ui"),
    "new_item_name" => esc_html__("New Type name", "custom-post-type-ui"),
    "parent_item" => esc_html__("Parent Type", "custom-post-type-ui"),
    "parent_item_colon" => esc_html__("Parent Type:", "custom-post-type-ui"),
    "search_items" => esc_html__("Search Types", "custom-post-type-ui"),
    "popular_items" => esc_html__("Popular Types", "custom-post-type-ui"),
    "separate_items_with_commas" => esc_html__("Separate Types with commas", "custom-post-type-ui"),
    "add_or_remove_items" => esc_html__("Add or remove Types", "custom-post-type-ui"),
    "choose_from_most_used" => esc_html__("Choose from the most used Types", "custom-post-type-ui"),
    "not_found" => esc_html__("No Types found", "custom-post-type-ui"),
    "no_terms" => esc_html__("No Types", "custom-post-type-ui"),
    "items_list_navigation" => esc_html__("Types list navigation", "custom-post-type-ui"),
    "items_list" => esc_html__("Types list", "custom-post-type-ui"),
    "back_to_items" => esc_html__("Back to Types", "custom-post-type-ui"),
    "name_field_description" => esc_html__("The name is how it appears on your site.", "custom-post-type-ui"),
    "parent_field_description" => esc_html__("Assign a parent term to create a hierarchy. The term Jazz, for example, would be the parent of Bebop and Big Band.", "custom-post-type-ui"),
    "slug_field_description" => esc_html__("The slug is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.", "custom-post-type-ui"),
    "desc_field_description" => esc_html__("The description is not prominent by default; however, some themes may show it.", "custom-post-type-ui"),
  ];


  $args = [
    "label" => esc_html__("Types", "custom-post-type-ui"),
    "labels" => $labels,
    "public" => true,
    "publicly_queryable" => true,
    "hierarchical" => false,
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => ['slug' => 'event_type', 'with_front' => false,],
    "show_admin_column" => true,
    "show_in_rest" => true,
    "show_tagcloud" => false,
    "rest_base" => "event_type",
    "rest_controller_class" => "WP_REST_Terms_Controller",
    "rest_namespace" => "wp/v2",
    "show_in_quick_edit" => true,
    "sort" => true,
    "show_in_graphql" => false,
  ];
  register_taxonomy("event_type", ["event"], $args);
}
add_action('init', 'cptui_register_my_taxes');

// END CUSTOM TAXONOMIES - TYPE

/* including shortcodes php file */
require_once WP_CONTENT_DIR . '/themes/divi-child-theme/includes/shortcodes.php';