// jQuery(document).ready(function($){
//
//   //Are we loaded?
//   console.log('New theme loaded!');
//
//   //Let's do something awesome!
//
// });

var searchClose = document.getElementById('searchModalClose'),
   listingInterface = document.getElementById('listingInterface'),
   altSearchClose1 = document.getElementById('landingBrowsePrograms'),
   searchModal = document.getElementById('searchModal'),
   modalNonFilter = document.getElementById('modalNonFilter'),
   nonFilterContent = document.getElementById('nonFilterContent'),
   modalFilterContent = document.getElementById('modalFilterContent'),
   filterContainer = document.getElementById('filterContainer'),
   selectionView = document.getElementById('selectionView'),
   detailPane = document.getElementById('detailPane'),
   detailNavTop = document.getElementById('detailNavTop'),
   backButton = document.getElementById('backButton'),
   detailNavBottom = document.getElementById('detailNavBottom'),
   detailPaneContent = document.getElementById('detailPaneContent'),
   cancelFilters = document.getElementById('cancelFilters'),
   filterBottomNav = document.getElementById('filterBottomNav'),
   filterSelects = document.getElementsByClassName('custom-select'),
   collapseButton = document.getElementById('collapse'),
   collapseArrow = document.getElementById('collapseArrow'),
   collapsableContent = document.getElementById('collapsableContent'),
   filterView = new TimelineMax(),
   landingView = new TimelineMax(),
   detailView = new TimelineMax(),
   detailCollapse = new TimelineMax();

//Langing view close animation
landingView.paused(true)
   .add("open")
   .to(searchModal, 0.75, {css:{top:"-100%", autoAlpha:0}, ease: Elastic.easeIn.config(1, 1)}, "open")
   .to(listingInterface, 0.75, {css:{left:"0"}, ease: Power3.easeInOut, delay:0.4}, "open")
   .add("closed");

//Landing view close function
var landingViewClose = function(event){
   event.preventDefault();
   landingView.play();
};

//Play landing view close
searchClose.addEventListener("click", landingViewClose);

altSearchClose1.addEventListener("click", landingViewClose);

//Filter view
var filterTriggers = document.getElementsByClassName('dropdown-trigger');
var active = '';

//Filter view transition definition
filterView.paused(true)
   .add("closed")
   .to(nonFilterContent, 0.2, {css:{autoAlpha:0}}, "closed")
   .to(filterContainer, 0.2, {css:{top:"240px", autoAlpha:1}}, "open")
   .to(filterBottomNav, 0.2, {css:{autoAlpha:1}}, "open")
   .to('.block-interior', 0.1, {className:'+=filter-view'}, "open")
   .add("open");

var openFilters = function(event){
   active = event.target;
   //Reset filter trigger functions
   for (var i = 0; i < filterTriggers.length; i++) {
      filterTriggers[i].className = 'dropdown-trigger';
      filterTriggers[i].onclick = openFilters;
      filterContainer.className = 'filters';
   }
   //Choose which filters to open
   filterContainer.className += (' ' + active.id);
   //Switch from listing to filter view
   filterView.play();
   //Highlight active filter category
   active.className = "dropdown-trigger active-filter";
   //Allow active to close filters
   active.onclick = closeFilters;
};

var closeFilters = function(event){
   //Remove category highlight & filter container contents
   active.className = "dropdown-trigger";
   //Reset filter container classes
   filterContainer.className = "filters";
   //Reveal listing view
   filterView.reverse();
   //Revert onclick
   event.target.onclick = openFilters;
};

for (var i = 0; i < filterTriggers.length; i++) {
   filterTriggers[i].onclick = openFilters;
};

cancelFilters.onclick = function(){
   //Reset active filter category styles and functions
   active.className = "dropdown-trigger";
   active.onclick = openFilters;
   active = '';
   //Reset filter container classes
   filterContainer.className = "filters";
   //Reveal listing view
   filterView.reverse();
};

//Filter Dropdowns
for (var i = 0; i < filterSelects.length; i++) {
   filterSelects[i].addEventListener('click', function(event){
      this.classList.toggle("open");
   });
}
console.log(filterSelects);

//Detail View
detailView.paused(true)
   .add("closed")
   .to(selectionView, 0.2, {css:{autoAlpha:0}}, "closed")
   .to(detailPane, 0.2, {css:{autoAlpha:1}}, "closed")
   .to(detailNavTop, 0.2, {css:{autoAlpha:1, top:"80px"}}, "open")
   .to(detailNavBottom, 0.2, {css:{autoAlpha:1, bottom:"0"}}, "open")
   .to(detailPaneContent, 0.2, {css:{autoAlpha:1, left:"0"}}, "open")
   .add("open");

var programBlocks = document.getElementsByClassName('indiv-block');
var openDetails = function(event){
   event.preventDefault();
   detailView.play();
   selectionView.className += 'detail-view';
};

var closeDetails = function(){
   detailView.reverse();
   selectionView.className = '';
}

for (var i = 0; i < programBlocks.length; i++) {
   programBlocks[i].onclick = openDetails;
}
backButton.onclick = closeDetails;

//Multi-project Detail Collapse
detailCollapse.paused(true)
   .add("open")
   .to(collapseArrow, 0.4, {rotation: "+=180"}, "open")
   .to(collapsableContent, 0.4, {height:0}, "open")
   .to(detailPaneContent, 0.4, {height:"180px"}, "open")
   .add("closed");

var multiProjectOpen = function(){
   detailCollapse.reverse();
   collapseButton.onclick = multiProjectClose;
};

var multiProjectClose = function(){
   detailCollapse.play();
   collapseButton.onclick = multiProjectOpen;
};

collapseButton.onclick = multiProjectClose;
