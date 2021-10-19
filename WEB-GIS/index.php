<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE-edge" />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <title><web-GIS with geoserver and leaflet </title>
  <head>
  <body>

  </body>    
  </head>
<!--leaflet css link -->
    <link 
      rel ="stylesheet"      
      href= "https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
      integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
      crossorigin=""/>
     
<!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">   

<!-- fontawesome-->


    <title><web-GIS with geoserver and leaflet </title>

    <style>
    body {
       margin: 0;
       padding: 0;
    }
    #map {
      width: 100%;
      height: 100vh;
    }
   </style>
  </head>
  <body>
   <div id ="map"></div>
  </body>   
</html>

<!-- Leaflet js link-->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"></script>

<!-- jquerylink -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- leaflet geoserver request link -->
<script src= "lib/L.Geoserver.js" ></script>
<script>
    var map = L.map("map").setView([5.3377, -72.3958],13); 

    var osm = L.tileLayer("https://{s}tile.openstreetmap.org/{z}/{x}/{y}.png",{
        maxZoom: 19,
        atribution:
          '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    });

    osm.addTo(map);

    //wms request
    var wmsLayer = L.Geoserver.wms("http://localhost:8080/geoserver/SIG/wms",{
     layers: "SIG:r_perimetro",
     //style: "SIGperimetro",
     transparent:true,

    });
    wmsLayer.addTo(map);

    var wmsLayer = L.Geoserver.wms("http://localhost:8080/geoserver/SIG/wms", {
     layers: "SIG:u_terreno",
     //style: "terreno"
     transparent: true,
     CQL_FILTER: "TYPE=='codigo'",
     CQL_FILTER: "TYPE=='shape_area'"
     attribution: " My wms map of building"
    });
    wmsLayer.addTo(map);

    var wfsLayer = L.Geoserver.wfs("http://localhost:8080/geoserver/SIG/wms", {
    layers: "SIG:r_perimetro",
    style: {
    color: "black",
    fillOpacity: "0.8",
    opacity: "0.5",
    fillcolor:"blue"
    },
    onEachFeature: function (feature, layer) {
    layer.bindPopup("this is popuped");
    },
    CQL_FILTER: "shape_area='area'",
    });
    //wfsLayer.addTo(map);

    var wfsLayer = L.Geoserver.wfs("http://localhost:8080/geoserver/SIG/wms", {
    layers: "SIG:u_terreno",
    style: {
    color: "red",
    fillOpacity: "0.3",
    opacity: "0.5",
    fillcolor:"black",
    },
    onEachFeature: function (feature, layer) {
    console.log(feature);
    layer.bindPopup("this is popuped.Building type: " + feature properties.TYPE
    );
    },
    //CQL_FILTER: "codigo='codigo_ant'",
    });
    //  wfsLayer.addTo(map);

    var layerLegend = L.Geoserver.legend("http://localhost:8080/geoserver/SIG/wms", {
    layers: "SIG:u_terreno",
    //style: `stylefile`,
    });

    layerLegend.addTo(map);


</script>


    








    
