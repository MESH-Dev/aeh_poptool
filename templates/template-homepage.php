

<?php 
/* Template Name: Homepage Template*/
get_header();

?>

<main id="content">
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
                        $title = get_sub_field('sc_title');
                        $intro = get_sub_field('s_intro_text');
                        $hover_icon = get_sub_field('s_icon');
                        $hover_icon_url = $hover_icon['sizes']['small'];
                        $hover_icon_alt = $hover_icon['alt'];
                        $link = get_sub_field('section_link');

                  ?>
                  <a href="<?php echo $link; ?>">
                     <img style="display:none;" src="<?php echo $hover_icon_url; ?>" >
                     <div class="single-cta">
                        <h3><?php echo $title; ?></h3>
                        <p>Learn more &rarr;</p>
                     </div>
                  </a>

                  <?php endwhile; endif; ?>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="social-determinants">
      <div class="container">
         <div class="row">
            <div class="columns-6">
               <?php 
                  $sd_intro_b = get_field('sdh_intro_bold');
                  $sd_intro_nb = get_field('sdh_intro_nobold');
                  $sd_intro_desc = get_field('sdh_intro_description');
               ?>
               <h2><span><?php echo $sd_intro_b; ?></span> <span><?php echo $sd_intro_nb; ?></span></h2>
               <?php echo $sd_intro_desc; ?>

            </div>
            <div class="columns-6">
               <div class="row">
               <?php if (have_rows('social_determinant')):
                     $sdh_cnt=0;
                     while(have_rows('social_determinant')):the_row();
                     $sdh_cnt++;
                     $sdh_icon = get_sub_field('sdh_icon');
                     $sdh_icon_url = $sdh_icon['sizes']['small'];
                     $sdh_icon_alt = $sdh_icon['alt'];
                     $sdh_title = get_sub_field('sdh_title');
                     $sdh_description = get_sub_field('sdh_description')
                     if($sdh_cnt %3 == 0){
                        echo '</div><div class="row">'
                     }
               ?>
               <div class="sdh-icon columns-3">
                  <img src="<?php echo $sdh_icon_url; ?>">
                  <span><?php echo $sdh_title; ?></span>                  
               </div>
               <?php endwhile; endif; ?>
            </div>
         </div>
      </div>
   </div>

</main>

<?php get_footer(); ?>