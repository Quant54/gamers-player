<?php
if ( ! function_exists( 'add_action' ) ) {
    echo 'Hey, you can\'t access this file, you silly human!'; 
    exit;
}

function dwwp_add_custom_metabox2() {
global $pagenow, $typenow; 
if ($typenow!='player') return;
add_meta_box(
    'dwwp_meta',
    'Player\'s parameters',
'dwwp_meta_callback2',
    '',
    'normal',
    'core'
);
}
function dwwp_meta_callback2(){
    global $pagenow, $typenow; 
    if ($typenow!='player') return;
  wp_nonce_field(basename( __FILE__ ),'dwwp_studio_nonce');
  $dwwp_stored_meta=get_post_meta(get_the_ID());
      // echo "<pre>";
      // var_dump($dwwp_stored_meta);
      // echo "</pre>";
    ?>
    <div>

        <div class="meta-row">
            <div class="meta-th">
                <label for="player_nick" class="dwwp-row-title">Nick</label>
            </div>
            <div class="meta-td">
                <input  type="text"  name="player_nick" id="player_nick" value="<?php if (!empty($dwwp_stored_meta['player_nick'])) echo esc_attr ( $dwwp_stored_meta['player_nick'][0]); ?>">
            </div>
        </div>

        <div class="meta-row">
            <div class="meta-th">
                <label for="player_fullname" class="dwwp-row-title">Full name</label>
            </div>
            <div class="meta-td">
                <input  type="text"  name="player_fullname" id="player_fullname" value="<?php if (!empty($dwwp_stored_meta['player_fullname'])) echo esc_attr ( $dwwp_stored_meta['player_fullname'][0]); ?>">
            </div>
        </div>

        <div class="meta-row">
            <div class="meta-th">
                <label for="player_twitter" class="dwwp-row-title">Twitter</label>
            </div>
            <div class="meta-td">
                <input  type="text"  name="player_twitter" id="player_twitter" value="<?php if (!empty($dwwp_stored_meta['player_twitter'])) echo esc_attr ( $dwwp_stored_meta['player_twitter'][0]); ?>">
            </div>
        </div>

        <div class="meta-row">
            <div class="meta-th">
                <label for="player_facebook" class="dwwp-row-title">Facebook</label>
            </div>
            <div class="meta-td">
                <input  type="text"  name="player_facebook" id="player_facebook" value="<?php if (!empty($dwwp_stored_meta['player_facebook'])) echo esc_attr ( $dwwp_stored_meta['player_facebook'][0]); ?>">
            </div>
        </div>

        <div class="meta-row">
            <div class="meta-th">
                <label for="player_instagram" class="dwwp-row-title">Instagram</label>
            </div>
            <div class="meta-td">
                <input  type="text"  name="player_instagram" id="player_instagram" value="<?php if (!empty($dwwp_stored_meta['player_instagram'])) echo esc_attr ( $dwwp_stored_meta['player_instagram'][0]); ?>">
            </div>
        </div>


        <div class="meta-row">
            <div class="meta-th">
                <label for="player_twich" class="dwwp-row-title">Twich</label>
            </div>
            <div class="meta-td">
                <input  type="text"  name="player_twich" id="player_twich" value="<?php if (!empty($dwwp_stored_meta['player_twich'])) echo esc_attr ( $dwwp_stored_meta['player_twich'][0]); ?>">
            </div>
        </div>


         <div class="meta-row">
            <div class="meta-th">
                <label for="player_link" class="dwwp-row-title">Link</label>
            </div>
            <div class="meta-td">
                <input  type="text"  name="player_link" id="player_twich" value="<?php if (!empty($dwwp_stored_meta['player_link'])) echo esc_attr ( $dwwp_stored_meta['player_link'][0]); ?>">
            </div>
        </div>




    </div>
<?php
};

function dwwp_meta_save2($post_id){
   // $post_id = get_the_ID();

    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);

    $is_valid_nonce = (isset ($_POST['dwwp_studio_nonce']) && wp_verify_nonce ($_POST['dwwp_studio_nonce'],basename(__FILE__))) ? 'true': 'false';
    if ($is_autosave || $is_revision || !$is_valid_nonce){return;}

    if (isset($_POST['player_nick'])){
        update_post_meta($post_id,'player_nick',sanitize_text_field($_POST['player_nick']));
    }
    if (isset($_POST['player_fullname'])){
        update_post_meta($post_id,'player_fullname',sanitize_text_field($_POST['player_fullname']));
    }
    if (isset($_POST['player_facebook'])){
        update_post_meta($post_id,'player_facebook',sanitize_text_field($_POST['player_facebook']));
    }
    if (isset($_POST['player_twitter'])){
        update_post_meta($post_id,'player_twitter',sanitize_text_field($_POST['player_twitter']));
    }
    if (isset($_POST['player_twich'])){
        update_post_meta($post_id,'player_twich',sanitize_text_field($_POST['player_twich']));
    }

    if (isset($_POST['player_instagram'])){
        update_post_meta($post_id,'player_instagram',sanitize_text_field($_POST['player_instagram']));
    }
    if (isset($_POST['player_link'])){
        update_post_meta($post_id,'player_link',sanitize_text_field($_POST['player_link']));
    }


}


add_action('save_post','dwwp_meta_save2');
add_action('add_meta_boxes','dwwp_add_custom_metabox2');

