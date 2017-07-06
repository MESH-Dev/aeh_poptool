jQuery(document).ready(function($){


$('.loader, .loader-container').hide();
//$('input[type="checkbox"').click(function(){alert('CLICKED!')});

$('.resource-filters input[type="checkbox"]').on('change',function(){
  //alert('Clicked!');
  console.log('clicked!');
  
  //$(this).parent().find('.selected').removeClass('selected');
  
  //$(this).addClass('selected');
  
  var strategy = $('.filters.strategy input').data('filter');
  var determinant = $('.filters.determinant input:checked').data('filter');
  console.log(determinant);
  //var directoryListing = $('.d-filters .topic li.selected').attr('data-filter');
  
  // if (strategy != ''){
  // $('.topic-filtered span').text(memberResource).addClass('btn');
  // }else{
  //   $('.topic-filtered span').text('All').removeClass('btn');
  // }

  // if (determinant != ''){
  //   $('.type-filtered span').text(contentType).addClass('btn');
  // }else{
  //   $('.type-filtered span').text('All').removeClass('btn');
  // }

  //Delete whatever is already in the result
  $('.resource-item').detach();
  $('.discussion-item').detach();
  $('.post-error').detach();

  // loadMemberResources(memberResource,contentType,'');
  // //loadDiscussions(memberResource, '');
  // console.log('Member resource = ' + memberResource);
  // console.log('Content type = ' + contentType);
  

});

function loadResources (determinant, strategy, query) { //*
 
      //console.log(projectType);
      //console.log(query);  //*
      var is_loading = false;
       if (is_loading == false){
            is_loading = true;
 			
 			$('loader-container').removeClass('hide');
            $('.loader, .loader-container').fadeIn(200);

            var data = {
                action: 'get_resources',  //Our function from function.php
                determinant: determinant, //the return value, this comes from our js function that grabs the content
                strategy: strategy,
                query: query //Are we using the search?  
            };
            jQuery.post(ajaxurl, data, function(response) {
                // now we have the response, so hide the loader

                console.log(response);
                console.log(data);
                //console.log(memberResource);
                console.log(contentType);
                //console.log(get_member_resources);
                
               //$('a#load-more-photos').show();
                // append: add the new statments to the existing data
                if(response != 0){

                  
                  $('.resource-grid').append(response);
                  //$container.waitForImages(function() {
                  //   $('#loader').hide();
                  // });                  
 					$('.loader').fadeOut(1000);
 					$('.loader-container').fadeOut(300);
 					$('.resource-item').addClass('hide');
 					//$('.projects-nav ul > li').removeClass('selected');
 					//Adds slideinLeft and animated classes to each project tile in order
 					$('.resource-item').each(function(i, el){
 						//Show each item in it's turn
 						window.setTimeout(function(){
 						$(el).removeClass('hide').addClass('fadeIn animated');
 						}, 50 * i);
 					});
 					$('.search_form')
 						.removeClass('slideInLeft')
 						.addClass('slideOutLeft');
 					// $('.projects-nav.gallery')
 					// 	.removeClass('slideInLeft')
 					// 	.addClass('slideOutLeft');
                  is_loading = false;
                }
                else{
                  $('#loader').hide();
                  
                  is_loading = false;
                }

                
            });
        }    
  }

  function loadDiscussions (discussionListing, query) { //*
 
      //console.log(projectType);
      //console.log(query);  //*
      var is_loading = false;
       if (is_loading == false){
            is_loading = true;
 			
 			$('loader-container').removeClass('hide');
            $('.loader, .loader-container').fadeIn(200);

            var data = {
                action: 'get_discussions',  //Our function from function.php
                discussionListing: discussionListing, //the return value
                data: "?query=",
                //contentType: contentType,
                query: query //Are we using the search?  
            };
            jQuery.post(ajaxurl, data, function(response) {
                // now we have the response, so hide the loader

                console.log(response);
                console.log(data);
                //console.log(memberResource);
                //console.log(contentType);
                //console.log(get_member_resources);
                
               //$('a#load-more-photos').show();
                // append: add the new statments to the existing data
                if(response != 0){

                  
                  $('.discussion-listing .row').append(response);
                  //$container.waitForImages(function() {
                  //   $('#loader').hide();
                  // });                  
 					$('.loader').fadeOut(1000);
 					$('.loader-container').fadeOut(300);
 					$('.resource-item').addClass('hide');
 					//$('.projects-nav ul > li').removeClass('selected');
 					//Adds slideinLeft and animated classes to each project tile in order
 					$('.resource-item').each(function(i, el){
 						//Show each item in it's turn
 						window.setTimeout(function(){
 						$(el).removeClass('hide').addClass('fadeIn animated');
 						}, 50 * i);
 					});
 					$('.search_form')
 						.removeClass('slideInLeft')
 						.addClass('slideOutLeft');
 					// $('.projects-nav.gallery')
 					// 	.removeClass('slideInLeft')
 					// 	.addClass('slideOutLeft');
                  is_loading = false;
                }
                else{
                  $('#loader').hide();
                  
                  is_loading = false;
                }

                
            });
        }    
  }

});