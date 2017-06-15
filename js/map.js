function initMap() {
  var unitedstates = {lat: 39.208408, lng: -99.744986};
  var map = new google.maps.Map(document.getElementById('map'), {
     zoom: 5,
     center: unitedstates,
     mapTypeControl: false,
     streetViewControl: false,
     styles: [
      {
          "featureType": "administrative.country",
          "elementType": "geometry.stroke",
          "stylers": [
              {
                  "color": "#cecdcc"
              }
          ]
      },
      {
          "featureType": "landscape",
          "elementType": "all",
          "stylers": [
              {
                  "hue": "#FFBB00"
              },
              {
                  "saturation": 43.400000000000006
              },
              {
                  "lightness": 37.599999999999994
              },
              {
                  "gamma": 1
              }
          ]
      },
      {
          "featureType": "poi",
          "elementType": "all",
          "stylers": [
              {
                  "hue": "#00FF6A"
              },
              {
                  "saturation": -1.0989010989011234
              },
              {
                  "lightness": 11.200000000000017
              },
              {
                  "gamma": 1
              }
          ]
      },
      {
          "featureType": "poi.park",
          "elementType": "geometry",
          "stylers": [
              {
                  "visibility": "off"
              }
          ]
      },
      {
          "featureType": "poi.park",
          "elementType": "labels",
          "stylers": [
              {
                  "visibility": "off"
              }
          ]
      },
      {
          "featureType": "road.highway",
          "elementType": "all",
          "stylers": [
              {
                  "hue": "#FFC200"
              },
              {
                  "saturation": -61.8
              },
              {
                  "lightness": 45.599999999999994
              },
              {
                  "gamma": 1
              }
          ]
      },
      {
          "featureType": "road.highway",
          "elementType": "labels",
          "stylers": [
              {
                  "visibility": "off"
              }
          ]
      },
      {
          "featureType": "road.arterial",
          "elementType": "all",
          "stylers": [
              {
                  "hue": "#FF0300"
              },
              {
                  "saturation": -100
              },
              {
                  "lightness": 51.19999999999999
              },
              {
                  "gamma": 1
              }
          ]
      },
      {
          "featureType": "road.local",
          "elementType": "all",
          "stylers": [
              {
                  "hue": "#FF0300"
              },
              {
                  "saturation": -100
              },
              {
                  "lightness": 52
              },
              {
                  "gamma": 1
              }
          ]
      },
      {
          "featureType": "water",
          "elementType": "all",
          "stylers": [
              {
                  "hue": "#0078FF"
              },
              {
                  "saturation": -13.200000000000003
              },
              {
                  "lightness": 2.4000000000000057
              },
              {
                  "gamma": 1
              }
          ]
      },
      {
          "featureType": "water",
          "elementType": "geometry.fill",
          "stylers": [
              {
                  "color": "#b1cef5"
              }
          ]
      }
  ]
  });
  // var iconBase = 'img/markers/';
  var activeSize = new google.maps.Size(60, 67.68);
  var inactiveSize = new google.maps.Size(40, 45.3);
  var icons = {
  //   parking: {
  //     icon: iconBase + 'parking_lot_maps.png'
  //   },
  //   programtype2: {
  //     icon: iconBase + 'blankmarker.svg'
  //  }
    programtype: {
      //   path: "M58.65,37.47a18,18,0,1,0-24.13,17L40.64,63l6.12-8.45A18.11,18.11,0,0,0,58.65,37.47Z",
      //   fillColor: '#0E97D4',
      //   fillOpacity: 1,
      //   anchor: new google.maps.Point(40.64,63),
      //   strokeWeight: 0,
      //   scale: 1
      active: {
         url: 'http://localhost:8888/aeh_poptool/wp-content/themes/aeh_PHT/img/markers/community-infrastructure-active.png',
         scaledSize: activeSize
      },
      inactive: {
         url: 'http://localhost:8888/aeh_poptool/wp-content/themes/aeh_PHT/img/markers/community-infrastructure.png',
         scaledSize: inactiveSize
      }
    }
  };
  var features = [
    {
      position: new google.maps.LatLng(47.481910, -105.980428),
      type: 'programtype'
    }, {
      position: new google.maps.LatLng(42.846774, -118.670464),
      type: 'programtype'
    }, {
      position: new google.maps.LatLng(33.113911, -82.362634),
      type: 'programtype'
    }, {
      position: new google.maps.LatLng(30.810584, -100.672042),
      type: 'programtype'
    }, {
      position: new google.maps.LatLng(36.824725, -76.957786),
      type: 'programtype'
    }
  ];

  // Create markers
  var allMarkers = [];
  var viewStatus = '';
  features.forEach(function(feature) {
    var marker = new google.maps.Marker({
      position: feature.position,
      icon: icons[feature.type].inactive,
      animation: google.maps.Animation.DROP,
      map: map
    });
    allMarkers.push(marker);
    marker.addListener('click', function(){
      // If an open marker is clicked, close it
      var icon = this.get('icon');
      if (this.open) {
         this.open = false;
         // icon.scale = 1;
         // icon.fillColor = '#0E97D4';
         this.setIcon(icons[feature.type].inactive);
      } else{
         for (var i = 0; i < allMarkers.length; i++) {
            // If there is another marker open, close it
            if (allMarkers[i].open) {
               var closeicon = allMarkers[i].get('icon');
               allMarkers[i].open = false;
               // closeicon.scale = 1;
               // closeicon.fillColor = '#0E97D4';
               allMarkers[i].setIcon(icons[feature.type].inactive);
            } else{
               // If all markers are closed and the listing view has not been opened, open listing view and proceed to open selected marker
               var viewStatus = landingView.progress();
               if (viewStatus === 0) {
                  landingView.play();
               }
            }
            // Whether or not listing view plays, open selected marker
            this.open = true;
            // icon.scale = 1.5;
            // icon.fillColor = '#8FC740';
            this.setIcon(icons[feature.type].active);
         };
      };
    });
  });

  
  // setMarkers(map);
};
