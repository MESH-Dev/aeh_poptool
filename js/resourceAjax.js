jQuery(document).ready(function($){

$grid = $('.resource-grid').masonry({
  itemSelector: '.columns-6',
  //columnWidth: '.columns-6',
   //gutter: '.gutter-sizer',
   //itemSelector: '.grid-item',
   //percentPosition: true,
   horizontalOrder: true
   //isAnimated: false,
   //stamp: '.stamp'
});
$clk_ctr=0;
//$('.loader, .loader-container').hide();
$('.loader, .loader-container').hide();
//$('input[type="checkbox"').click(function(){alert('CLICKED!')});

// $('.resource-item').click(function(){
//   if($clk_ctr == 0){
//     $(this).css({height:700, background:'red'});
//     $clk_ctr++;
//     $grid.masonry('layout');
//   }else{
//     $(this).css({height:310, background:'purple'});
//     $clk_ctr=0;
//     $grid.masonry('layout');
//   }
// })


function expandResource(){
   $clk_ctr=0;
   $('.resource-block .expand').click(function(){
      console.log($clk_ctr);
      var r = $(this).parent().parent().find('.content');
      var rHt = r[0].scrollHeight;
      var openRi = rHt+110;
      var openR = rHt+100;
      var openC = rHt;
    if($clk_ctr == 0){
      //console.log($clk_ctr);
      $(this).parent().parent().parent().parent().parent().css({
        height:openRi
      });
      $(this).parent().parent().parent().css({
        height:openR
      });
      $(this).parent().parent().find('.content').css({
        height:openC
      });
      $(this).find('img').css({transform:'rotate(90deg)'});
      $(this).find('.text').text('Collapse');
      $grid.masonry('layout');
      $clk_ctr++;
    }else{
      $(this).parent().parent().parent().parent().parent().css({
        height:'310'
      });
      $(this).parent().parent().parent().css({
        height:'300'
      });
      $(this).parent().parent().find('.content').css({
        height:'200'
      });
      $(this).find('img').css({transform:'rotate(-90deg)'});
      $(this).find('.text').text('Expand');
      $grid.masonry('layout');
      $clk_ctr=0;
    }
   });
}

expandResource();



//Get the resource filters checked
//$('.resource-filters input[type="checkbox"]').click(function(){
$('.apply-filters').click(function(){
  _this = $(this);
  $grid.masonry('remove');
 $clk_ctr=0;
  //$(this).parent().find('.selected').removeClass('selected');
  
  $(this).addClass('selected');

  var _on = _this.data('filter');
  console.log(_on); 

  var strategies = []
  var strategy = $(this).data('filter');
  
  //Grab them selected filters
  $('.filters.strategy input[type="checkbox"]:checked').each(function(i){
    strategies[i] = $(this).data('filter');
  }); 
  
  var determinants = [];
  var determinant = $(this).data('filter');

  $('.filters.determinant :checkbox:checked').each(function(i){
    determinants[i] = $(this).data('filter');
  });

  //Delete whatever is already in the result
  $('.resource-item').detach();
  //$('.discussion-item').detach();
  $('.post-error').detach();

   loadResources(determinants,strategies,'');
   expandResource();

});

//Get the search form value
$('#resource-form').submit(function(e){
  e.preventDefault();
  var $form = $(this);
  var $input = $form.find('input[name="s"]');
  var query = $input.val();
  
  $('.filters input[type="checkbox"]:checked').prop('checked', false);
  loadResources('','',query);
  expandResource();
  $('.resource-item').detach();
  $('.post-error').detach();
});

$('.remove-filters').click(function(){
  var determinants = "";
  var strategies = "";
  var query = "";
  //var discussionListing = "";
  
  $('.filters input[type="checkbox"]:checked').prop('checked', false);
  $('#resource-form input[name="s"]').val('');

  $('.member-resource-item').detach();
  //$('.discussion-listing').detach();
  $('.post-error').detach();

  $('.topic-filtered span').text('all');
  $('.type-filtered span').text('all');

  loadResources(determinants,strategies,query);
  // loadDiscussions(discussionListing, '');

  $('[class*="filter-"]').find('li.selected').removeClass('selected');

});

function loadResources (determinants, strategies, query) { //*
 
      //console.log(projectType);
      //console.log(query);  //*
      var is_loading = false;
       if (is_loading == false){
            is_loading = true;
 			
 			      $('.loader-container').removeClass('hide');

            $('.loader, .loader-container').fadeIn(200);

            var data = {
                action: 'get_resources',  //Our function from function.php
                determinants : determinants, //the return value, this comes from our js function that grabs the content
                strategies: strategies,
                //data: "?query=",
                query: query //Are we using the search?  
            };
            jQuery.post(ajaxurl, data, function(response) {
                // now we have the response, so hide the loader

                //console.log(response);
                // console.log(data);
                // console.log(query);
                //console.log(determinants_ft);
                //console.log(strategies_ft);
                //console.log(contentType);
                //console.log(get_member_resources);
                
               //$('a#load-more-photos').show();
                // append: add the new statments to the existing data
                if(response != 0){
                  //Just like we unload all grid items prior to loading the response,
                  //we destroy the masonry instance
                  $grid.masonry('destroy');

                  //Add the response to a jQuery object for the sake of Masonry
                  $content = $(response);

                  //Append the response, and re-initialize Masonry
                  $('.resource-grid').html($content).masonry({horizontalOrder: true});
                  //$('.resource-grid').masonry('layoutItems');
                  expandResource();

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
       						//$(el).removeClass('hide').addClass('fadeIn animated');
                  $(el).fadeIn('fast');
       						}, 50 * i);
       					});
       					// $('.search_form')
       					// 	.removeClass('slideInLeft')
       					// 	.addClass('slideOutLeft');
 					// $('.projects-nav.gallery')
 					// 	.removeClass('slideInLeft')
 					// 	.addClass('slideOutLeft');
                  is_loading = false;
                }
                else{
                  //$('.loader-container').hide();
                  
                  is_loading = false;
                }

                
            });
        }    
  }

});