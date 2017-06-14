jQuery( document ).ready(function($) {
// To keep our code clean and modular, all custom functionality will be contained inside a single object literal called "multiFilter".
var multiFilter = {

  // Declare any variables we will need as properties of the object

  $filterGroups: null,
  $filterUi: null,
  $reset: null,
  groups: [],
  outputArray: [],
  outputString: '',

  // The "init" method will run on document ready and cache any jQuery objects we will need.

  init: function(){
    var self = this; // As a best practice, in each method we will asign "this" to the variable "self" so that it remains scope-agnostic. We will use it to refer to the parent "checkboxFilter" object so that we can share methods and properties between all parts of the object.

    self.$filterUi = $('#filters');
    self.$filterGroups = $('.filter-group');
    self.$reset = $('#Reset');
    self.$container = $('#program-cards');

    self.$filterGroups.each(function(){
      self.groups.push({
        $inputs: $(this).find('input'),
        active: [],
          tracker: false
      });
    });

    self.bindHandlers();
  },

  // The "bindHandlers" method will listen for whenever a form value changes.

  bindHandlers: function(){
    var self = this,
        typingDelay = 300,
        typingTimeout = -1,
        resetTimer = function() {
          clearTimeout(typingTimeout);

          typingTimeout = setTimeout(function() {
            self.parseFilters();
          }, typingDelay);
        };

    self.$filterGroups
      .filter('.checkboxes')
      .on('change', function() {
         self.parseFilters();
      });

    self.$filterGroups
      .filter('.search')
      .on('keyup change', resetTimer);

    self.$reset.on('click', function(e){
      e.preventDefault();
      self.$filterUi[0].reset();
      self.$filterUi.find('input[type="text"]').val('');
      self.parseFilters();
    });
  },

  // The parseFilters method checks which filters are active in each group:

  parseFilters: function(){
    var self = this;

    // loop through each filter group and add active filters to arrays

    for(var i = 0, group; group = self.groups[i]; i++){
      group.active = []; // reset arrays
      group.$inputs.each(function(){
        var searchTerm = '',
               $input = $(this),
            minimumLength = 3;

        if ($input.is(':checked')) {
          group.active.push(this.value);
        }

        if ($input.is('[type="text"]') && this.value.length >= minimumLength) {
          searchTerm = this.value
            .trim()
            .toLowerCase()
            .replace(' ', '-');

          group.active[0] = '[class*="' + searchTerm + '"]';
        }
      });
       group.active.length && (group.tracker = 0);
    }

    self.concatenate();
  },

  // The "concatenate" method will crawl through each group, concatenating filters as desired:

  concatenate: function(){
    var self = this,
        cache = '',
        crawled = false,
        checkTrackers = function(){
        var done = 0;

        for(var i = 0, group; group = self.groups[i]; i++){
          (group.tracker === false) && done++;
        }

        return (done < self.groups.length);
      },
      crawl = function(){
        for(var i = 0, group; group = self.groups[i]; i++){
          group.active[group.tracker] && (cache += group.active[group.tracker]);

          if(i === self.groups.length - 1){
            self.outputArray.push(cache);
            cache = '';
            updateTrackers();
          }
        }
      },
      updateTrackers = function(){
        for(var i = self.groups.length - 1; i > -1; i--){
          var group = self.groups[i];

          if(group.active[group.tracker + 1]){
            group.tracker++;
            break;
          } else if(i > 0){
            group.tracker && (group.tracker = 0);
          } else {
            crawled = true;
          }
        }
      };

    self.outputArray = []; // reset output array

     do{
        crawl();
     }
     while(!crawled && checkTrackers());

    self.outputString = self.outputArray.join();

    // If the output string is empty, show all rather than none:

    !self.outputString.length && (self.outputString = 'all');

    console.log(self.outputString);

    // ^ we can check the console here to take a look at the filter string that is produced

    // Send the output string to MixItUp via the 'filter' method:

     if(self.$container.mixItUp('isLoaded')){
      self.$container.mixItUp('filter', self.outputString);
     }
  }
};
// END MIXITUP MULTIFILTERS


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
   listingTab = document.getElementById('listing-tab'),
   mapTab = document.getElementById('map-tab'),
   mapListingButton = document.getElementById('map-listing-button'),
   filterView = new TimelineMax(),
   landingView = new TimelineMax(),
   detailView = new TimelineMax(),
   detailCollapse = new TimelineMax(),
   mapView = new TimelineMax();

//Langing view close animation
landingView.paused(true)
   .add("open")
   .to(searchModal, 0.75, {css:{top:"-100%", autoAlpha:0}, ease: Elastic.easeIn.config(1, 1)}, "open")
   .to(listingInterface, 0.75, {css:{left:"0"}, ease: Power3.easeInOut, delay:0.4}, "open")
   .to(mapListingButton, 1, {css:{autoAlpha:1}}, "open")
   .add("closed");

//Landing view close function
var landingViewClose = function(event){
   event.preventDefault();
   var center = map.getCenter();
   var mainMap = document.getElementById('map');
   landingView.play();
   mainMap.className += ' listing-view';
   google.maps.event.trigger(map, 'resize');
   map.setCenter(center);
};

//Map view animation
mapView.paused(true)
   .add("open")
   .to(listingInterface, 0.75, {css:{left:"-100%"}, ease: Power3.easeInOut}, "open")
   // .to(mapTab, 0.75, {css:{right:'100%'}}, "open")
   // .to(listingTab, 0.75, {css:{left:'0'}}, "open")
   .to(mapListingButton, 0.1, {className:"+=open"}, "open")
   .add("closed");

//Map view open function
var mapViewOpen = function(event){
   event.preventDefault();
   mapView.play();
}

var mapViewClose = function(event){
   event.preventDefault();
   mapView.reverse();
}

//Play landing view close
searchClose.addEventListener("click", landingViewClose);

altSearchClose1.addEventListener("click", landingViewClose);

mapTab.addEventListener("click", mapViewOpen);

listingTab.addEventListener("click", mapViewClose);

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

//Detail View
detailView.paused(true)
   .add("closed")
   .to(selectionView, 0.2, {css:{autoAlpha:0}}, "closed")
   .to(detailPane, 0.2, {css:{autoAlpha:1}}, "closed")
   .to(detailNavTop, 0.2, {css:{autoAlpha:1, top:"80px"}}, "open")
   .to(detailPaneContent, 0.2, {css:{autoAlpha:1, left:"0"}}, "open")
   .add("open");

var programBlocks = document.getElementsByClassName('indiv-block');
var openDetails = function(){
   //event.preventDefault();
   detailView.play();
   selectionView.className += 'detail-view';
};

var closeDetails = function(){
   detailView.reverse();
   selectionView.className = '';
}

// for (var i = 0; i < programBlocks.length; i++) {
//    programBlocks[i].onclick = openDetails;
// }
backButton.onclick = closeDetails;

//Multi-project Detail Collapse
detailCollapse.paused(true)
   .add("open")
   .to(collapseArrow, 0.4, {rotation: "+=180"}, "open")
   .to(collapsableContent, 0.4, {height:0}, "open")
   // .to(detailPaneContent, 0.4, {height:"180px"}, "open")
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


// ======================= END FRONT END INTERACTIONS ==================================================



// ======================= DATA FUNCTIONS  =============================================================
var map;
var markers = [];



//Create All Map Markers for Hospitals
function createMarker(hospital){

   var marker = new google.maps.Marker({
      map: map,
      position: new google.maps.LatLng(hospital.latitude, hospital.longitude),
      name: hospital.name,
      id: hospital.id,
      topic: hospital.topic,
      //add custom marker based on topic here (need to add topic to json)

   });


   //Click event here to open panel and get content by ID
   google.maps.event.addListener(marker, 'click', function(){

      // infoWindow.setContent('<h2>' + marker.title + marker.id + '</h2>' + marker.desc);
      // infoWindow.open(map, marker);

      //ADD IN MARKER COLOR/SIZE CHANGE HERE

      //reset detail panel html here
      $('#detailPaneContent').html('');

      createDetailPanel('', marker.id);

   });

    // Fired when the map becomes idle after panning or zooming. HOLD ON THIS
   // google.maps.event.addListener(map, 'idle', function() {
   //     showVisibleMarkers();
   // });


   markers.push(marker);

}



//Create Initial HTML for Program Cards
function createProgramCard(program){

   //Get values of hospital taxonomies for filtering cards
   var hospital_taxs = "";
   var program_taxs = "";

   //combine all hospital taxonomies
   hospital_taxs += hospitals[program.hosp_id].bed_size_slug + " ";
   hospital_taxs += hospitals[program.hosp_id].percent_govt_payer_slug + " ";
   hospital_taxs += hospitals[program.hosp_id].ownership_slug + " ";
   hospital_taxs += hospitals[program.hosp_id].teaching_status_slug + " ";
   hospital_taxs += hospitals[program.hosp_id].region_slug + " ";
   hospital_taxs += hospitals[program.hosp_id].pop_size_slug + " ";
   hospital_taxs += hospitals[program.hosp_id].percent_below_fpl_slug + " ";
   hospital_taxs += hospitals[program.hosp_id].percent_uninsured_slug + " ";



   program_taxs += program.active_slug + " ";
   program_taxs += program.partners_slug + " ";
   program_taxs += program.sdh_slug + " ";
   program_taxs += program.target_pop_slug + " ";
   program_taxs += program.program_setting_slug + " ";

   var sdh_arry = program.sdh_slug.split(" ");

   var sdh_img = sdh_arry[0];

   //print out single card html with all filterable taxonomies
   var cardHTML = "";
   cardHTML =  '<a href="#"><li data-hospid="hosp-'+ program.hosp_id +'" id="program-'+ program.id +'" class="mix indiv-block program-card ' + program.taxs + ' ' + hospital_taxs + '" >';
   cardHTML += '<div class="block-interior">';
   cardHTML +=   '<div class="category"><p>'+ program.sdh +'</p>';
   cardHTML +=      '<img class="category-icon" src="../wp-content/themes/aeh_poptool/img/icons/'+ sdh_img +'.svg"  >';
   cardHTML +=   '</div>';
   cardHTML +=   '<h2>'+ program.name +'</h2>';
   cardHTML +=   '<p class="hospital">'+hospitals[program.hosp_id].name +'</p>';
   cardHTML +=   '<p class="location">'+hospitals[program.hosp_id].city +'</p>';
   cardHTML += '</div>';
   cardHTML += '</li></a>';


   $('#program-cards').append(cardHTML);

}




//Function to show/hide markers that fires as a callback after filtering is complete
function UpdateMarkers(){

   //this will show the active filters strings
   var state = $('#program-cards').mixItUp('getState');
   console.log("### : " + state.activeFilter);
   //-------

   //loop through markers (hospitals)
   for (var i = 0; i < markers.length; i++) {

      var marker = markers[i];
      var marker_id = markers[i].id;

      //get program cards with hospital id
        var programCard = $('li[data-hospid="hosp-'+marker_id+'"]');

      //check if there is a card visible(not filtered)
        if(programCard.is(':visible')) {
         marker.setVisible(true);
      }
        else{
            marker.setVisible(false); //hide marker if no visible cards with hospital id

        }
    }
}



//Generates HTML to load into Program View Panel, then calls function to show panel
function createDetailPanel(single_program_id, single_hospital_id){
   var prog_ids = [];
   var single = false;
   var hospital = hospitals[single_hospital_id];

   if(single_program_id){
      prog_ids.push(single_program_id);
      single = true;
   }
   else{
      prog_ids = hospital.program_ids;
   }

   console.log(prog_ids);
   //set panel hospital title
   $('#hospital_title').html(hospital.name + " | " + hospital.city);

   var panel_HTML = '';
   for(var x = 0; x < prog_ids.length; x++){
      var program = programs[prog_ids[x]];

      console.log(prog_ids[x]);

      panel_HTML += '<div class="indiv-detail-block">';
      panel_HTML +=     '<div class="category"><p>' + program.sdh + '</p></div>';
      panel_HTML +=     '<h1>' + program.name + '</h1>';
      panel_HTML +=     '<div id="collapsableContent">';
      panel_HTML +=        '<div class="row program-info-row"><h4>PROGRAM DETAILS</h4>';
      panel_HTML +=           '<div class="columns-3">';
      panel_HTML +=              '<p>Target Population: </p>';
      panel_HTML +=              '<p>Program Setting: </p>';
      panel_HTML +=              '<p>Partners: </p>';
      panel_HTML +=              '<p>Active Program: </p>';
      panel_HTML +=           '</div>';
      panel_HTML +=           '<div class="columns-5">';
      panel_HTML +=              '<p>'+ program.target_pop +'</p>';
      panel_HTML +=              '<p>'+ program.program_setting +'</p>';
      panel_HTML +=              '<p>'+ program.partners +'</p>';
      panel_HTML +=              '<p>'+ program.active +'</p>';
      panel_HTML +=           '</div>';
      panel_HTML +=        '</div>';
      panel_HTML +=        '<div class="row program-info-row"><h4>HOSPITAL DETAILS</h4>';
      panel_HTML +=           '<div class="columns-3">';
      panel_HTML +=              '<p>Ownership: </p>';
      panel_HTML +=              '<p>Population Size: </p>';
      panel_HTML +=              '<p>Number of Beds: </p>';
      panel_HTML +=              '<p>Teaching Hospital: </p>';
      panel_HTML +=              '<p>% Government Payer: </p>';
      panel_HTML +=              '<p>% Below FPL: </p>';
      panel_HTML +=              '<p>% Uninsured: </p>';
      panel_HTML +=              '<p>Region: </p>';
      panel_HTML +=           '</div>';
      panel_HTML +=           '<div class="columns-5">';
      panel_HTML +=              '<p>'+ hospital.ownership +'</p>';
      panel_HTML +=              '<p>'+ hospital.pop_size   +'</p>';
      panel_HTML +=              '<p>'+ hospital.bed_size +'</p>';
      panel_HTML +=              '<p>'+ hospital.teaching_status +'</p>';
      panel_HTML +=              '<p>'+ hospital.percent_govt_payer +'</p>';
      panel_HTML +=              '<p>'+ hospital.percent_below_fpl +'</p>';
      panel_HTML +=              '<p>'+ hospital.percent_uninsured +'</p>';
      panel_HTML +=              '<p>'+ hospital.region +'</p>';
      panel_HTML +=           '</div>';
      panel_HTML +=        '</div>';
      panel_HTML +=        '<div class="program-info-row">' + program.description + '</div>';
      panel_HTML +=        '<div class="program-info-row"><a class="contact-button" href="'+program.contact_email+'">Contact a Representative »</a></div>';


      panel_HTML +=     '</div> ';
      panel_HTML += '</div>';

   }

   panel_HTML += '<div class="detail-nav detail-nav-bottom"><div class="detail-nav-border"><div class="navigation-button" id="collapse"><a class="button-text">COLLAPSE</a><svg id="collapseArrow" class="button-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 12"><defs><style>.cls-1 { fill: #0d97d4; } </style></defs><title>uparrow</title><path class="cls-1" d="M25,12,13.06,0,0,12H4.28l8.78-7.92L21.17,12Z"/></svg></div></div>';

   $('#detailPaneContent').html(panel_HTML);

   openDetails();
}


//Generates HTML to load into Hospital View Panel, then calls function to show panel
function createHospitalPanel(single_hospital){


   console.log("Hospital Data! " + single_hospital.name );

   var program_ids = [];

   var hosp_HTML = "";
   var program_HTML = "";


   hosp_HTML += "<h3>" + single_hospital.name + "</h3>";


   $('#hospital-panel').prepend(hosp_HTML);

   program_ids = single_hospital.program_ids;


   for(var x = 0; x < program_ids.length; x++){

      program_HTML += "<h1>" + programs[program_ids[x]].name + "</h1><hr>";
   }
   $('#hospital-panel').append(program_HTML);

   openDetails();

}


//Pans Map to center on hospitla marker - called after a program click.
function centerMapOnHospital(hosp_id){
   var lat = hospitals[hosp_id].latitude;
   var lng = hospitals[hosp_id].longitude;

   var center = new google.maps.LatLng(lat, lng);

   map.panTo(center);
   //map.setZoom(7);

}


function loadMarkers(){

   //create markers from hospital data json
   for (var hospital_id in hospitals){
      createMarker(hospitals[hospital_id]);
   }
}


function loadPrograms() {
   //create programs from program data json
   for (var program_id in programs){

      createProgramCard(programs[program_id]);
   }
}


function resetFilters() {


   //clear all input fields
   $('#filters input:checked').removeAttr('checked');

   //clear search box here
   $("input#program-search").val('');

   //reset filters to show all
   $('#program-cards').mixItUp('filter','all')


}



function initMap() {
   console.log("loading map");


   var mapOptions = {
      zoom: 5,
      center: new google.maps.LatLng(37.1345952,-90.1902162),
      //PUT IN STYLES HERE
   }

   map_document = document.getElementById('map');
   map = new google.maps.Map(map_document,mapOptions);

   var initialModalClose = map.addListener('click', function(){
      landingView.play();
      google.maps.event.removeListener(initialModalClose);
   });

   loadMarkers();
   loadPrograms();

   multiFilter.init();

   // Instantiate MixItUp
   $('#program-cards').mixItUp({
       controls: {
         enable: false // we won't be needing these
       },
       animation: {
         effects: 'fade',
         easing: 'ease',
         queueLimit: 3,
         duration: 200
       },
       callbacks: {
         onMixEnd: UpdateMarkers //Show or hide markers afer filtering Cards
       }
   });

}





//========================  GET DATA AND LOAD UP MAP    ====================================================

var programs;
var hospitals;

var prog_file = $dir + "/helpers/programs.json";
var hosp_file = $dir + "/helpers/hospitals.json";

$.getJSON(prog_file, function(data) {

    programs = data;

    $.getJSON(hosp_file, function(hosp_data) {

      hospitals = hosp_data;
      console.log("json loaded");
      initMap(); //Everything is loaded - build map!


    });

});

//Handler for click on programs
$('#program-cards').on( "click", "li" , function(){

   //get ids from li element
   var prog_id = $(this).attr('id');
   var hosp_id = $(this).attr('data-hospid');
   prog_id = prog_id.substring(8, prog_id.length);
   hosp_id = hosp_id.substring(5, hosp_id.length);

   createDetailPanel(prog_id, hosp_id);

   centerMapOnHospital(hosp_id);


});


//Live Search Program Panel
$("input#program-search, input#landing-search").keyup(function(){
    // Retrieve the input field text and reset the count to zero
    var filter = $(this).val();
    $("input#program-search").val(filter);

    // Loop through grid items
    $("#program-cards a").each(function(){

        // If the list item does not contain the text phrase fade it out
        if ($(this).text().search(new RegExp(filter, "i")) < 0) {
            $(this).fadeOut(200, UpdateMarkers);


        // Show the list item if the phrase matches and increase the count by 1
        } else {
            $(this).fadeIn(200, UpdateMarkers);


        }
    });

});

// //Landing Search  -- REDUNDANT?
// $("input#landing-search").keyup(function(){
//    var filter = $(this).val();
//    $("input#program-search").val(filter);

//    $("#program-cards a").each(function(){

//         // If the list item does not contain the text phrase fade it out
//         if ($(this).text().search(new RegExp(filter, "i")) < 0) {
//             $(this).fadeOut(200, UpdateMarkers);


//         // Show the list item if the phrase matches and increase the count by 1
//         } else {
//             $(this).fadeIn(200, UpdateMarkers);

//         }
//     });

// });




}); //END MAIN JQUERY READY
