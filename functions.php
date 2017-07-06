<?php

//Add all custom functions, hooks, filters, ajax etc here

include('functions/start.php');
include('functions/cpt.php');
include('functions/clean.php');

//Custon wp-admin logo
function my_custom_login_logo() {
  echo '<style type="text/css">
            h1 a {
              background-size: 227px 85px !important;
              margin-bottom: 20px !important;
              background-image:url('.get_bloginfo('template_directory').'/images/logo.png) !important; }
        </style>';
}


// Updates the map with new or updated listings on listing post-type update
function update_programs_map( $post_id ) {

    $post_type = get_post_type($post_id);
    
 
    if($post_type!="program" && $post_type!="hospital"){ return; }
    else{
    $p_id = get_the_ID();
    
    //The file location for the json file we're creating
    $directory = get_template_directory().'/helpers/programs.json';
    //The contents of the file, so we can check to see if it's empty or not.
    $program_file = file_get_contents($directory);
 
        $arr = array();
        $ids = array();
        
        $args = array(
          'post_type' => 'program',
          'posts_per_page'=> -1,
          'orderby' => 'title',
          'order' => 'asc',
          'post_status' => 'publish'
        );

        $program_query = new WP_Query($args );
 
         while ($program_query->have_posts()) { 

          global $post;
          $program_query->the_post();
           
          //Save the post ID to a variable
          $p_id = get_the_ID();

          //Get post info to save to our json file
          $title = get_the_title();
          $description = get_the_content();

          $contact_email = get_field('contact_email',$p_id);

      
          $the_id = (string)$p_id;
          $slug = $post->post_name;
 
          $separator_space = ' ';
          $separator_comma = ', ';
 
          // 
          $actives = get_the_terms($p_id , 'active');
          $is_active = '';
          $is_active_slug ='';

          if($actives){
            foreach ($actives as $active){
              $is_active .= $active->name . $separator_comma;
              $is_active_slug .= $active->slug . $separator_space;
            }
            $is_active = rtrim($is_active,', ');
            $is_active_slug = rtrim($is_active_slug," ");
          }

          //  
          $partners = get_the_terms($p_id , 'partners');
          $part = '';
          $part_slug ='';

          if($partners){
            foreach ($partners as $partner){
              $part .= $partner->name . $separator_comma;
              $part_slug .= $partner->slug . $separator_space;
            }
            $part = rtrim($part,', ');
            $part_slug = rtrim($part_slug," ");
          }

          // 
          $determinants = get_the_terms($p_id , 'sdh');
          $social_det = '';
          $social_det_slug = '';

          if($determinants){
            foreach ($determinants as $determinant){
              $social_det .= $determinant->name . $separator_comma;
              $social_det_slug .= $determinant->slug . $separator_space;
            }
            $social_det = rtrim($social_det,', ');
            $social_det_slug = rtrim($social_det_slug," ");

          }

          // 
          $t_pops = get_the_terms($p_id , 'target_pop');
          $target_pop = '';
          $target_pop_slug = '';

          if($t_pops){
            foreach ($t_pops as $t_pop){
              $target_pop .= $t_pop->name . $separator_comma;
              $target_pop_slug .= $t_pop->slug . $separator_space;
            }
            $target_pop = rtrim($target_pop,', ');
            $target_pop_slug = rtrim($target_pop_slug," ");
          }

          // 
          $p_settings = get_the_terms($p_id , 'program_setting');
          $settings = '';
          $settings_slug = '';

          if($p_settings!=''){
            foreach ($p_settings as $p_setting){
              $settings .= $p_setting->name . $separator_comma;
              $settings_slug .= $p_setting->slug . $separator_space;
            }
            $settings = rtrim($settings,', ');
            $settings_slug = rtrim($settings_slug," ");
          }

          $primary_sdh =  get_field('primary_sdh',$p_id);
          $primary_sdh_name = $primary_sdh->name;;
          $primary_sdh_slug = $primary_sdh->slug;;
 
 


          $hosp_id = get_field('hospital',$p_id);
 
          //Add all of the listing 'parts' to an array
          $a = [
              "id" => $the_id,
              "name" => $title,
              "slug"=> $slug,
              "description" => $description,
              "active" => $is_active,
              "active_slug" => $is_active_slug,
              "partners" => $part,
              "partners_slug" => $part_slug,
              "sdh" => $social_det,
              "sdh_slug" => $social_det_slug,
              "primary_sdh" => $primary_sdh_name,
              "primary_sdh_slug" => $primary_sdh_slug,
              "target_pop" => $target_pop,
              "target_pop_slug" => $target_pop_slug,
              "program_setting" => $settings,
              "program_setting_slug" => $settings_slug,
              "contact_email" => $contact_email,
              "hosp_id" => $hosp_id
 
          ];
 
            $arr[$the_id] = $a;

        }

        //Reset the query in-between loops
        wp_reset_query();

        // JSON-encode the response
        $json = json_encode($arr, JSON_PRETTY_PRINT);
 
         
        //Write to our file
        $myfile = fopen(''.$directory.'', "w") or die("Unable to open file!");
        fwrite($myfile, $json);
        fclose($myfile);  
 
        
    }
}

