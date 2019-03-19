<?php

if ( ! function_exists( 'add_action' ) ) {
    echo 'Hey, you can\'t access this file, you silly human!'; 
    exit;
}



function qpsp_get_slider () {
        $args = array(
        'post_type' => 'qpsocials' ,
        'orderby'=>'menu_order',
        'order'=>'ASC',
        'no_found_rows'=>false,
        'update_post_term_cache'=>false,
        'posts_per_page' => 10,
        'paged'=>1,
    );
        $slider = new WP_Query($args);
        return $slider;
} 

function qpsp_shortcode_social_slider( $atts ) {

   ob_start();
   $get_slider = qpsp_get_slider();

   ?>
  <div id="social-slider" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">

      <?php
        $i=0;
         while ($get_slider->have_posts()):
          $get_slider->the_post();
          ?>
            <li data-target="#social-slider" data-slide-to="<?php echo $i; if ($i==0) echo "\" class=\"active\"";   ?>"></li>
          <?php 
         $i++;
         endwhile;
       ?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

      <?php
      $first = true;
      $dir_img = plugin_dir_url(dirname(__FILE__))."img/";
         while ($get_slider->have_posts()):
          $get_slider->the_post();
          if (has_post_thumbnail()) $img = get_the_post_thumbnail_url( get_the_id(), 'full' ); else $img = $dir_img . "placeholder.png";
          $slider_author = get_post_meta(get_the_id(), 'slider_author')[0];
          $slider_social = get_post_meta(get_the_id(), 'slider_social')[0];
          $slider_social_link = "#";
          if (get_post_meta(get_the_id(), 'slider_social_link'))  $slider_social_link =  get_post_meta(get_the_id(), 'slider_social_link')[0];
          $social_path = "";

          switch ($slider_social) {
            case 'instagram':
               $social_path = $dir_img . "instagram.png";
              break;
            case 'twitter':
               $social_path =$dir_img . "twitter.png";
              break;
            default:
               $social_path = $dir_img . "instagram.png";
              break;
          }

          ?>
      <div class="item <?php echo $first ? "active" : "" ?>">

        <div class="wrapper">
   <a class="ghost-link" target="blank" href="<?php echo $slider_social_link ?>"> </a>
       <img src="<?php echo $social_path ?>" class="icon" alt="">
          <img  class="thumbnail img-responsive" src="<?php echo $img ?>" alt="Chania"> 

          <div style="z-index: 2; cursor: default;">
            <div class="meta">
              <span class="display-name"><a target="_blank" href="<?php echo $slider_social_link; ?>"><?php echo $slider_author ?></a> </span> • <span class="date"><?php the_date(); ?></span>
            </div>
            <div  class="slider-content">
              <?php the_content(); ?>
            </div>
          </div> 
   
        </div>

      </div>

          <?php 
          $first = false;
         endwhile;
       ?>




    </div>


  </div>


   <?php
   $content = ob_get_contents(); 
   ob_end_clean();
   return $content;
}


add_shortcode( 'qpsp_social_slider', 'qpsp_shortcode_social_slider' );

