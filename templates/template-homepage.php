

<?php
/* Template Name: Homepage Template*/
get_header();

?>

<main id="content" class="home-page">
   <div class="greeting">
      <div class="container">
         <div class="row">
            <div class="columns-7">
               <?php
                  $g_title = get_field('greeting_title');
                  $g_intro = get_field('greeting_intro');
                  $g_sub = get_field('greeting_subparagraph');
               ?>
               <h1 style="color:white; font-size:36px;"><span><?php echo $g_title; ?></span><br> <?php echo $g_intro; ?></h1>

               <p><?php echo $g_sub; ?></p>
            </div>
            <div class="columns-4 section-cta">
               <div class="wrapper">
                  <?php
                     if(have_rows('section_cta')):
                        while(have_rows('section_cta')):the_row();
                        $title = get_sub_field('sc_tilte');
                        $intro = get_sub_field('s_intro_text');
                        $hover_icon = get_sub_field('s_icon');
                        $hover_icon_url = $hover_icon['sizes']['small'];
                        $hover_icon_alt = $hover_icon['alt'];
                        $link = get_sub_field('section_link');

                  ?>

                     <a href="<?php echo $link; ?>"><div class="single-cta">
                        <img src="<?php echo $hover_icon_url; ?>" >
                        <h3><?php echo $title; ?></h3>
                        <p><?php echo $intro; ?></p>
                           <!-- <p>Learn more &rarr;</p> -->
                     </div></a>


                  <?php endwhile; endif; ?>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="social-determinants">
      <div class="container">
         <div class="row">
            <div class="sdh-intro columns-5">
               <div class="main-intro">
 +                  <?php
 +                     $sd_intro_b = get_field('sdh_intro_bold');
 +                     $sd_intro_nb = get_field('sdh_intro_nobold');
 +                     $sd_intro_desc = get_field('sdh_intro_description');
 +                  ?>
 +                  <h2><?php echo $sd_intro_b; ?> <span><?php echo $sd_intro_nb; ?></span></h2>
 +                  <?php echo $sd_intro_desc; ?>
 +               </div>
 +               <div class="determ-intro">
 +                  <h2>Housing Instability</h2>
 +                  <p>Aenean lacinia bibendum nulla sed consectetur. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Etiam porta sem malesuada magna mollis euismod. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean lacinia bibendum nulla sed consectetur.</p>
 +                  <a class="determ-close">BACK TO DESCRIPTION OF ALL SOCIAL DETERMINATES »</a>
 +               </div>

            </div>
            <div class="columns-6 offset-by-1">
               <div class="row">
               <?php if (have_rows('social_determinant')):
                     $sdh_cnt=0;
                     while(have_rows('social_determinant')):the_row();
                     $sdh_cnt++;
                     $sdh_icon = get_sub_field('sdh_icon');
                     $sdh_icon_url = $sdh_icon['sizes']['small'];
                     $sdh_icon_alt = $sdh_icon['alt'];
                     $sdh_title = get_sub_field('sdh_title');
                     $sdh_description = get_sub_field('sdh_description');
                     $mod = $sdh_cnt % 4;
                     // if($sdh_cnt % 4 == 0){
                     //    echo '</div><div class="row">';
                     // }
               ?>
               <div class="sdh-icon "><!-- columns-3 no-padding -->
                  <div class="wrap">
                     <?php echo file_get_contents($sdh_icon_url); ?>
                     <!-- <img src="<?php echo $sdh_icon_url; ?>"> -->
                     <p class="caption"><?php echo $sdh_title; ?> <!--<//?php echo $sdh_cnt; ?> <//?php echo $mod; ?>--></p>
                  </div>
               </div>
               <?php endwhile; endif; ?>
               <!-- </div> --><!-- end row -->
            </div>
         </div>
      </div>
   </div>

</main>

<?php get_footer(); ?>
