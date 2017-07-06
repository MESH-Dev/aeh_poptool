

<?php
/* Template Name: Resource Library Template*/
get_header();

?>

<main id="content">
   <div class="greeting">
      <div class="container">
         <div class="row">
            <div class="columns-7">
               <?php
                  $g_bold = get_field('rsl_t_b');
                  $g_reg = get_field('rsl_t_nb');
                  //$g_sub = get_field('greeting_subparagraph');
               ?>
               <h1><span><?php echo $g_bold; ?></span> <?php echo $g_reg; ?></h1>

               <!-- <p><?php echo $g_sub; ?></p> -->
            </div>
         </div>
      </div>
   </div>
   <div class="resource-toolbar" style="margin-bottom:20px;">
   <div class="container">
      <div class="row">
         
            <div class="search-container columns-6">
               <form id="landing-form">
                  <label for="landing-search" class="sr-only">Search Programs</label>
                  <input type="text" id="landing-search" value="" placeholder="Search Programs">
                  <button type="submit" id="landing-submit" name="" value="»"><span>»</span></button>
               </form>
            </div>
            <div class="resource-filters columns-6">
               <p>Filter by:</p>

               <!--Social Determinant-->
               <fieldset class="checkers filter-group">
                  <legend><h2>Social Determinant</h2></legend>
                   <div class="checkboxes filters determinant">

                           <?php $sdh_filters= get_terms(array('taxonomy'=>'sdh', 'hide_empty'=>false));

                              foreach ($sdh_filters as $sdh_filter){ ?>
                              <label for="id-<?php echo $sdh_filter->slug ?>">
                                 <input type="checkbox" id="id-<?php echo $sdh_filter->slug ?>" name="check-<?php echo $sdh_filter->slug ?>" data-filter='<?php echo $sdh_filter->slug ?>' data-valname="<?php echo $sdh_filter->name; ?>" value=".<?php echo $sdh_filter->slug; ?>">
                                    <?php echo $sdh_filter->name; ?>
                                 </input>
                                 <div class="indicator"></div>
                              </label>
                              <?php } ?>
                  </div>
               </fieldset>
               <!-- ++++++++++++++ -->

               <!--Strategy-->
               <fieldset class="checkers filter-group">
                  <legend><h2>Strategy</h2></legend>
                   <div class="checkboxes filters strategy">

                     <?php $strategy_filters= get_terms(array('taxonomy'=>'strategy', 'hide_empty'=>false)); ?>

                              <?php foreach ($strategy_filters as $strategy_filter){  ?>
                              <label for="id-<?php echo $strategy_filter->slug ?>">
                                 <input type="checkbox" id="id-<?php echo $strategy_filter->slug ?>" name="check-<?php echo $strategy_filter->slug ?>" data-filter='<?php echo $strategy_filter->slug ?>' data-valname="<?php echo $strategy_filter->name ?>" value=".<?php echo $strategy_filter->name; ?>">
                                    <?php echo $strategy_filter->name ?>?>
                                 </input>
                                 <div class="indicator"></div>
                              </label>
                              <?php } ?>
                     </div>
               </fieldset>
            </div>
         </div>
      </div>
   </div>
   <div class="container">
      <div class="row">
         <div class="resource-grid">
            
            <?php 
                        $args = array(
                           'post_type' => 'resource',
                           'posts_per_page' => -1,
                        );

                        $the_query = new WP_Query($args);
                        //var_dump($query);

                        if ($the_query->have_posts()){
                           while($the_query->have_posts()){ $the_query->the_post();
                              //var_dump($query);
                              $comma = ', ';
                              $separator=' ';
                              
                              $sdh = get_the_terms($post->ID, 'sdh');
                              $sdh_name = '';
                              $sdh_class = '';
                              if($sdh != ''){
                                 foreach($sdh as $determinant){
                                    $sdh_name .= $determinant->name . $comma;
                                    $sdh_class .= $determinant->slug . $separator; 
                                 }
                              }

                              $strategies = get_the_terms($post->ID, 'strategy');
                              $strat_name = '';
                              $strat_class = '';
                              if($strategies != ''){
                                 foreach($strategies as $strategy){
                                    $strat_name .= $strategy->name . $comma;
                                    $strat_class .= $strategy->slug . $separator;
                                 }
                              }

                        ?>
                        <div class="columns-6 resource-item <?php echo $strat_class; ?> <?php echo $sdh_class; ?>">
                           <div class="resource-indiv">
                              <div class="resource-block">
                                 <h2><?php echo the_title();?></h2>
                                 <p class="tax-terms s-determinants">
                                    <span>Social Determinants: </span>
                                    <?php echo rtrim($sdh_name, $comma); ?>
                                 </p>
                                 <p class="tax-terms strategy">
                                    <span>Strategy: </span>
                                    <?php echo rtrim($strat_name, $comma); ?>
                                 </p>
                                 <div class="resource-foot">
                                    <p>
                                 </div>
                              </div>
                           </div>
                        </div>
            <?php }} wp_reset_postdata();?>
         </div>
      </div>
   </div>
</main>

<?php get_footer(); ?>
