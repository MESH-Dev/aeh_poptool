<?php 

//Add Custom Post Types and Custom Taxonomies

//Custom post type PROGRAMS
function program_custom_post() {

	$labels = array(
		'name'                  => _x( 'Programs', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Program', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Programs', 'text_domain' ),
		'name_admin_bar'        => __( 'Programs', 'text_domain' ),
		'archives'              => __( 'Program Archives', 'text_domain' ),
		'attributes'            => __( 'Program Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Program:', 'text_domain' ),
		'all_items'             => __( 'All Programs', 'text_domain' ),
		'add_new_item'          => __( 'Add New Programs', 'text_domain' ),
		'add_new'               => __( 'Add New Program', 'text_domain' ),
		'new_item'              => __( 'New Program', 'text_domain' ),
		'edit_item'             => __( 'Edit Program', 'text_domain' ),
		'update_item'           => __( 'Update Program', 'text_domain' ),
		'view_item'             => __( 'View Program', 'text_domain' ),
		'view_items'            => __( 'ViewPrograms', 'text_domain' ),
		'search_items'          => __( 'Search Programs', 'text_domain' ),
		'not_found'             => __( 'Program Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Program Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Program', 'text_domain' ),
		'description'           => __( 'Custom AEH Population Health Tool post type for individual programs', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( ),
		'taxonomies'            => array( 'Bed Size', ' % Gov Payer', ' Ownership', 'Teaching Status', 'Region', 'Active', 'Partners', 'SDH', 'Target Pop', 'Program Setting', 'Pop Size', '% Below FPL', '% Uninsured' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-admin-post',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'program', $args );

}
add_action( 'init', 'program_custom_post', 0 );

// Register Bed Size Tax
function bed_size_tax() {

	$labels = array(
		'name'                       => _x( 'Bed Sizes', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Bed Size', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Bed Size', 'text_domain' ),
		'all_items'                  => __( 'All Bed Sizes', 'text_domain' ),
		'parent_item'                => __( 'Parent Bed Size', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Bed Size:', 'text_domain' ),
		'new_item_name'              => __( 'New Bed Size', 'text_domain' ),
		'add_new_item'               => __( 'Add New Bed Size', 'text_domain' ),
		'edit_item'                  => __( 'Edit Bed Size', 'text_domain' ),
		'update_item'                => __( 'Update Bed Size', 'text_domain' ),
		'view_item'                  => __( 'View Bed Size', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Bed Size', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Bed Sizes', 'text_domain' ),
		'search_items'               => __( 'Search Bed Sizes', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'bed_size', array( 'program' ), $args );

}
add_action( 'init', 'bed_size_tax', 0 );

// Register % Govt payer tax
function percent_govt_payer_tax() {

	$labels = array(
		'name'                       => _x( '% Govt Payers', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( '% Govt Payer', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( '% Govt Payer', 'text_domain' ),
		'all_items'                  => __( 'All % Govt Payers', 'text_domain' ),
		'parent_item'                => __( 'Parent % Govt Payer', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent % Govt Payer:', 'text_domain' ),
		'new_item_name'              => __( 'New % Govt Payer', 'text_domain' ),
		'add_new_item'               => __( 'Add New % Govt Payer', 'text_domain' ),
		'edit_item'                  => __( 'Edit % Govt Payer', 'text_domain' ),
		'update_item'                => __( 'Update % Govt Payer', 'text_domain' ),
		'view_item'                  => __( 'View % Govt Payer', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove % Govt Payer', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular % Govt Payers', 'text_domain' ),
		'search_items'               => __( 'Search % Govt Payers', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'percent_govt_payer', array( 'program' ), $args );

}
add_action( 'init', 'percent_govt_payer_tax', 0 );


// Register Ownership Tax
function ownership_tax() {

	$labels = array(
		'name'                       => _x( 'Ownerships', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Ownership', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Ownership', 'text_domain' ),
		'all_items'                  => __( 'All Ownerships', 'text_domain' ),
		'parent_item'                => __( 'Parent Ownership', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Ownership:', 'text_domain' ),
		'new_item_name'              => __( 'New Ownership', 'text_domain' ),
		'add_new_item'               => __( 'Add New Ownership', 'text_domain' ),
		'edit_item'                  => __( 'Edit Ownership', 'text_domain' ),
		'update_item'                => __( 'Update Ownership', 'text_domain' ),
		'view_item'                  => __( 'View Ownership', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Ownership', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Ownerships', 'text_domain' ),
		'search_items'               => __( 'Search Ownerships', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'ownership', array( 'program' ), $args );

}
add_action( 'init', 'ownership_tax', 0 );

// Register Teaching Status Tax
function teaching_status_tax() {

	$labels = array(
		'name'                       => _x( 'Teaching Status', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Teaching Status', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Teaching Status', 'text_domain' ),
		'all_items'                  => __( 'All Teaching Statuss', 'text_domain' ),
		'parent_item'                => __( 'Parent Teaching Status', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Teaching Status:', 'text_domain' ),
		'new_item_name'              => __( 'New Teaching Status', 'text_domain' ),
		'add_new_item'               => __( 'Add New Teaching Status', 'text_domain' ),
		'edit_item'                  => __( 'Edit Teaching Status', 'text_domain' ),
		'update_item'                => __( 'Update Teaching Status', 'text_domain' ),
		'view_item'                  => __( 'View Teaching Status', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Teaching Status', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Teaching Statuss', 'text_domain' ),
		'search_items'               => __( 'Search Teaching Statuss', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'teaching_status', array( 'program' ), $args );

}
add_action( 'init', 'teaching_status_tax', 0 );

// Register Region Tax
function region_tax() {

	$labels = array(
		'name'                       => _x( 'Regions', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Region', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Region', 'text_domain' ),
		'all_items'                  => __( 'All Regions', 'text_domain' ),
		'parent_item'                => __( 'Parent Region', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Region:', 'text_domain' ),
		'new_item_name'              => __( 'New Region', 'text_domain' ),
		'add_new_item'               => __( 'Add New Region', 'text_domain' ),
		'edit_item'                  => __( 'Edit Region', 'text_domain' ),
		'update_item'                => __( 'Update Region', 'text_domain' ),
		'view_item'                  => __( 'View Region', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Region', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Regions', 'text_domain' ),
		'search_items'               => __( 'Search Regions', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'region', array( 'program' ), $args );

}
add_action( 'init', 'region_tax', 0 );

// Register Active Tax
function active_tax() {

	$labels = array(
		'name'                       => _x( 'Active', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Active', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Active', 'text_domain' ),
		'all_items'                  => __( 'All Active', 'text_domain' ),
		'parent_item'                => __( 'Parent Active', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Active:', 'text_domain' ),
		'new_item_name'              => __( 'New Active', 'text_domain' ),
		'add_new_item'               => __( 'Add New Active', 'text_domain' ),
		'edit_item'                  => __( 'Edit Active', 'text_domain' ),
		'update_item'                => __( 'Update Active', 'text_domain' ),
		'view_item'                  => __( 'View Active', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Active', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Actives', 'text_domain' ),
		'search_items'               => __( 'Search Actives', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'active', array( 'program' ), $args );

}
add_action( 'init', 'active_tax', 0 );


// Register Partners Tax
function partners_tax() {

	$labels = array(
		'name'                       => _x( 'Partners', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Partners', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Partners', 'text_domain' ),
		'all_items'                  => __( 'All Partners', 'text_domain' ),
		'parent_item'                => __( 'Parent Partners', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Partners:', 'text_domain' ),
		'new_item_name'              => __( 'New Partners', 'text_domain' ),
		'add_new_item'               => __( 'Add New Partners', 'text_domain' ),
		'edit_item'                  => __( 'Edit Partners', 'text_domain' ),
		'update_item'                => __( 'Update Partners', 'text_domain' ),
		'view_item'                  => __( 'View Partners', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Partners', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Partners', 'text_domain' ),
		'search_items'               => __( 'Search Partners', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'partners', array( 'program' ), $args );

}
add_action( 'init', 'partners_tax', 0 );


// Register SDH Tax
function sdh_tax() {

	$labels = array(
		'name'                       => _x( 'SDH', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'SDH', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'SDH', 'text_domain' ),
		'all_items'                  => __( 'All SDH', 'text_domain' ),
		'parent_item'                => __( 'Parent SDH', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent SDH:', 'text_domain' ),
		'new_item_name'              => __( 'New SDH', 'text_domain' ),
		'add_new_item'               => __( 'Add New SDH', 'text_domain' ),
		'edit_item'                  => __( 'Edit SDH', 'text_domain' ),
		'update_item'                => __( 'Update SDH', 'text_domain' ),
		'view_item'                  => __( 'View SDH', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove SDH', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular SDH', 'text_domain' ),
		'search_items'               => __( 'Search SDH', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'sdh', array( 'program' ), $args );

}
add_action( 'init', 'sdh_tax', 0 );

// Target Pop Tax
function target_pop_tax() {

	$labels = array(
		'name'                       => _x( 'Target Pops', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Target Pop', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Target Pop', 'text_domain' ),
		'all_items'                  => __( 'All Target Pop', 'text_domain' ),
		'parent_item'                => __( 'Parent Target Pop', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Target Pop:', 'text_domain' ),
		'new_item_name'              => __( 'New Target Pop', 'text_domain' ),
		'add_new_item'               => __( 'Add New Target Pop', 'text_domain' ),
		'edit_item'                  => __( 'Edit Target Pop', 'text_domain' ),
		'update_item'                => __( 'Update Target Pop', 'text_domain' ),
		'view_item'                  => __( 'View Target Pop', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Target Pop', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Target Pop', 'text_domain' ),
		'search_items'               => __( 'Search Target Pop', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'target_pop', array( 'program' ), $args );

}
add_action( 'init', 'target_pop_tax', 0 );

// Register Program Setting  Tax
function program_setting_tax() {

	$labels = array(
		'name'                       => _x( 'Program Settings', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Program Setting', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Program Setting', 'text_domain' ),
		'all_items'                  => __( 'All Program Setting', 'text_domain' ),
		'parent_item'                => __( 'Parent Program Setting', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Program Setting:', 'text_domain' ),
		'new_item_name'              => __( 'New Program Setting', 'text_domain' ),
		'add_new_item'               => __( 'Add New Program Setting', 'text_domain' ),
		'edit_item'                  => __( 'Edit Program Setting', 'text_domain' ),
		'update_item'                => __( 'Update Program Setting', 'text_domain' ),
		'view_item'                  => __( 'View Program Setting', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Program Setting', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Program Setting', 'text_domain' ),
		'search_items'               => __( 'Search Program Setting', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'program_setting', array( 'program' ), $args );

}
add_action( 'init', 'program_setting_tax', 0 );

// Register Pop Size Tax
function pop_size_tax() {

	$labels = array(
		'name'                       => _x( 'Pop Sizes', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Pop Size', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Pop Size', 'text_domain' ),
		'all_items'                  => __( 'All Pop Size', 'text_domain' ),
		'parent_item'                => __( 'Parent Pop Size', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Pop Size:', 'text_domain' ),
		'new_item_name'              => __( 'New Pop Size', 'text_domain' ),
		'add_new_item'               => __( 'Add New Pop Size', 'text_domain' ),
		'edit_item'                  => __( 'Edit Pop Size', 'text_domain' ),
		'update_item'                => __( 'Update Pop Size', 'text_domain' ),
		'view_item'                  => __( 'View Pop Size', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Pop Size', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Pop Size', 'text_domain' ),
		'search_items'               => __( 'Search Pop Size', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'pop_size', array( 'program' ), $args );

}
add_action( 'init', 'pop_size_tax', 0 );

// Register % Below FPL Tax
function percent_below_fpl_tax() {

	$labels = array(
		'name'                       => _x( '% Below FPLs', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( '% Below FPL', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( '% Below FPL', 'text_domain' ),
		'all_items'                  => __( 'All % Below FPL', 'text_domain' ),
		'parent_item'                => __( 'Parent % Below FPL', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent % Below FPL:', 'text_domain' ),
		'new_item_name'              => __( 'New % Below FPL', 'text_domain' ),
		'add_new_item'               => __( 'Add New % Below FPL', 'text_domain' ),
		'edit_item'                  => __( 'Edit % Below FPL', 'text_domain' ),
		'update_item'                => __( 'Update % Below FPL', 'text_domain' ),
		'view_item'                  => __( 'View % Below FPL', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove % Below FPL', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular % Below FPL', 'text_domain' ),
		'search_items'               => __( 'Search % Below FPL', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'percent_below_fpl', array( 'program' ), $args );

}
add_action( 'init', 'percent_below_fpl_tax', 0 );

// Register % Uninsured Tax
function percent_uninsured_tax() {

	$labels = array(
		'name'                       => _x( '% Uninsureds', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( '% Uninsured', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( '% Uninsured', 'text_domain' ),
		'all_items'                  => __( 'All % Uninsured', 'text_domain' ),
		'parent_item'                => __( 'Parent % Uninsured', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent % Uninsured:', 'text_domain' ),
		'new_item_name'              => __( 'New % Uninsured', 'text_domain' ),
		'add_new_item'               => __( 'Add New % Uninsured', 'text_domain' ),
		'edit_item'                  => __( 'Edit % Uninsured', 'text_domain' ),
		'update_item'                => __( 'Update % Uninsured', 'text_domain' ),
		'view_item'                  => __( 'View % Uninsured', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove % Uninsured', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular % Uninsured', 'text_domain' ),
		'search_items'               => __( 'Search % Uninsured', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'percent_uninsured', array( 'program' ), $args );

}
add_action( 'init', 'percent_uninsured_tax', 0 );

add_action('init', 'sdh_register_meta');
        function sdh_register_meta(){
            register_meta('term', 'icon','' );
        }

add_action( 'sdh_add_form_fields', 'sdh_new_term_field' ); 
        function sdh_new_term_field() { 
            wp_nonce_field( basename( __FILE__ ), 'sdh_term_nonce' ); ?> 
            <div class="form-field sdh-term-wrap"> <label for="sdh-term">
                <?php _e( 'Icon Link', 'sdh' ); ?></label> 
                <input type="text" name="sdh_term" id="sdh-term" value="" class="sdh-field" /> </div> 

                <?php }

 add_action( 'sdh_edit_form_fields', 'sdh_edit_term_field' );

            function sdh_edit_term_field( $term ) {

                //$default = '#ffffff';
                //$location_term = location_get_term( $term->term_id, true );

                $icon = get_term_meta( $term->term_id, 'icon', true );
                
                ?>

                <tr class="form-field sdh-term-wrap">
                    <th scope="row"><label for="sdh-tax-term"><?php _e( 'Icon Link', 'sdh' ); ?></label></th>
                    <td>
                        <?php wp_nonce_field( basename( __FILE__ ), 'sdh_term_nonce' ); ?>
                        <input type="text" name="sdh_term_icon" id="sdh-term-icon" value="<?php echo esc_attr( $icon ); ?>" class="location-field" />
                    </td>
                </tr>
            
                <?php }

    add_action( 'edit_sdh',   'sdh_save_term_icon' );
        add_action( 'create_sdh', 'sdh_save_term_icon' );

        function sdh_save_term_icon($term_id) {

            if ( ! isset( $_POST['sdh_term_nonce'] ) || ! wp_verify_nonce( $_POST['sdh_term_nonce'], basename( __FILE__ ) ) )
                return;

            $old_term = get_term_meta( $term_id, 'icon', true );
            $new_term = $_POST['sdh_term_icon'];

            if ( $old_term && '' === $new_term )
                delete_term_meta( $term_id, 'icon' );

            else if ( $old_term !== $new_term )
                update_term_meta( $term_id, 'icon', $new_term );
        }

?>