add_action('save_post', 'update_programs_map', 10, 3);

function update_hospital_map( $post_id ) {

    $post_type = get_post_type($post_id);
 
    if($post_type!="program" && $post_type!="hospital"){ return; }
    else{
    $p_id = get_the_ID();
    //The file location for the json file we're creating
    $directoryH = get_template_directory().'/helpers/hospitals.json';
    
    //The contents of the file, so we can check to see if it's empty or not.
    $hospital_file = file_get_contents($directoryH);
       
 
        $arr = array();
        $ids = array();
        
        $args = array(
          'post_type' => 'hospital',
          'posts_per_page'=> -1,
          'orderby' => 'title',
          'order' => 'asc',
          'post_status' => 'publish'
        );

        $hospital_query = new WP_Query($args );
 
        while ($hospital_query->have_posts()) { 

          global $post;
          $hospital_query->the_post();

          //Save the post ID to a variable
          $p_id = get_the_ID();

          //Get post info to save to our json file
          $title = get_the_title();
          $description = get_the_content();
 
          $the_id = (string)$p_id;

          $slug = $post->post_name;
          $name = get_field('hospital_name',$p_id);
          $address = get_field('hospital_address',$p_id);
          $city = get_field('hospital_city_state',$p_id);
          $zip = get_field('hospital_zip',$p_id);
          $lat = get_field('hospital_latitude',$p_id);
          $long = get_field('hospital_longitude',$p_id);
          $email = get_field('contact_email',$p_id);
 
          $separator_space = ' ';
          $separator_comma = ', ';

          //1
          $beds = get_the_terms($p_id, 'bed_size');
          $bed_name = '';
          $bed_slug = '';
          if($beds){
              foreach ($beds as $bed){
                $bed_name .= $bed->name . $separator_comma;
                $bed_slug .= $bed->slug . $separator_space;
              }
              $bed_name = rtrim($bed_name,', ');
              $bed_slug = rtrim($bed_slug," ");
          } 

          //2
          $payers = get_the_terms($p_id, 'percent_govt_payer');
          $govt_payer = '';
          $govt_payer_slug = '';

          if($payers){
            foreach ($payers as $payer){
              $govt_payer .= $payer->name . $separator_comma;
              $govt_payer_slug .= $payer->slug . $separator_space;
            }
            $govt_payer = rtrim($govt_payer,', ');
            $govt_payer_slug = rtrim($govt_payer_slug," ");
          }
          //3
          $ownerships = get_the_terms($p_id, 'ownership');
          $owners = '';
          $owners_slug = '';

          if($ownerships){
            foreach ($ownerships as $ownership){
              $owners .= $ownership->name . $separator_comma;
              $owners_slug .= $ownership->slug . $separator_space;
            }
            $owners = rtrim($owners,', ');
            $owners_slug = rtrim($owners_slug," ");
          }
          


          //4
          $t_statuses = get_the_terms($p_id, 'teaching_status');
          $teach = '';
          $teach_slug = '';

          if($t_statuses){
            foreach ($t_statuses as $t_status){
              $teach .= $t_status->name . $separator_comma;
              $teach_slug .= $t_status->slug . $separator_space;
            }
            $teach = rtrim($teach,', ');
            $teach_slug = rtrim($teach_slug," ");
          }

          //5
          $regions = get_the_terms($p_id, 'region');
          $reg = '';
          $reg_slug = '';
          if($regions){
            foreach ($regions as $region){
              $reg .= $region->name . $separator_comma;
              $reg_slug .= $region->slug . $separator_space;
            }
            $reg = rtrim($reg,', ');
            $reg_slug = rtrim($reg_slug," ");
          }
 
          //8
          $social_det_slug = '';
          $determinants = get_the_terms($p_id, 'sdh');
          if($determinants){
            
            $social_det_slug .= $determinants[0]->slug;
          }
          
 
 
          //11
          $pop_sizes = get_the_terms($p_id, 'pop_size');
          $pop_sz = '';
          $pop_sz_slug = '';

          if($pop_sizes){
            foreach ($pop_sizes as $pop_size){
              $pop_sz .= $pop_size->name . $separator_comma;
              $pop_sz_slug .= $pop_size->slug . $separator_space;
            }
            $pop_sz = rtrim($pop_sz,', ');
            $pop_sz_slug = rtrim($pop_sz_slug," ");
          }

          // 
          $below_fpls = get_the_terms($p_id, 'percent_below_fpl');
          $fpl = '';
          $fpl_slug = '';

          if($below_fpls){
            foreach ($below_fpls as $below_fpl){
              $fpl .= $below_fpl->name . $separator_comma;
              $fpl_slug .= $below_fpl->slug . $separator_space;
            }
            $fpl = rtrim($fpl,', ');
            $fpl_slug = rtrim($fpl_slug," ");
          }



          // 
          $percent_uninsureds = get_the_terms($p_id, 'percent_uninsured');
          $perc_uninsured = '';
          $perc_uninsured_slug = '';

          if($percent_uninsureds){
            foreach ($percent_uninsureds as $percent_uninsured){
              $perc_uninsured .= $percent_uninsured->name . $separator_comma;
              $perc_uninsured_slug .= $percent_uninsured->slug . $separator_space;
            }
            $perc_uninsured = rtrim($perc_uninsured,', ');
            $perc_uninsured_slug = rtrim($perc_uninsured_slug," ");
          }

           $p_args = array(
              'post_type' => 'program',
              'posts_per_page'=> -1,
              'post_status' => 'publish',
              'meta_key' => 'hospital',
              'meta_query' => array(
                  array(
                      'key' => 'hospital',
                      'compare' => '=',
                      'value' => $p_id,
                      ) 
                  )
              );

          $prog_query = new WP_Query( $p_args );
           
          $prog_ids = array();
          while ($prog_query->have_posts()) { $prog_query->the_post();
   
            $prog_id = $post->ID;
            
            array_push($prog_ids, $prog_id);
            
          }wp_reset_postdata();
            

          
          
           
      
          //Check to see if the latitude and longitude on the listing posttype are being used
          //If so, use those values to retrieve our location information for our map
          //If not, run the getCoordinates function to dynamically retrieve the lat and lng  
          if ($lat == '' && $long== '') {
            $f = $address . ' ' . $city . ' '. $zip; //Save the address, city, & zip to a variable to use in the getCoordinates function
            $coordinates = getCoordinates($f);
             $coordinates = getCoordinates($f);
            //If we got a good response from Google, update post_meta 
            $lat = $coordinates[0];
            $long = $coordinates[1];
            update_post_meta($p_id, 'hospital_latitude',  $lat);
            update_post_meta($p_id, 'hospital_longitude' , $long);
          } 
  
            //Add all of the listing 'parts' to an array
            //$prog_ids = meta_query of programs that contain the meta value of this hospital
            $a = [
              "id" => $the_id,
              "name" => $title,
              "slug"=> $slug,
              "address" => $address,
              "city" => $city,
              "zip" => $zip,
              "latitude" => $lat,
              "longitude" => $long,
              "bed_size" => $bed_name,
              "bed_size_slug" => $bed_slug,
              "percent_govt_payer" => $govt_payer,
              "percent_govt_payer_slug" => $govt_payer_slug,
              "ownership" => $owners,
              "ownership_slug" => $owners_slug,
              "teaching_status" => $teach,
              "teaching_status_slug" => $teach_slug,
              "region" => $reg,
              "region_slug" => $reg_slug,
              "sdh_slug" => $social_det_slug,
              "pop_size" => $pop_sz,
              "pop_size_slug" => $pop_sz_slug,
              "percent_below_fpl" => $fpl,
              "percent_below_fpl_slug" => $fpl_slug,
              "percent_uninsured" => $perc_uninsured,
              "percent_uninsured_slug" => $perc_uninsured_slug,
              "program_ids" => $prog_ids,
            ];
 

            $arr[$the_id] = $a;

        }
         //var_dump($ids);
        //Reset the query in-between loops
        wp_reset_query();

        // JSON-encode the response
        $json = json_encode($arr, JSON_PRETTY_PRINT);

        
        //if($hospital_file == ''){
        //Write to our file
        $myfile = fopen(''.$directoryH.'', "w") or die("Unable to open file!");
        fwrite($myfile, $json);
        fclose($myfile);  
         
    }
 }

 add_action('save_post', 'update_hospital_map', 10, 3);


 //Dynamically retrieve our lat lng info based on the address provided
