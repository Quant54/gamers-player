<?php

if ( ! function_exists( 'add_action' ) ) {
    echo 'Hey, you can\'t access this file, you silly human!'; 
    exit;
}



function qpsp_get_event_online2 ($atts) {
  $count = 4;
  $type = "";
  if (isset($atts['count']))  $count = $atts['count'];
  if (isset($atts['type']))  {$type = $atts['type'];

  $tax_q = array(
            array(
                'taxonomy' => 'type',
                'field'    => 'slug',
                'terms'    => $type,
            ),
        );
}
   if ( !isset($atts['type']) || (isset($atts['type']) && $atts['type']=="all" )  )  $tax_q =array();
        $args = array(
        'post_type' => 'qpevents' ,
        'orderby'=>'date',
        'order'=>'DESC',
        'no_found_rows'=>false,
        'update_post_term_cache'=>false,
        'posts_per_page' => $count,
        'paged'=>1,
        'tax_query' =>  $tax_q
    );
        $slider = new WP_Query($args);
        return $slider;
} 

function qpsp_shortcode_event_plan_online( $atts ) {

   ob_start();
   $get_events = qpsp_get_event_online2($atts);
   $border = "";
 if (isset($atts['border']) && $atts['border'] == "right" ) $border = "border-right: 3px solid black;";  
 if (isset($atts['border']) && $atts['border'] == "left" ) $border = "border-left: 3px solid black;";
   ?>
  <div class="col-xs-6 bg-info"  >
    <div class="event-wrapper" style="<?php echo $border; ?>">
    <h1 class="title">UPCOMING ONLINE EVENTS</h1>

    <?php
        while ($get_events->have_posts()):
          $get_events->the_post();
          $event_link = "#";
          if (get_post_meta(get_the_id(), 'event_link'))  $event_link =  get_post_meta(get_the_id(), 'event_link')[0];
          ?>
        <h6><?php the_title(); ?></h6>
        <div class="datelink">
        <p><?php the_date(); ?>&nbsp;</p>
        <a href="<?php echo $event_link; ?>">Event</a>
        <div class="clearfix"></div>
        </div>
          <?php
        endwhile;
          ?>
    </div>
  </div>


   <?php
   $content = ob_get_contents(); 
   ob_end_clean();
   return $content;
}


add_shortcode( 'qpsp_event_plan_online', 'qpsp_shortcode_event_plan_online' );

