<?php /* Template Name: Map Tool Template*/

get_header();?>

<style>
.mix{
    display: none;
}

.collapsable-content{
   display: none;
   overflow: hidden;
}

.listing-interface .detail-nav-bottom .collapse .button-text {
    margin: 0px 10px 0px 0px;
}

.listing-interface .detail-nav-bottom .collapse {
    float: right;
}

.listing-interface .detail-nav-bottom .button-arrow{
   transform: rotate(180deg);
}


</style>
<main class="map-tool-page" id="content">


   <div id="map-listing-button">
      <div id="map-tab"><a>VIEW MAP</a></div><div id="listing-tab"><a>RESULTS &amp; FILTERS</a></div>
   </div>

   <div id="searchModal" class="searchmodal">
      <svg id="searchModalClose" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
      </svg>
      <div id="modalNonFilter">
         <?php 
            $modal_title = get_field('modal_title');
            $intro = get_field('introduction');
            $instruction = get_field('instruction_paragraph');
            $dismiss = get_field('dismiss_link_text');
         ?>
         <h2 class=""><?php echo $modal_title; ?></h2>
         <p><?php echo $intro; ?></p>
         <p><?php echo $instruction; ?> <a id="landingBrowsePrograms"><?php echo $dismiss?></a></p>
         <div class="search-container row">
            <form id="landing-form">
            <input type="text" id="landing-search" value="" placeholder="Search Programs">
            <input type="submit" id="landing-submit" name="" value="»">
            </form>
         </div>
      </div>
   </div>

      


   <div id="listingInterface" class="listing-interface">
      <div id="selectionView">

         <div class="search-container">
            <input type="text" id="program-search"  value="" placeholder="Search Programs">
            <input type="submit" name="" value="»">
         </div>

         <div class="filter-pretext">
            <p id="filter-by">FILTER BY:</p>
            <a id="filterClear" href="#">CLEAR ALL X</a>
         </div>
         <div class="trigger-container">
            <a class="dropdown-trigger" id="hospitalTrigger">
               HOSPITAL
               <span id="hospitalTrigger">»</span>
            </a><a class="dropdown-trigger" id="communityTrigger">
               COMMUNITY
               <span id="communityTrigger">»</span>
            </a><a class="dropdown-trigger" id="programTrigger">
               PROGRAM
               <span id="programTrigger">»</span>
            </a>
         </div>

         <div id="nonFilterContent">

            <div class="filter-posttext">
               <p id="results-indicator"><span id="results-count"></span> RESULTS:</p>
               <div id="filter-string" class="category">
                  <p></p>
                   
               </div>
            </div>


            <div class="listing-blocks-container">
               <ul id="program-cards" class="listing-blocks">
                  <!-- ==================== PROGRAM CARDS GO HERE ==================== -->
               </ul>
               <div class="nothing-found" style="color: #f05133;
    font-size: 13px;
    font-weight: bold;
    border: 1px solid #f05133;
    width: 99%;
    padding: 10px;
    background-color: #fdedea; display:none">
                  No programs found. Please modify your filter or search input.
               </div>
            </div>
         </div>

      </div>


      <div class="filters" id="filterContainer">
         <div id="hospitalFilters">
               <fieldset class="filter-group checkers">
                  <h2>Bed size</h2>
                  <div class="checkboxes">
                  <?php $bed_filters= get_terms(array('taxonomy'=>'bed_size', 'hide_empty'=>false));

                     foreach ($bed_filters as $bed_filter){ ?>
                     <label>
                        <input type="checkbox" name="bed_size" data-valname="<?php echo $bed_filter->name; ?>" value=".<?php echo $bed_filter->slug; ?>">
                        <div class="indicator"></div>
                        <?php echo $bed_filter->name; ?>
                     </label>
                  <?php } ?>
                  </div>
                   <h2>%Govt payer</h2>
                   <div class="checkboxes">
                  <?php $govt_filters= get_terms(array('taxonomy'=>'percent_govt_payer', 'hide_empty'=>false));

                     foreach ($govt_filters as $govt_filter){ ?>
                     <label>
                        <input type="checkbox" name="percent_govt_payer" data-valname="<?php echo $govt_filter->name; ?>" value=".<?php echo $govt_filter->slug; ?>">
                        <div class="indicator"></div>
                        <?php echo $govt_filter->name; ?>
                     </label>
                  <?php } ?>
                  </div>
                   <h2>Ownership</h2>
                   <div class="radio-buttons">
                  <?php $own_filters= get_terms(array('taxonomy'=>'ownership', 'hide_empty'=>false));

                     foreach ($own_filters as $own_filter){ ?>
                     <label>
                        <input type="radio" name="ownership" data-valname="<?php echo $own_filter->name; ?>" value=".<?php echo $own_filter->slug; ?>">
                        <div class="indicator"></div>
                        <?php echo $own_filter->name; ?>
                     </label>
                  <?php } ?>
                  </div>
                  <h2>Teaching Status</h2>
                  <div class="radio-buttons">
                   <?php $teach_filters= get_terms(array('taxonomy'=>'teaching_status', 'hide_empty'=>false));

                     foreach ($teach_filters as $teach_filter){ ?>
                     <label>
                        <input type="radio" name="teaching_status" data-valname="<?php echo $teach_filter->name; ?>" value=".<?php echo $teach_filter->slug; ?>">
                        <div class="indicator"></div>
                        <?php echo $teach_filter->name; ?>
                     </label>
                  <?php } ?>
                  </div>
                  <h2>Region</h2>
                  <div class="checkboxes">
                   <?php $region_filters= get_terms(array('taxonomy'=>'region','hide_empty'=>false));

                     foreach ($region_filters as $region_filter){ ?>
                     <label>
                        <input type="checkbox" name="region" data-valname="<?php echo $region_filter->name; ?>" value=".<?php echo $region_filter->slug; ?>">
                        <div class="indicator"></div>
                        <?php echo $region_filter->name; ?>
                     </label>
                  <?php } ?>
                  </div>
               </fieldset>

         </div>


         <div id="communityFilters">
            <fieldset class="filter-group checkers">
               <div class="checkboxes">
                <h2>Pop Size</h2>
                <?php $pop_filters= get_terms(array('taxonomy'=>'pop_size','hide_empty'=>false));

                  foreach ($pop_filters as $pop_filter){ ?>
                  <label>
                     <input type="checkbox" name="pop_size" data-valname="<?php echo $pop_filter->name; ?>" value=".<?php echo $pop_filter->slug; ?>">
                     <div class="indicator"></div>
                     <?php echo $pop_filter->name; ?>
                  </label>
               <?php } ?>
               </div>
               <h2>% Below FPL</h2>
               <div class="checkboxes">
                <?php $fpl_filters= get_terms(array('taxonomy'=>'percent_below_fpl','hide_empty'=>false));

                  foreach ($fpl_filters as $fpl_filter){ ?>
                  <label>
                     <input type="checkbox" name="percent_below_fpl" data-valname="<?php echo $fpl_filter->name; ?>" value=".<?php echo $fpl_filter->slug; ?>">
                     <div class="indicator"></div>
                     <?php echo $fpl_filter->name; ?>
                  </label>
               <?php } ?>
               </div>
               <h2>% Uninsured</h2>
               <div class="checkboxes">
                <?php $uninsured_filters= get_terms(array('taxonomy'=>'percent_uninsured','hide_empty'=>false));

                  foreach ($uninsured_filters as $uninsured_filter){ ?>
                  <label>
                     <input type="checkbox" name="percent_uninsured" data-valname="<?php echo $uninsured_filter->name; ?>" value=".<?php echo $uninsured_filter->slug; ?>">
                     <div class="indicator"></div>
                     <?php echo $uninsured_filter->name; ?>
                  </label>
               <?php } ?>
               </div>
            </fieldset>
         </div>

         <div id="programFilters">
            <fieldset class="filter-group checkers">
               <h2>Active</h2>
               <div class="radio-buttons">
                <?php $active_filters= get_terms(array('taxonomy'=>'active','hide_empty'=>false));

                  foreach ($active_filters as $active_filter){ ?>
                  <label>
                     <input type="radio" name="active"  data-valname="<?php echo $active_filter->name; ?>" value=".<?php echo $active_filter->slug; ?>">

                     <div class="indicator"></div>
                     <?php echo $active_filter->name; ?>
                  </label>
               <?php } ?>
               </div>
               <h2>Partners</h2>
               <div class="checkboxes">
                <?php $partner_filters= get_terms(array('taxonomy'=>'partners','hide_empty'=>false));

                  foreach ($partner_filters as $partner_filter){ ?>
                  <label>
                     <input type="checkbox" name="partners" data-valname="<?php echo $partner_filter->name; ?>" value=".<?php echo $partner_filter->slug; ?>">
                     <div class="indicator"></div>
                     <?php echo $partner_filter->name; ?>
                  </label>
               <?php } ?>
               </div>
               <h2>Social Determinants</h2>
               <div class="checkboxes">
                <?php $sdh_filters= get_terms(array('taxonomy'=>'sdh','hide_empty'=>false));

                  foreach ($sdh_filters as $sdh_filter){ ?>
                  <label>
                     <input type="checkbox" name="sdh" data-valname="<?php echo $sdh_filter->name; ?>" value=".<?php echo $sdh_filter->slug; ?>">
                     <div class="indicator"></div>
                     <?php echo $sdh_filter->name; ?>
                  </label>
               <?php } ?>
               </div>
               <h2>Target Pop</h2>
               <div class="checkboxes">
                <?php $tp_filters= get_terms(array('taxonomy'=>'target_pop','hide_empty'=>false));

                  foreach ($tp_filters as $tp_filter){ ?>
                  <label>
                     <input type="checkbox" name="target_pop" data-valname="<?php echo $tp_filter->name; ?>" value=".<?php echo $tp_filter->slug; ?>">
                     <div class="indicator"></div>
                     <?php echo $tp_filter->name; ?>
                  </label>
               <?php } ?>
               </div>
               <h2>Program Setting</h2>
               <div class="radio-buttons">
                <?php $program_filters= get_terms(array('taxonomy'=>'program_setting','hide_empty'=>false));

                  foreach ($program_filters as $program_filter){ ?>
                  <label>
                     <input type="radio" name="program_setting" data-valname="<?php echo $program_filter->name; ?>" value=".<?php echo $program_filter->slug; ?>">
                     <div class="indicator"></div>
                     <?php echo $program_filter->name; ?>
                  </label>
               <?php } ?>
               </div>
            </fieldset>
         </div>
      </div>

      <div class="filter-bottom-nav" id="filterBottomNav">
         <div class="filter-nav-border">
            <a id="cancelFilters">Cancel</a>
            <a id="applyFilters">Apply Filters »</a>
         </div>
      </div>


      <div id="detailPane">

         <div class="detail-nav" id="detailNavTop">
            <div class="detail-nav-border">
               <div class="navigation-button" id="backButton">
                  <svg class="button-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 25">
                     <defs>
                      <style>
                        .cls-1 {
                          fill: #0d97d4;
                          fill-rule: evenodd;
                        }
                      </style>
                     </defs>
                     <path class="cls-1" d="M56,2223l-12,11.94L56,2248v-4.28l-7.925-8.78L56,2226.83V2223Z" transform="translate(-44 -2223)"/>
                  </svg><p class="button-text">BACK</p>
               </div>
               <p id="hospital_title" class="program-hospital"> </p>
            </div>
         </div>


         <div id="detailPaneContent" class="detail-block-container">
            <div class="indiv-detail-block">
               <div id="collapsableContent"></div>
            </div>
            <div class="detail-nav detail-nav-bottom">
               <div class="detail-nav-border">
                  <div class="navigation-button" id="collapse">
                     <a class="button-text">COLLAPSE</a>
                     <svg id="collapseArrow" class="button-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 12">
                          <defs>
                            <style>
                              .cls-1 {
                                fill: #0d97d4;
                              }
                            </style>
                          </defs>
                           <title>uparrow</title>
                           <path class="cls-1" d="M25,12,13.06,0,0,12H4.28l8.78-7.92L21.17,12Z"/>
                     </svg>
                  </div>
               </div>
            </div>
         </div> <!-- #detailPaneContent -->

      </div><!-- #detailPane -->

   </div> <!-- #listingInterface -->


   <div id="map"></div>

</main>
<?php get_footer(); ?>