//** See Override above for situations where the use of this function is overriden per lisitng post
function getCoordinates($address){

    //var_dump($response)
    $address = urlencode($address);

    $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=" . $address;
    $response = file_get_contents($url);
    $json = json_decode($response,true);

    //Check to see if we received a good response from GoogleMaps
    if ($json['status'] == 'OK'){
    $lat = $json['results'][0]['geometry']['location']['lat'];
    $lng = $json['results'][0]['geometry']['location']['lng'];

    //If not, set lat lng values to 0 
    //** This should be good to narrow down issues with a particular listing,
    //   as problem listings will return a 0 value lat lng in our json file
    }else{
    $lat = 0;
    $lng = 0;
    }

    return array($lat, $lng);

}

function get_resources(){
  $post_slug = $_POST['resource'];
  $post_slug_ct = $_POST['contentType'];
  $query = $_POST['query']; //*
  //var_dump($post_slug);
  //$query = $_POST('query');
 
 //Make the search exlusive to entries or clicking the filter
 if ($post_slug == '' && $post_slug_ct == " " ): //All posts? No filter
      $args = array(
      'post_type' => 'resources',
      'posts_per_page' => -1,
      'post_status' => 'publish'
      
      );
elseif ($post_slug != '' && $post_slug_ct != ''): //Using the filter - both filters have been used
      $args = array(
      'post_type' => 'resources',
      'posts_per_page' => -1,
      'post_status' => 'publish',
      //'s' => $query, //This is an 'and', so the query is effectively stopping here, if not commented out
      'tax_query' => array(
        'relation'=>'AND',
        array(
          'taxonomy' => 'member_topic',
          'field'    => 'slug',
          'terms'    => $post_slug, 
          ),
        array(
          'taxonomy' => 'content_type',
          'field'    => 'slug',
          'terms'    => $post_slug_ct, 
          ),
        ),
      );
 elseif ($post_slug != '' && $post_slug_ct == ''  ): //Using the filter - Topic filter used
      $args = array(
      'post_type' => 'resources',
      'posts_per_page' => -1,
      'post_status' => 'publish',
      //'s' => $query, //This is an 'and', so the query is effectively stopping here, if not commented out
      'tax_query' => array(
        array(
          'taxonomy' => 'member_topic',
          'field'    => 'slug',
          'terms'    => $post_slug, 
          ),
        ),
      );
elseif ($post_slug_ct != '' && $post_slug == ''  ): //Using the filter - Content filter used
      $args = array(
      'post_type' => 'resources',
      'posts_per_page' => -1,
      'post_status' => 'publish',
      //'s' => $query, //This is an 'and', so the query is effectively stopping here, if not commented out
      'tax_query' => array(
         array(
          'taxonomy' => 'content_type',
          'field'    => 'slug',
          'terms'    => $post_slug_ct, 
          ),
        ),
      );
else:  //If the search is used
      $args = array(
      'post_type' => 'resources',
      'posts_per_page' => -1,
      'post_status' => 'publish',
      's' => $query
      //
          
         // ),
        //),
      );
endif;
        // the query
      
        $the_query = new WP_Query( $args ); 
        //var_dump($args);
        $count = $the_query->found_posts;
        

       if ( $the_query->have_posts() ) : 
      // Do we have any posts in the databse that match our query?
      // In the case of the home page, this will call for the most recent posts 
      
        //echo '<div class="container '.$profile_class .'" id="project-gallery">';
         while ( $the_query->have_posts() ) : $the_query->the_post(); //We set up $the_query on line 144
        // If we have some posts to show, start a loop that will display each one the same way
        
        
         //if (have_rows ('project_gallery')): //Setup the panels between the top/bottom panels
               //Setup variables
               
                $the_title = get_the_title();
                $mr_link = get_field('mrf_link'); 
                
                $target = '';
                $curated = get_field('curated', $post->ID); 

                $date = get_the_date('m.d.y');
                $directory = get_bloginfo('template_directory');

                if ($curated == 'true'){
                        //$directory = bloginfo('template_directory');
                        $target ='<img src="'. $directory .'/assets/img/curated.png">';

                }else{
                        $target="";
                    } 

                $determinants= get_the_terms($post->ID, 'sdh');
                //var_dump($member_topics);
                $strategies= get_the_terms($post->ID, 'strategy');

                $short_title = get_the_title('', '', false);
                $shortened_title = substr($short_title, 0, 73);
                $length  =  strlen($short_title);
                
                if ($length >= 73){
                    $overflow = "overflow";

                }else{
                    $overflow="";
                }

                foreach ($determinants as $member_topic){
                    $dn = $member_topic->name;
                    $ds = $member_topic->slug;
                    //var_dump($mt);
                    //$mt_filter .= $member_topic->slug . ' ';
                }
                foreach ($content_types as $content_type){
                    $sn = $content_type->name;
                    $ss = $content_type->slug;
                    //$ct_filter .= $content_type->slug . ' ';
                }

          //endif; 
          echo '<div class="resource-item '. $ds . ' ' . $ss . '">
                    <div class="row">
                        <div class="one columns alpha the-date">' . $date .'</div>
                            <div class="seven columns the-title ' . $overflow .'">
                                <a href="' . $mr_link .'">
                                    <div class="orange_text"> '. $shortened_title . '</div>
                                </a>
                            </div>
                        <div class="two columns">
                            <div class="m-topic">' . $mt . '</div>
                        </div>
                        <div class="two columns omega">
                            <div class="c-type">.' . $ct . '</div>
                        </div>
                    </div>
                </div>';
         endwhile; 
       else : // Well, if there are no posts to display and loop through, let's apologize to the reader (also your 404 error) 
        
        echo '<article class="post-error">
                <h3 class="404">
                  Your search did not produce any results!</br>
                
                  Please use a different search term, or try something more specific.
                </h3>
              </article>';
       endif; // OK, I think that takes care of both scenarios (having posts or not having any posts) 
       die();//if this isn't included, you will get funky characters at the end of your query results.
}

