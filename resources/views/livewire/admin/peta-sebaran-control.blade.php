<div>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Peta Sebaran</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Peta Sebaran Bangunan & Reklame</li>
        </ol>
      
        <div class="card mb-4">
           
            <div class="card-body">
                <div id="map" wire:ignore></div>

            </div>
        </div>
    </div>
</div>
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.74.4/dist/L.Control.Locate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.awesome-markers/2.0.2/leaflet.awesome-markers.css" integrity="sha512-cUoWMYmv4H9TGP4hbm1mIjYo90WzIQFo/5jj+P5tQcDTf+iVR59RyIj/a9fRsBxzxt5Dnv/Ex7MzRIxcDwaOLw==" crossorigin="anonymous" referrerpolicy="no-referrer" />   <!-- Font Awesome untuk ikon -->
   <style>
        #map { height: 500px; }
    </style>
@endpush
@push('scripts')

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
        integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
        crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.74.0/dist/L.Control.Locate.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.awesome-markers/2.0.2/leaflet.awesome-markers.min.js" integrity="sha512-8BqQ2RH4L4sQhV41ZB24fUc1nGcjmrTA6DILV/aTPYuUzo+wBdYdp0fvQ76Sxgf36p787CXF7TktWlcxu/zyOg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    <script type="text/javascript">
        initMap();
  
        function initMap() {
            var points = "";
            var markersLayer = new L.LayerGroup();
            var latitude = -3.3312959;
            var longitude = 114.6125845;
            var map = L.map('map').setView([latitude , longitude], 13);
            // var map = L.map('map').setView([latitude, longitude], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

            markersLayer.addTo(map);  
            // var markers = [];
            var markers = @json($markers);
            var redMarker = L.AwesomeMarkers.icon({
                markerColor: 'red',  // 'red', 'blue', 'green', 'purple', etc
                iconColor: 'white',  // warna ikon
                prefix: 'fa',       // Font Awesome prefix
                icon: 'info-circle'
            });
            var blueMarker = L.AwesomeMarkers.icon({
                markerColor: 'blue',  // 'red', 'blue', 'green', 'purple', etc
                iconColor: 'white',  // warna ikon
                prefix: 'fa',       // Font Awesome prefix
                icon: 'info-circle'
            });


            for (var i = 0; i < markers.length; i++) {
                if (markers[i]['status']=="Berizin") {
                    marker = new L.marker([markers[i]['lat'], markers[i]['lng']],{icon: blueMarker}).bindPopup(markers[i]['title']).addTo(map);

                }else{
                    marker = new L.marker([markers[i]['lat'], markers[i]['lng']],{icon: redMarker}).bindPopup(markers[i]['title']).addTo(map);

                }
            }

        }
    </script>
@endpush