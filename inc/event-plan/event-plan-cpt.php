<?php
if ( ! function_exists( 'add_action' ) ) {
	echo 'Hey, you can\'t access this file, you silly human!'; 
	exit;
}


function qpep_register_taxonomy() {
$plural = 'Category';
$singular = 'Categories';
$labels = array(
'name'              => $plural,
'singular_name'     => $singular,
'search_items'      => 'Search '.$singular,
'popular_items'     => 'Popular '.$singular,
'all_items'         => 'All '.$singular,
'parent_item'       => null,
'parent_item_colon' => null,
'edit_item'         => 'Edit Category',
'update_item'       => 'Update Category',
'add_new_item'      => 'Add new Category',
'new_item_name'     => 'New name '.$singular,
'add_or_remove_items'=>'Add or remove category',
'choose_from_most_used'=>'Choose from most used',
'not_found'         => 'No found: '.$singular,
'menu_name'         => $plural,

);
$args =array(
'hierarchical'       => false,
'labels'=>$labels,
'show_ui'            => true,
'show_admin_column'     =>true,
'update_count_callback' => '_update_post_term_count',
'query_var'             =>  'true',
'rewrite'               => array('slug'=>'type')
);
register_taxonomy('type','qpevents',$args);

}

function qpsp_register_post_type_event_plan(){
$signular = 'QPEvent';
$plural = 'QPEvents';
$labels = array(
'name'		=>		$plural,
'signular_name'=> $signular,
'add_new'=>'Add',  //+
'add_new_item'=>'Add new '. $signular,  //+
'edit'=>'Edit',
'edit_item'=>'Edit '.$signular,  //+
'new_item'=>'New '.$signular,
'view' => 'Show '.$signular,
'view_item'=>'Show_ '.$signular,
'search_term'=>'Sarch '.$plural,
'parent'=>'Parent '.$signular,
'not_found' => 'No '.$plural, //+
'not_found_in_trash' => 'No'.$plural.' in trash'
);
$args =  array(
'labels'=>$labels,
'public'             => false,
'publicly_queryable'=> false,
'exclude_from_search'=>true,
'show_in_nav_menus'=>true,
'show_ui'            => true,
'show_in_menu'       => true,
'show_admin_bar'=>true,
'menu_position'=>6,
'menu_icon'=>'dashicons-welcome-widgets-menus',
'can_export'=>true,
'delete_with_user'=>false,
'hierarchical'       => false,
'has_archive'        => true,
'query_var'          => true,
'rewrite'            => array( 'slug' => 'QPEvent', 'with_front'=>true,'pages'=>true,'feeds'=>true ),
'capability_type'    => 'post',
'map_meta_cap'=>true,

'supports'=>array('thumbnail',

'title'
),
);



register_post_type( 'qpevents', $args );
}

add_action('init','qpsp_register_post_type_event_plan');
add_action('init','qpep_register_taxonomy');