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
    
    //echo $p_id;
    //echo $post_id;
     if("program" != $post_type){ return; }
     else{
     $p_id = get_the_ID();
    //The file location for the json file we're creating
    $directory = get_template_directory().'/helpers/programs.json';
    //The contents of the file, so we can check to see if it's empty or not.
    $program_file = file_get_contents($directory);
       
    //}else{
    	//if($program_file == ''){
        $arr = array();
        $ids = array();
        
        $args = array(
          'post_type' => 'program',
          'posts_per_page'=> -1,
          'orderby' => 'title',
          'order' => 'asc',
          'post_status' => 'publish'
        );

        query_posts( $args );
        //$ct = 0;
        while (have_posts()) { the_post();
          //$ct++;
          //Save the post ID to a variable
          $p_id = get_the_ID();

          //Get post info to save to our json file
          $title = get_the_title();
          $description = get_the_content();

          GLOBAL $post;
          $the_id = (string)$p_id;
          $slug = $post->post_name;
          $name = get_field('hospital_name',$post_id);
          $address = get_field('hospital_address',$post_id);
          $city = get_field('hospital_city_state',$post_id);
          $zip = get_field('hospital_zip',$post_id);
          $lat = get_field('hospital_latitude',$post_id);
          $long = get_field('hospital_longitude',$post_id);
          $email = get_field('contact_email',$post_id);
          $hosp_id = get_field('hospital',$post->ID);
          //var_dump($hosp_id);
          //$website = get_field('web_address');
       		//$phone = get_field('phone_number');
          //$zip = get_field('zip');
          //$primary_section = get_the_terms($p_id, 'primary_section'); 
          //var_dump($primary_section);
          //$color = get_term_meta($primary_section[0]->term_id, 'color');
          //__Get the categories for the post, we'll break it up below
          //$listing_cats = get_the_category($p_id); 
          //----
          $separator = ' ';

            //1
          $beds = get_the_terms($post_id, 'bed_size');
          $bed_name = '';
          $bed_slug = '';
          if($beds){
            foreach ($beds as $bed){
              $bed_name .= $bed->name . $separator;
              $bed_slug .= $bed->slug . $separator;
            }
        } 

          //2
          $payers = get_the_terms($post_id, 'percent_govt_payer');
          $govt_payer = '';
          $govt_payer_slug = '';

          if($payers){
            foreach ($payers as $payer){
              $govt_payer .= $payer->name . $separator;
              $govt_payer_slug .= $payer->slug . $separator;
            }
          }
          //3
          $ownerships = get_the_terms($post_id, 'ownership');
          $owners = '';
          $owners_slug = '';

          if($ownerships){
            foreach ($ownerships as $ownership){
              $owners .= $ownership->name . $separator;
              $owners_slug .= $ownership->slug . $separator;
            }
          }
          


          //4
          $t_statuses = get_the_terms($post_id, 'teaching_status');
          $teach = '';
          $teach_slug = '';

          if($t_statuses){
            foreach ($t_statuses as $t_status){
              $teach .= $t_status->name . $separator;
              $teach_slug .= $t_status->slug . $separator;
            }
          }

          //5
          $regions = get_the_terms($post_id, 'region');
          $reg = '';
          $reg_slug = '';
          if($regions){
            foreach ($regions as $region){
              $reg .= $region->name . $separator;
              $reg_slug .= $region->slug . $separator;
            }
          }

          //6
          $actives = get_the_terms($post_id, 'active');
          $is_active = '';
          $is_active_slug ='';

          if($actives){
            foreach ($actives as $active){
              $is_active .= $active->name . $separator;
              $is_active_slug .= $active->slug . $separator;
            }
          }

          //7
          $partners = get_the_terms($post_id, 'partners');
          $part = '';
          $part_slug ='';

          if($partners){
            foreach ($partners as $partner){
              $part .= $partner->name . $separator;
              $part_slug .= $partner->slug . $separator;
            }
          }

          //8
          $determinants = get_the_terms($post_id, 'sdh');
          $social_det = '';
          $social_det_slug = '';

          if($determinants){
            foreach ($determinants as $determinant){
              $social_det .= $determinant->name . $separator;
              $social_det_slug .= $determinant->slug . $separator;
            }
          }

          //9
          $t_pops = get_the_terms($post_id, 'target_pop');
          $target_pop = '';
          $target_pop_slug = '';

          if($t_pops){
            foreach ($t_pops as $t_pop){
              $target_pop .= $t_pop->name . $separator;
              $target_pop_slug .= $t_pop->slug . $separator;
            }
          }

          //10
          $p_settings = get_the_terms($post_id, 'program_setting');
          $settings = '';
          $settings_slug = '';

          if($p_settings!=''){
            foreach ($p_settings as $p_setting){
              $settings .= $p_setting->name . $separator;
              $settings_slug .= $p_setting->slug . $separator;
            }
          }

          //11
          $pop_sizes = get_the_terms($post_id, 'pop_size');
          $pop_sz = '';
          $pop_sz_slug = '';

          if($pop_sizes){
            foreach ($pop_sizes as $pop_size){
              $pop_sz .= $pop_size->name . $separator;
              $pop_sz_slug .= $pop_size->slug . $separator;
            }
          }

          //12
          $below_fpls = get_the_terms($post_id, 'percent_below_fpl');
          $fpl = '';
          $fpl_slug = '';

          if($below_fpls){
            foreach ($below_fpls as $below_fpl){
              $fpl .= $below_fpl->name . $separator;
              $fpl_slug .= $below_fpl->slug . $separator;
            }
          }

          //13
          $percent_uninsureds = get_the_terms($post_id, 'percent_uninsured');
          $perc_uninsured = '';
          $perc_uninsured_slug = '';

          if($percent_uninsureds){
            foreach ($percent_uninsureds as $percent_uninsured){
              $perc_uninsured .= $percent_uninsured->name . $separator;
              $perc_uninsured_slug .= $percent_uninsured->slug . $separator;
            }
          }

          if ($hosp_id != ''){
            $h_id = $hosp_id;
          }else{
            $h_id = '';
          }
          //get one category by splitting the value from above
          // foreach ($listing_cats as $cat) {
          //    $listing_category = $cat->slug;
          //    $listing_name = $cat->name;
          //    break;
          // }
         
 		  // foreach ($primary_section as $ps){
 		  // 	$primary_sec = $ps->name;
 		  // 	break;
 		  // }

          
          //$logo = wp_get_attachment_url(get_post_thumbnail_id());

          //$business_category = get_field('business_category');

          //Save the address, city, & zip to a variable to use in the getCoordinates function
          $f = $address . ' ' . $city . ' '. $zip;
           
          //Override   
          //Check to see if the latitude and longitude overides on the listing posttype are being used
          //If so, use those values to retrieve our location information for our map
          //If not, run the getCoordinates function to dynamically retrieve the lat and lng  
          if (get_field('latitude') && get_field('longitude')) {
            $lat = get_field('hospital_latitude');
            $long = get_field('hospital_longitude');
            $coordinates = array((float)$lat, (float)$long);
          }else{
            $coordinates = getCoordinates($f);
          }
  
            //Add all of the listing 'parts' to an array
            $a = [
               "id" => $the_id,
              "name" => $title,
              "slug"=> $slug,
              "description" => $description,
              // "address" => $address,
              // "city" => $city,
              // "zip" => $zip,
              // "latitude" => $lat,
              // "longitude" => $long,
              //"coordinates" => $coordinates,
              // "bed_size" => $bed_name,
              // "bed_size_slug" => $bed_slug,
              // "percent_govt_payer" => $govt_payer,
              // "percent_govt_payer_slug" => $govt_payer,
              // "ownership" => $owners,
              // "ownership_slug" => $owners,
              // "teaching_status" => $teach,
              // "teaching_status_slug" => $teach,
              // "region" => $reg,
              // "region_slug" => $reg_slug,
              "active" => $is_active,
              "active_slug" => $is_active_slug,
              "partners" => $part,
              "partners_slug" => $part_slug,
              "sdh" => $social_det,
              "sdh_slug" => $social_det_slug,
              "target_pop" => $target_pop,
              "target_pop_slug" => $target_pop_slug,
              "program_setting" => $settings,
              "program_setting_slug" => $settings_slug,
              "hosp_id" => $h_id
              // "pop_size" => $pop_sz,
              // "pop_size_slug" => $pop_sz_slug,
              // "percent_below_fpl" => $fpl,
              // "percent_below_fpl_slug" => $fpl_slug,
              // "percent_uninsured" => $perc_uninsured,
              // "percent_uninsured_slug" => $perc_uninsured_slug,
            ];

            // $id = [
            //   $the_id => $a
            // ];

            // array_push($arr, $id);
            $arr[$the_id] = $a;

        }

        //Reset the query in-between loops
        wp_reset_query();

        // JSON-encode the response
        $json = json_encode($arr, JSON_PRETTY_PRINT);

        
        //if($program_file == ''){
        //Write to our file
        $myfile = fopen(''.$directory.'', "w") or die("Unable to open file!");
        fwrite($myfile, $json);
        fclose($myfile);  
     //    }else{
     //    	$json_string = file_get_contents($directory);
    	// 	//var_dump($json_string);
	    // 	$data = json_decode($json_string, true);
	    // 	//var_dump($data);
	    // 	//$data[1]['title'] = 'isThisThingWorking';

	    // 	foreach($data as $key => $program){
	    // 		//echo $program['ID'];
	    // 		//echo $program['title'];
	    // 		if($post_id == $program['ID']){
	    // 			global $post;
	  		// 		//echo $post_id;
	  		// 		//echo $program['ID'];
					// // $data[$key]['ID'] = $the_id;
					// // echo $the_id;
					// //$data[$key]['title'] = 'UPDATED';
					// //$data[$key]['title'] = $title;
					// $data[$key]['title'] = get_the_title($post_id);
					//  //echo get_the_title($post_id);
					// $data[$key]['description'] = get_the_content($post_id);
					// $data[$key]['slug']= $post->post_name;
					// $data[$key]['name'] = $name;
					// $data[$key]['address'] = $address;
					// $data[$key]['city'] = $city;
					// $data[$key]['zip'] = $zip;
					// $data[$key]['coordinates'] = $coordinates;
					// $data[$key]['bed_size'] = $bed_name;
					// $data[$key]['percent_govt_payer'] = $govt_payer;
					// $data[$key]['ownership'] = $owners;
					// $data[$key]['teaching_status'] = $teach;
					// $data[$key]['region'] = $reg;
					// $data[$key]['active'] = $is_active;
					// $data[$key]['partners'] = $part;
					// $data[$key]['sdh'] = $social_det;
					// $data[$key]['target_pop'] = $target_pop;
					// $data[$key]['program_setting'] = $settings;
					// $data[$key]['pop_size'] = $pop_sz;
					// $data[$key]['percent_below_fpl'] = $fpl;
					// $data[$key]['percent_uninsured'] = $perc_uninsured;

	    // 		}else{
	    // 			$data[$key]['title'] = get_the_title($p_id);
					//  //echo get_the_title($p_id);
					// $data[$key]['description'] = $description;
					// $data[$key]['slug']= $slug;
					// $data[$key]['name'] = $name;
					// $data[$key]['address'] = $address;
					// $data[$key]['city'] = $city;
					// $data[$key]['zip'] = $zip;
					// $data[$key]['coordinates'] = $coordinates;
					// $data[$key]['bed_size'] = $bed_name;
					// $data[$key]['percent_govt_payer'] = $govt_payer;
					// $data[$key]['ownership'] = $owners;
					// $data[$key]['teaching_status'] = $teach;
					// $data[$key]['region'] = $reg;
					// $data[$key]['active'] = $is_active;
					// $data[$key]['partners'] = $part;
					// $data[$key]['sdh'] = $social_det;
					// $data[$key]['target_pop'] = $target_pop;
					// $data[$key]['program_setting'] = $settings;
					// $data[$key]['pop_size'] = $pop_sz;
					// $data[$key]['percent_below_fpl'] = $fpl;
					// $data[$key]['percent_uninsured'] = $perc_uninsured;
	  //   		}
	  //   	}

	  //   	$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
	  //   	//var_dump($newJsonString);
			// file_put_contents($directory, $newJsonString);
   //      }
    //}
    }
 }

 add_action('save_post', 'update_programs_map', 10, 3);

 function update_hospital_map( $post_id ) {

    $post_type = get_post_type($post_id);
    
    //echo $p_id;
    //echo $post_id;
     if("hospital" != $post_type){ return; }
     else{
     $p_id = get_the_ID();
    //The file location for the json file we're creating
    $directoryH = get_template_directory().'/helpers/hospitals.json';
    $i = 0;
    //The contents of the file, so we can check to see if it's empty or not.
    $hospital_file = file_get_contents($directoryH);
       
    //}else{
      //if($program_file == ''){
        $arr = array();
        $ids = array();
        
        $args = array(
          'post_type' => 'hospital',
          'posts_per_page'=> -1,
          'orderby' => 'title',
          'order' => 'asc',
          'post_status' => 'publish'
        );

        query_posts( $args );
        //$ct = 0;
        while (have_posts()) { the_post();
          //$ct++;
          $i++;
          //Save the post ID to a variable
          $p_id = get_the_ID();

          //Get post info to save to our json file
          $title = get_the_title();
          $description = get_the_content();

          GLOBAL $post;
          $the_id = (string)$p_id;
          //var_dump($the_id);
          $da_id = $p_id;
          $slug = $post->post_name;
          $name = get_field('hospital_name',$post_id);
          $address = get_field('hospital_address',$post_id);
          $city = get_field('hospital_city_state',$post_id);
          $zip = get_field('hospital_zip',$post_id);
          $lat = get_field('hospital_latitude',$post_id);
          $long = get_field('hospital_longitude',$post_id);
          $email = get_field('contact_email',$post_id);
          //$website = get_field('web_address');
          //$phone = get_field('phone_number');
          //$zip = get_field('zip');
          //$primary_section = get_the_terms($p_id, 'primary_section'); 
          //var_dump($primary_section);
          //$color = get_term_meta($primary_section[0]->term_id, 'color');
          //__Get the categories for the post, we'll break it up below
          //$listing_cats = get_the_category($p_id); 
          //----
          $separator = '';

            //1
          $beds = get_the_terms($post_id, 'bed_size');
          $bed_name = '';
          $bed_slug = '';
          if($beds){
            foreach ($beds as $bed){
              $bed_name .= $bed->name . $separator;
              $bed_slug .= $bed->slug . $separator;
            }
        } 

          //2
          $payers = get_the_terms($post_id, 'percent_govt_payer');
          $govt_payer = '';
          $govt_payer_slug = '';

          if($payers){
            foreach ($payers as $payer){
              $govt_payer .= $payer->name . $separator;
              $govt_payer_slug .= $payer->slug . $separator;
            }
          }
          //3
          $ownerships = get_the_terms($post_id, 'ownership');
          $owners = '';
          $owners_slug = '';

          if($ownerships){
            foreach ($ownerships as $ownership){
              $owners .= $ownership->name . $separator;
              $owners_slug .= $ownership->slug . $separator;
            }
          }
          


          //4
          $t_statuses = get_the_terms($post_id, 'teaching_status');
          $teach = '';
          $teach_slug = '';

          if($t_statuses){
            foreach ($t_statuses as $t_status){
              $teach .= $t_status->name . $separator;
              $teach_slug .= $t_status->slug . $separator;
            }
          }

          //5
          $regions = get_the_terms($post_id, 'region');
          $reg = '';
          $reg_slug = '';
          if($regions){
            foreach ($regions as $region){
              $reg .= $region->name . $separator;
              $reg_slug .= $region->slug . $separator;
            }
          }

          //6
          $actives = get_the_terms($post_id, 'active');
          $is_active = '';
          $is_active_slug ='';

          if($actives){
            foreach ($actives as $active){
              $is_active .= $active->name . $separator;
              $is_active_slug .= $active->slug . $separator;
            }
          }

          //7
          $partners = get_the_terms($post_id, 'partners');
          $part = '';
          $part_slug ='';

          if($partners){
            foreach ($partners as $partner){
              $part .= $partner->name . $separator;
              $part_slug .= $partner->slug . $separator;
            }
          }

          //8
          $determinants = get_the_terms($post_id, 'sdh');
          $social_det = '';
          $social_det_slug = '';

          if($determinants){
            foreach ($determinants as $determinant){
              $social_det .= $determinant->name . $separator;
              $social_det_slug .= $determinant->slug . $separator;
            }
          }

          //9
          $t_pops = get_the_terms($post_id, 'target_pop');
          $target_pop = '';
          $target_pop_slug = '';

          if($t_pops){
            foreach ($t_pops as $t_pop){
              $target_pop .= $t_pop->name . $separator;
              $target_pop_slug .= $t_pop->slug . $separator;
            }
          }

          //10
          $p_settings = get_the_terms($post_id, 'program_setting');
          $settings = '';
          $settings_slug = '';

          if($p_settings!=''){
            foreach ($p_settings as $p_setting){
              $settings .= $p_setting->name . $separator;
              $settings_slug .= $p_setting->slug . $separator;
            }
          }

          //11
          $pop_sizes = get_the_terms($post_id, 'pop_size');
          $pop_sz = '';
          $pop_sz_slug = '';

          if($pop_sizes){
            foreach ($pop_sizes as $pop_size){
              $pop_sz .= $pop_size->name . $separator;
              $pop_sz_slug .= $pop_size->slug . $separator;
            }
          }

          //12
          $below_fpls = get_the_terms($post_id, 'percent_below_fpl');
          $fpl = '';
          $fpl_slug = '';

          if($below_fpls){
            foreach ($below_fpls as $below_fpl){
              $fpl .= $below_fpl->name . $separator;
              $fpl_slug .= $below_fpl->slug . $separator;
            }
          }

          //13
          $percent_uninsureds = get_the_terms($post_id, 'percent_uninsured');
          $perc_uninsured = '';
          $perc_uninsured_slug = '';

          if($percent_uninsureds){
            foreach ($percent_uninsureds as $percent_uninsured){
              $perc_uninsured .= $percent_uninsured->name . $separator;
              $perc_uninsured_slug .= $percent_uninsured->slug . $separator;
            }
          }

           $p_args = array(
              'post_type' => 'program',
              'posts_per_page'=> -1,
              //'orderby' => 'title',
              //'order' => 'asc',
              'post_status' => 'publish',
              'meta_key' => 'hospital',
              'meta_query' => array(
                  array(
                      'key' => 'hospital',
                      'compare' => '=',
                      'value' => $da_id,
                      ) 
                  )
              );

           $prog_query = new WP_Query( $p_args );
           
        $prog_ids = array();
        while ($prog_query->have_posts()) { $prog_query->the_post();
          //var_dump($prog_query);
          // $separator = ", ";
          $prog_id = $post->ID;
          
          array_push($prog_ids, $prog_id);
          // //$prog_id .= $prog_id + $separator;
          // //var_dump($prog_id);
          // $prog_ids='';
          // if($prog_id!=''){
          // $prog_ids = array($prog_id);
          // //return $prog_ids;
          // var_dump($prog_ids);
          // //var_dump($prog_id);
          // }else{
          //   $prog_ids = '';
          // }
        }wp_reset_postdata();
           //var_dump($prog_query);

          // $hosp = get_field('hospital');

          // $hosp_meta_args = array(
          //     $key = 'meta_value';
          //   );
          //get one category by splitting the value from above
          // foreach ($listing_cats as $cat) {
          //    $listing_category = $cat->slug;
          //    $listing_name = $cat->name;
          //    break;
          // }
         
      // foreach ($primary_section as $ps){
      //  $primary_sec = $ps->name;
      //  break;
      // }

          
          //$logo = wp_get_attachment_url(get_post_thumbnail_id());

          //$business_category = get_field('business_category');

          //Save the address, city, & zip to a variable to use in the getCoordinates function
          $f = $address . ' ' . $city . ' '. $zip;
           
          //Override   
          //Check to see if the latitude and longitude overides on the listing posttype are being used
          //If so, use those values to retrieve our location information for our map
          //If not, run the getCoordinates function to dynamically retrieve the lat and lng  
          if (get_field('hospital_latitude') && get_field('hospital_longitude')) {
            $lat = get_field('hospital_latitude');
            $long = get_field('hospital_longitude');
            $coordinates = array((float)$lat, (float)$long);
          }else{
            $coordinates = getCoordinates($f);
          }
  
            //Add all of the listing 'parts' to an array
            //$prog_ids = meta_query of programs that contain the meta value of this hospital
            $a = [
              //$the_id,
              "id" => $the_id,
              "name" => $title,
              "slug"=> $slug,
              "address" => $address,
              "city" => $city,
              "zip" => $zip,
              "latitude" => $lat,
              "longitude" => $long,
              //"coordinates" => $coordinates,
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
              "active" => $is_active,
              "active_slug" => $is_active_slug,
              "partners" => $part,
              "partners_slug" => $part_slug,
              "sdh" => $social_det,
              "sdh_slug" => $social_det_slug,
              "target_pop" => $target_pop,
              "target_pop_slug" => $target_pop_slug,
              // "program_setting" => $settings,
              // "program_setting_slug" => $settings_slug,
              "pop_size" => $pop_sz,
              "pop_size_slug" => $pop_sz_slug,
              "percent_below_fpl" => $fpl,
              "percent_below_fpl_slug" => $fpl_slug,
              "percent_uninsured" => $perc_uninsured,
              "percent_uninsured_slug" => $perc_uninsured_slug,
              "program_ids" => $prog_ids,
            ];

            // $id = [
            //   $the_id => $a
            // ];
            //array_push($arr, $a);
            // array_push($ids, $id);
            // array_push($ids[$i], $a);
            // array_push($arr, $id);
            // $h_array = array_merge($ids, $arr);
            //array_push($ids, $id);
            //array_push($ids, $a);

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
        //}
      //   else{
      //     $json_string = file_get_contents($directoryH);
      //   //var_dump($json_string);
      //   $data = json_decode($json_string, true);
      //   //var_dump($data);
      //   //$data[1]['title'] = 'isThisThingWorking';

      //   foreach($data as $key => $hospital){
      //     //echo $program['ID'];
      //     //echo $program['title'];
      //     if($post_id == $hospital['ID']){
      //       global $post;
      //       //echo $post_id;
      //       //echo $program['ID'];
      //     // $data[$key]['ID'] = $the_id;
      //     // echo $the_id;
      //     //$data[$key]['title'] = 'UPDATED';
      //     //$data[$key]['title'] = $title;
      //     $data[$key]['title'] = get_the_title($post_id);
      //      //echo get_the_title($post_id);
      //     $data[$key]['description'] = get_the_content($post_id);
      //     $data[$key]['slug']= $post->post_name;
      //     $data[$key]['name'] = $name;
      //     $data[$key]['address'] = $address;
      //     $data[$key]['city'] = $city;
      //     $data[$key]['zip'] = $zip;
      //     $data[$key]['coordinates'] = $coordinates;
      //     $data[$key]['bed_size'] = $bed_name;
      //     $data[$key]['percent_govt_payer'] = $govt_payer;
      //     $data[$key]['ownership'] = $owners;
      //     $data[$key]['teaching_status'] = $teach;
      //     $data[$key]['region'] = $reg;
      //     $data[$key]['active'] = $is_active;
      //     $data[$key]['partners'] = $part;
      //     $data[$key]['sdh'] = $social_det;
      //     $data[$key]['target_pop'] = $target_pop;
      //     $data[$key]['program_setting'] = $settings;
      //     $data[$key]['pop_size'] = $pop_sz;
      //     $data[$key]['percent_below_fpl'] = $fpl;
      //     $data[$key]['percent_uninsured'] = $perc_uninsured;

      // //    }else{
      // //      $data[$key]['title'] = get_the_title($p_id);
      //     //  //echo get_the_title($p_id);
      //     // $data[$key]['description'] = $description;
      //     // $data[$key]['slug']= $slug;
      //     // $data[$key]['name'] = $name;
      //     // $data[$key]['address'] = $address;
      //     // $data[$key]['city'] = $city;
      //     // $data[$key]['zip'] = $zip;
      //     // $data[$key]['coordinates'] = $coordinates;
      //     // $data[$key]['bed_size'] = $bed_name;
      //     // $data[$key]['percent_govt_payer'] = $govt_payer;
      //     // $data[$key]['ownership'] = $owners;
      //     // $data[$key]['teaching_status'] = $teach;
      //     // $data[$key]['region'] = $reg;
      //     // $data[$key]['active'] = $is_active;
      //     // $data[$key]['partners'] = $part;
      //     // $data[$key]['sdh'] = $social_det;
      //     // $data[$key]['target_pop'] = $target_pop;
      //     // $data[$key]['program_setting'] = $settings;
      //     // $data[$key]['pop_size'] = $pop_sz;
      //     // $data[$key]['percent_below_fpl'] = $fpl;
      //     // $data[$key]['percent_uninsured'] = $perc_uninsured;
      //     }
      //   }

      //   $newJsonStringH = json_encode($data, JSON_PRETTY_PRINT);
      //   //var_dump($newJsonString);
      // file_put_contents($directoryH, $newJsonStringH);
      //   }
    //}
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

?>