//AJAX Discussion

// add_action('wp_ajax_get_discussions', 'get_discussions');  
// add_action('wp_ajax_nopriv_get_discussions', 'get_discussions'); 

// function get_discussions(){
//   $post_slug = $_POST['discussionListing'];
//   //$post_slug_ct = $_POST['contentType'];
//   $query = $_POST['query']; //*
//   //var_dump($post_slug);
//   //$query = $_POST('query');
 
// if ($query == ''): //if the search filter is used

//  //Make the search exlusive to entries or clicking the filter
//  if ($post_slug == '' ): //All posts? No filter
//       $args = array(
//       'post_type' => 'discussions',
//       'posts_per_page' => -1,
//       'post_status' => 'publish'
      
//       );

//  elseif ($post_slug != ''  ): //Using the filter - Topic filter used
//       $args = array(
//       'post_type' => 'discussions',
//       'posts_per_page' => -1,
//       'post_status' => 'publish',
//       //'s' => $query, //This is an 'and', so the query is effectively stopping here, if not commented out
//       'tax_query' => array(
//         array(
//           'taxonomy' => 'member_topic',
//           'field'    => 'slug',
//           'terms'    => $post_slug, 
//           ),
//         ),
//       );
//  endif; //end sub if


// else:  //If the search is used
//       $args = array(
//       'post_type' => 'discussions',
//       'posts_per_page' => -1,
//       'post_status' => 'publish',
//       's' => $query
//       //
          
