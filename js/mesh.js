jQuery(document).ready(function($){

  //Are we loaded?

  $('.sdh-icon').click(function(event){
      //   if($(this).hasClass('active')){
      //      $(this).removeClass('active');
      //      $('.sdh-intro').removeClass('determ');
      //   }
      $('.sdh-icon').each(function(){
         if($(this).hasClass('active')){
            $(this).removeClass('active');
         }
      });
      var current_determ = this.id;
      $(this).toggleClass('active');
      $('.determ-intro').each(function(){
         if($(this).hasClass('active')){
            $(this).removeClass('active');
         }
      });
      $('.sdh-intro').addClass('determ');
      $('.determ-intro.' + current_determ).addClass('active');
   });

 $('.determ-close').click(function(){
      $('.sdh-intro').removeClass('determ');
      $('.sdh-icon').each(function(){
         $(this).removeClass('active');
      });
   });

   $('#menuButton').click(function(){
      $('#menu-main_nav').toggleClass('open');
   });

//  $('.sdh-icon.active').click(function(){
//     $('.sdh-intro').removeClass('determ');
// });

  //Let's do something awesome!

});

// var searchClose = document.getElementById('searchModalClose'),
//    listingInterface = document.getElementById('listingInterface'),
//    altSearchClose1 = document.getElementById('landingBrowsePrograms'),
//    searchModal = document.getElementById('searchModal'),
//    modalNonFilter = document.getElementById('modalNonFilter'),
//    nonFilterContent = document.getElementById('nonFilterContent'),
//    modalFilterContent = document.getElementById('modalFilterContent'),
//    filterContainer = document.getElementById('filterContainer'),
//    filterView = new TimelineMax(),
//    landingView = new TimelineMax();

// //Langing view close animation
// landingView.paused(true)
//    .add("open")
//    .to(searchModal, 0.75, {css:{top:"-100%", autoAlpha:0}, ease: Elastic.easeIn.config(1, 1)}, "open")
//    .to(listingInterface, 0.75, {css:{left:"0"}, ease: Power3.easeInOut, delay:0.4}, "open")
//    .add("closed");

// //Landing view close function
// var landingViewClose = function(event){
//    event.preventDefault();
//    landingView.play();
// };

// //Play landing view close
// searchClose.addEventListener("click", landingViewClose);

// altSearchClose1.addEventListener("click", landingViewClose);

// //Filter view
// var filterTriggers = document.getElementsByClassName('dropdown-trigger');
// var active = '';

// //Filter view transition definition
// filterView.paused(true)
//    .add("closed")
//    .to(nonFilterContent, 0.2, {css:{autoAlpha:0}}, "closed")
//    .to(filterContainer, 0.2, {css:{top:"230px", autoAlpha:1}}, "open")
//    .add("open");

// var openFilters = function(event){
//    active = event.target;
//    //Reset filter trigger functions
//    for (var i = 0; i < filterTriggers.length; i++) {
//       filterTriggers[i].className = 'dropdown-trigger';
//       filterTriggers[i].onclick = openFilters;
//       filterContainer.className = 'filters';
//    }
//    filterContainer.className += (' ' + active.id);
//    //Switch from listing to filter view
//    filterView.play();
//    //Highlight active filter category
//    active.className = "dropdown-trigger active-filter";
//    //Allow active to close filters
//    active.onclick = closeFilters;
// };

// var closeFilters = function(event){
//    //Remove category highlight & filter container contents
//    active.className = "dropdown-trigger";
//    filterContainer.className = "filters";
//    //Reveal listing view
//    filterView.reverse();
//    //Revert onclick
//    event.target.onclick = openFilters;
// };

// for (var i = 0; i < filterTriggers.length; i++) {
//    filterTriggers[i].onclick = openFilters;
// };
