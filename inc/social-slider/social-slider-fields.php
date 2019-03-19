<?php
if ( ! function_exists( 'add_action' ) ) {
    echo 'Hey, you can\'t access this file, you silly human!'; 
    exit;
}

function dwwp_add_social_slider_custom_metabox2() {
global $pagenow, $typenow; 
if ($typenow!='qpsocials') return;
add_meta_box(
    'dwwp_meta',
    'Slider parameters',
'dwwp_meta_social_slider_callback2',
    '',
    'normal',
    'core'
);
}
function dwwp_meta_social_slider_callback2(){
    global $pagenow, $typenow; 
    if ($typenow!='qpsocials') return;
  wp_nonce_field(basename( __FILE__ ),'dwwp_studio_nonce');
  $dwwp_stored_meta=get_post_meta(get_the_ID());
      // echo "<pre>";
      // var_dump($dwwp_stored_meta);
      // echo "</pre>";
    ?>
    <div>

        <div class="meta-row">
            <div class="meta-th">
                <label for="slider_author" class="dwwp-row-title">author</label>
            </div>
            <div class="meta-td">
                <input  type="text"  name="slider_author" id="slider_author" value="<?php if (!empty($dwwp_stored_meta['slider_author'])) echo esc_attr ( $dwwp_stored_meta['slider_author'][0]); ?>">
            </div>
        </div>




        <div class="meta-row">
            <div class="meta-th">
                <label for="slider_author" class="dwwp-row-title">Social</label>
            </div>
            <div class="meta-td">
            	<select name="slider_social">
							  <option <?php if (!empty($dwwp_stored_meta['slider_social']) && $dwwp_stored_meta['slider_social'][0] == "twitter") echo "selected" ?> value="twitter">Twitter</option>
							  <option <?php if (!empty($dwwp_stored_meta['slider_social']) && $dwwp_stored_meta['slider_social'][0] == "instagram") echo "selected" ?>  value="instagram">Instagram</option>
							</select>
          
            </div>
        </div>

        <div class="meta-row">
            <div class="meta-th">
                <label for="slider_social_link" class="dwwp-row-title">Profile Link</label>
            </div>
            <div class="meta-td">
                <input  type="text"  name="slider_social_link" id="slider_social_link" value="<?php if (!empty($dwwp_stored_meta['slider_social_link'])) echo esc_attr ( $dwwp_stored_meta['slider_social_link'][0]); ?>">
            </div>
        </div>

    </div>
<?php
};

function dwwp_social_slider_meta_save2($post_id){
   // $post_id = get_the_ID();

    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);

    $is_valid_nonce = (isset ($_POST['dwwp_studio_nonce']) && wp_verify_nonce ($_POST['dwwp_studio_nonce'],basename(__FILE__))) ? 'true': 'false';
    if ($is_autosave || $is_revision || !$is_valid_nonce){return;}

    if (isset($_POST['slider_author'])){
        update_post_meta($post_id,'slider_author',sanitize_text_field($_POST['slider_author']));
    }

    if (isset($_POST['slider_social'])){
        update_post_meta($post_id,'slider_social',sanitize_text_field($_POST['slider_social']));
    }

   if (isset($_POST['slider_social_link'])){
        update_post_meta($post_id,'slider_social_link',sanitize_text_field($_POST['slider_social_link']));
    }
   
}


add_action('save_post','dwwp_social_slider_meta_save2');
add_action('add_meta_boxes','dwwp_add_social_slider_custom_metabox2');