//          // ),
//         //),
//       );
// endif;
//         // the query
      
//         $the_query_d = new WP_Query( $args ); 
//         //var_dump($args);
//         $count = $the_query_d->found_posts;
        

//        if ( $the_query_d->have_posts() ) : 
//       // Do we have any posts in the databse that match our query?
//       // In the case of the home page, this will call for the most recent posts 
      
//         //echo '<div class="container '.$profile_class .'" id="project-gallery">';
//          while ( $the_query_d->have_posts() ) : $the_query_d->the_post(); //We set up $the_query on line 144
//         // If we have some posts to show, start a loop that will display each one the same way
        
        
//          //if (have_rows ('project_gallery')): //Setup the panels between the top/bottom panels
//                //Setup variables
               
//                 $the_title = get_the_title();
//                 $dt_link = get_the_permalink();
                
//                 $target = '';
//                 $curated = get_field('curated', $post->ID); 

//                 $date = get_the_date('m.d.y');
//                 $directory = get_bloginfo('template_directory');

//                 if ($curated == 'true'){
//                         //$directory = bloginfo('template_directory');
//                         $target ='<img src="'. $directory .'/assets/img/curated.png">';

//                 }else{
//                         $target="";
//                     } 

//                 $discussion_topics = get_the_terms($post->ID, 'member_topic');
//                 //var_dump($discussion_topics);
//                 //var_dump($member_topics);
//                 //$content_types= get_the_terms($post->ID, 'content_type');

