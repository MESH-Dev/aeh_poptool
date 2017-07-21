

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
   <div class="container resource-container">
      <div class="row">
         <div class="resource-toolbar columns-4">
            <div class="search-container">
               <form id="resource-form" action="" method="get">
                  <label for="resource-search" class="sr-only">Search Programs</label>
                  <input type="text" id="resource-search" name="s" value="" placeholder="Search">
                  <button type="submit" id="resource-submit" name="s" value="»"><span>»</span></button>
               </form>
            </div>
            <div class="resource-filters">
               <div class="row filter">
                  <p>Filter by:</p> <span id="filterClear" >CLEAR ALL X</span>
               </div>
               <!-- <div class="row">
                  <div class="filter-posttext">
                     <p id="results-indicator">
                        <span id="results-count"></span>
                        Results:
                     </p>
                     <div id="filter-string" class="category">
                        <p>Showing all prorams</p>
                     </div>
                  </div>
               </div> -->
               <!--Social Determinant-->
               <fieldset class="checkers filter-group">
                  <legend><h2>Social Determinant <span>check all that apply</span></h2></legend>
                   <div class="checkboxes filters determinant">
                     <div class="row">

                           <?php $sdh_filters= get_terms(array('taxonomy'=>'sdh', 'hide_empty'=>false));
                              $sdh_cnt=0;
                              
                              $sdh_count = count($sdh_filters);
                              $sdh_half = $sdh_count/2;
                              $sdh_round = round($sdh_half);
                              //var_dump($sdh_count);
                              foreach ($sdh_filters as $sdh_filter){ 
                                 $sdh_cnt++;                                 
                              if($sdh_count > 5 && $sdh_cnt == 1){ ?>
                              <div class="columns-6 start">
                              <?php }
                                 ?>
                              <?php if($sdh_count > 5 && $sdh_cnt == $sdh_round+1){ ?>
                              </div><div class='columns-6 next'>
                              <?php } ?>
                              <label for="id-<?php echo $sdh_filter->slug ?>">
                                 <input type="checkbox" id="id-<?php echo $sdh_filter->slug ?>" name="check-<?php echo $sdh_filter->slug ?>" data-filter='<?php echo $sdh_filter->slug ?>' data-valname="<?php echo $sdh_filter->name; ?>" value=".<?php echo $sdh_filter->slug; ?>">
                                    <div class="indicator"></div>   
                                    <?php echo $sdh_filter->name; ?>
                                 </input>
                              </label>
                              <?php } ?>
                              <?php if($sdh_count > 5 && $sdh_count-$sdh_cnt == 0){?>
                              </div>
                           <?php } ?>
                     </div>
                  </div>
               </fieldset>
               <!-- ++++++++++++++ -->

               <!--Strategy-->
               <fieldset class="checkers filter-group">
                  <legend><h2>Strategy <span>check all that apply</span></h2></legend>
                   <div class="checkboxes filters strategy">

                     <?php $strategy_filters= get_terms(array('taxonomy'=>'strategy', 'hide_empty'=>false)); 
                           $strat_cnt=0;

                           $strat_count = count($strategy_filters);
                              $strat_half = $strat_count/2;
                              $strat_round = round($strat_half);
                     ?>

                              <?php foreach ($strategy_filters as $strategy_filter){  
                                 $strat_cnt++;
                               if($strat_count > 5 && $strat_cnt == 1){ ?>
                                 <div class="columns-6 start">
                              <?php }
                                 ?>
                                 <?php if($strat_count > 5 && $strat_cnt == $strat_round+1){ ?>
                              </div><div class='columns-6 next'>
                              <?php } ?>
                              <label for="id-<?php echo $strategy_filter->slug ?>">
                                 <input type="checkbox" id="id-<?php echo $strategy_filter->slug ?>" name="check-<?php echo $strategy_filter->slug ?>" data-filter='<?php echo $strategy_filter->slug ?>' data-valname="<?php echo $strategy_filter->name ?>" value=".<?php echo $strategy_filter->name; ?>">
                                    <div class="indicator"></div>
                                    <?php echo $strategy_filter->name ?>
                                 </input>
                              </label>
                               <?php } ?>
                              <?php if($strat_count > 5 && $strat_count-$strat_cnt == 0){?>
                              </div>
                              <?php } ?>
                     </div>
               </fieldset>
            </div>
         <div class="row">
            <div class="apply-filters functions">
               Apply Filters »
            </div>  
            <!-- <div class="remove-filters functions">
               Clear All X
            </div>   -->
         </div>
         </div>
     <!--  </div>
   </div> -->
   <script>
   
   </script>
   <div class="columns-8 no-padding resource-results">
   <!-- <div class="container">
      <div class="row"> -->

         <div class="loader-container hide">
            <div class="loader">
               <!-- <h1>Loading...</h1> -->
               <img src="<?php bloginfo('template_directory')?>/img/loader1.svg">
            </div>
         </div>
         
         <div class="resource-grid">
            
            <?php 
            global $query_string;
                        $args = array(
                           'post_type' => 'resource',
                           'posts_per_page' => -1,
                        );

                        $the_query = new WP_Query($args);
                        //var_dump($query);

                        if ($the_query->have_posts()){
                           $r_cnt=0;
                           while($the_query->have_posts()){ $the_query->the_post();
                              //var_dump($query);
                              $r_cnt++;
                              $comma = ', ';
                              $separator=' ';

                              $primary_sdh_resource = get_field('primary_sdh_resource', $post->ID);
                              $resource_intro = get_field('resource_introduction', $post->ID);
                              $resource_content = get_field('resource_content', $post->ID);
                              
                              if($primary_sdh_resource != ''){
                                 $primary_sdh_name = $primary_sdh_resource->name;
                                 $primary_sdh_slug = $primary_sdh_resource->slug;
                              }

                              $resource_author=get_field('resource_author', $post->ID);
                              $resource_link = get_field('resource_link', $post->ID);
                              
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
                                 <div class="resource-inner" style="padding-right:10px;">
                                 <?php if($primary_sdh_resource !=''){?>
                                 <div class="resource-head">
                                    <p><?php echo $primary_sdh_name; ?></p>
                                    <img class="category-icon" src="<?php bloginfo('template_directory'); ?>/img/icons/<?php echo $primary_sdh_slug ?>.svg">
                                 </div>
                                 <?php } ?>
                                 <div class="content">
                                 <h2><?php echo the_title();?></h2>
                                 <div class="author">
                                    <?php echo $resource_author; ?>
                                 </div>
                                    <p class="resource-intro">
                                       <?php echo $resource_intro; ?>
                                    </p>
                                    <?php echo $resource_content; ?>
                                    <?php //echo the_content(); ?>
                                
                                 <p class="tax-terms s-determinants">
                                    <span>Social Determinants: </span>
                                    <?php echo rtrim($sdh_name, $comma); ?>
                                 </p>
                                 <p class="tax-terms strategy">
                                    <span>Strategy: </span>
                                    <?php echo rtrim($strat_name, $comma); ?>
                                 </p>
                                  </div>
                                 <div class="resource-foot">
                                    <p class="expand">
                                       <span class="text">Expand</span> <img src="<?php bloginfo('template_directory')?>/img/backarrow.svg">
                                    </p>
                                    <p class="resource-link">
                                       <a href="<?php echo $resource_link; ?>" target="_blank">Full Resource »</a>
                                    </p>
                                 </div>
                              </div></div>
                           </div>
                        </div>
            <?php }} wp_reset_postdata();?>
            
         </div>

      </div>
   </div>
</main>

<?php get_footer(); ?>
