<?php
if ( ! function_exists( 'add_action' ) ) {
	echo 'Hey, you can\'t access this file, you silly human!'; 
	exit;
}

function qpsp_register_post_type_social_slider(){
$signular = 'QPSocial';
$plural = 'QPSocials';
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
'menu_icon'=>'dashicons-images-alt2',
'can_export'=>true,
'delete_with_user'=>false,
'hierarchical'       => false,
'has_archive'        => true,
'query_var'          => true,
'rewrite'            => array( 'slug' => 'QPSocial', 'with_front'=>true,'pages'=>true,'feeds'=>true ),
'capability_type'    => 'post',
'map_meta_cap'=>true,

'supports'=>array('thumbnail','editor',

'title'
),
);



register_post_type( 'qpsocials', $args );
}
add_action('init','qpsp_register_post_type_social_slider');