//                 $short_title = get_the_title('', '', false);
//                 $shortened_title = substr($short_title, 0, 110);
//                 $length  =  strlen($short_title);
                
//                 if ($length >= 110){
//                     $overflow = "overflow";

//                 }else{
//                     $overflow="";
//                 }

//                 foreach ($discussion_topics as $discussion_topic){
//                     $dt = $discussion_topic->name;
//                     $ds = $discussion_topic->slug;
//                     //var_dump($mt);
//                     //$mt_filter .= $member_topic->slug . ' ';
//                 }
//                 foreach ($content_types as $content_type){
//                     //$ct = $content_type->slug;
//                     //$ct_filter .= $content_type->slug . ' ';
//                 }

//           //endif; 
//           echo '<div class="discussion-item '. $ds . ' ' . $ds . '">
//                     <div class="row">
//                         <div class="one columns alpha the-date">' . $date .'</div>
//                             <div class="eight columns the-title ' . $overflow .'">
//                                 <a href="' . $dt_link .'">
//                                     <div class="orange_text"> '. $shortened_title . '</div>
//                                 </a>
//                             </div><!-- end the-title -->
//                         <div class="three columns">
//                             <div class="m-topic">' . $dt . '</div>
//                         </div> <!--end three columns -->
//                         </div>
//                     </div>
//                 </div>';
//          endwhile; 
//        else : // Well, if there are no posts to display and loop through, let's apologize to the reader (also your 404 error) 
        
//         echo '<article class="post-error">
//                 <h3 class="404">
//                   Your search did not produce any results!</br>
                
//                   Please use a different search term, or try something more specific.
//                 </h3>
//               </article>';
//        endif; // OK, I think that takes care of both scenarios (having posts or not having any posts) 
//        die();//if this isn't included, you will get funky characters at the end of your query results.
// }


?>