<?php

if ( ! function_exists( 'add_action' ) ) {
    echo 'Hey, you can\'t access this file, you silly human!'; 
    exit;
}


function qpsp_get_player () {
        $args = array(
        'post_type' => 'player' ,
        'orderby'=>'menu_order',
        'order'=>'ASC',
        'no_found_rows'=>false,
        'update_post_term_cache'=>false,
        'posts_per_page' => 5,
        'paged'=>1,
    );
        $player = new WP_Query($args);
        return $player;
} 

function qpsp_shortcode( $atts ) {
   $a = shortcode_atts( array(
      'name' => 'world'
   ), $atts );
   ob_start();
   $get_player = qpsp_get_player();
 ?>

<section id="monarchs">
    <div class="con">
        <div class="wrapper">
            <div class="backgrounds">

 <?php
   while ($get_player->have_posts()):
    $get_player->the_post();
    $fullanme = get_post_meta(get_the_id(), 'player_fullname')[0];
    $img = get_the_post_thumbnail_url( get_the_id(), 'full' );
    ?>
                <div class="background_image">
                    <img src="<?php echo $img; ?>" alt="<?php echo $fullanme; ?>"> 
                 </div>
    <?php
   endwhile;

   ?>
                  </div>
                    <div class="players">
                    
 <?php
   while ($get_player->have_posts()):
    $get_player->the_post();

    if (get_post_meta(get_the_id(), 'player_nick')) $nick = get_post_meta(get_the_id(), 'player_nick')[0]; else $nick = "";
    if (get_post_meta(get_the_id(), 'player_fullname')) $fullanme = get_post_meta(get_the_id(), 'player_fullname')[0]; else $fullanme = "";
    if (get_post_meta(get_the_id(), 'player_link')) $link = get_post_meta(get_the_id(), 'player_link')[0]; else $link = "";
    $img = get_the_post_thumbnail_url( get_the_id(), 'full' );

    $socials["facebook"] = get_post_meta(get_the_id(), 'player_facebook')[0];
    $socials["twitter"] = get_post_meta(get_the_id(), 'player_twitter')[0];
    $socials["instagram"] = get_post_meta(get_the_id(), 'player_instagram')[0];
    $socials["twitch"] = get_post_meta(get_the_id(), 'player_twich')[0];


    ?>
     <div class="player">

    <div class="player_thumbnail">
        <a href="<?php echo $link; ?>">
            <img src="<?php echo $img; ?>" alt="Benjamin Bremer"> 
        </a>
    </div>

    <div class="player_info">

        <div class="circle">
            <span> </span>
        </div>

        <div class="line">
            <span>
                <div class="info">
                    <h2><?php echo $nick; ?></h2>
                    <div>
                        <h4><?php echo $fullanme; ?></h4>
                            <div class="socials">   
                                <?php   
                                    foreach ($socials as $social => $value )
                                    {
                                        if ($value){
                                            echo '<a rel="noopener noreferrer" href="'.$value.'">';
                                            echo '<i class="fab fa-'.$social.'"></i>';
                                            echo '</a>';
                                        }
                                    }
                                    ?>               
                             </div>
                    </div>
                </div>
            </span>
        </div>
    </div>
</div>
    <?php
   endwhile;
   ?>

</div>        </div>
    </div>
</section>

   <?php
   $content = ob_get_contents(); 
   ob_end_clean();
   return $content;
}


add_shortcode( 'qpsp_player_select', 'qpsp_shortcode' );

