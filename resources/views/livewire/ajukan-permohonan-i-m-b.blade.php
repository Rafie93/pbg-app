@push('styles')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

@endpush
@push('scripts')
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endpush
<div>
    <section >
        <section id="features-cards" class="features-cards section">
       
        <div class="container">
            <div class="row">
                <div class="container">
                    <div class="row ">
                        <div class="col-md-5 py-5 bg-primary text-white text-center ">
                            <div class=" ">
                                <div class="card-body">
                                    <img src="http://www.ansonika.com/mavia/img/registration_bg.svg" style="width:30%">
                                    <h2 class="py-3">Permohonan PBG</h2>
                                    <p>
                                      lengakapi data diri anda untuk melakukan permohonan PBG
                                    </p>
                                    <div class="container">
                                        
                                        
                                        <div class="row">
                                            <div id="map" wire:ignore></div>
                                            <input type="text" class="form-control" id="lat" readonly>
                                            <input type="text"  class="form-control" id="lng" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 py-5 border">
                           
                            <form enctype="multipart/form-data">
                                <h5 class="pb-2">Data Pemohon</h5>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                      <input id="Full Name" name="name" 
                                        placeholder="Nama Anda *"
                                        value="{{$pemohons->nama}}"  readonly
                                         class="form-control" type="text">
    
                                    </div>
                                    <div class="form-group col-md-6">
                                      <input type="email" value="{{auth()->user()->email}}" readonly class="form-control" 
                                      id="inputEmail4">
                                   
                                    </div>
                                  </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input id="Mobile No." value="{{$pemohons->no_hp}}" name="phone" class="form-control" 
                                        readonly type="text">
                                        
                                    </div>

                                    <div class="form-group col-md-6">
                                        <input  value="{{$pemohons->pekerjaan}}" placeholder="pekerjaan" name="pekerjaan" class="form-control" 
                                        readonly type="text">
                                    </div>
                                   
                                </div>
                                <hr/>
                                <h5 class="pb-2">Data Bangunan</h5>
                                <div class="form-row">
                                    <div class="form-group col-md-6"> 
                                        <select id="inputState" class="form-control"
                                            wire:change="hitungPerkiraan()"
                                             wire:model="pemilik_bangunan">
                                            <option selected>Pilih Jenis Kepemilikan  ...</option>
                                            <option value="Perseorangan">Perseorangan</option>
                                            <option value="Perusahaan">Perusahaan</option>
                                            <option value="Pemerintah">Pemerintah</option>
                                            <option value="Badan Hukum">Badan Hukum</option>
                                        </select>
                                        @error('pemilik_bangunan')
                                            <span class="text-danger"><i> {{ $message }}</i></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6"> 
                                        <select id="inputState" class="form-control" wire:change="hitungPerkiraan()" wire:model="fungsi_bangunan">
                                            <option selected>Pilih Fungsi Bangunan ...</option>
                                            @foreach ($option_fungsi_bangunan as $item)
                                                <option value="{{$item->id}}">Bangunan {{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                        @error('fungsi_bangunan')
                                            <span class="text-danger"><i> {{ $message }}</i></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6"> 
                                        <select id="inputState" class="form-control" wire:model="jenis_bangunan">
                                            <option selected>Pilih jenis Bangunan ...</option>
                                            @foreach ($option_jenis_bangunan as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                        @error('jenis_bangunan')
                                            <span class="text-danger"><i> {{ $message }}</i></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6"> 
                                        <input type="text" wire:model="nama_bangunan"  class="form-control" 
                                        placeholder="Nama Bangunan"/>
                                        @error('nama_bangunan')
                                            <span class="text-danger"><i> {{ $message }}</i></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4"> 

                                        <input type="text" wire:model="luas_bangunan"  class="form-control" 
                                        wire:change="hitungPerkiraan()"
                                        placeholder="Luas Bangunan (m2)"/>
                                        @error('luas_bangunan')
                                            <span class="text-danger"><i> {{ $message }}</i></span>
                                        @enderror
                                    </div>
                                    <div class="form-group
                                    col-md-4"> 
                                        <input type="text" wire:model="tinggi_bangunan"  class="form-control" 
                                        placeholder="Tinggi Bangunan (m)"/>
                                        @error('tinggi_bangunan')
                                            <span class="text-danger"><i> {{ $message }}</i></span>
                                        @enderror
                                    </div>
                                    <div class="form-group
                                    col-md-4"> 
                                        <input type="text" wire:model="jumlah_lantai" wire:change="hitungPerkiraan()"  class="form-control" 
                                        placeholder="Jumlah Lantai"/>
                                        @error('jumlah_lantai')
                                            <span class="text-danger"><i> {{ $message }}</i></span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6"> 
                                        <select id="inputState" class="form-control" wire:model="kondisi_bangunan">
                                            <option selected>Pilih Kondisi Bangunan  ...</option>
                                            <option value="Sudah Berdiri">Sudah Berdiri</option>
                                            <option value="Belum Berdiri">Belum Berdiri</option>
                                            <option value="Sedang Dibangun">Sedang Dibangun</option>
                                            <option value="Renovasi">Renovasi</option>
                                            
                                        </select>
                                        @error('kondisi_bangunan')
                                            <span class="text-danger"><i> {{ $message }}</i></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6"> 
                                        <select id="inputState" class="form-control" wire:change="hitungPerkiraan()" wire:model="durasi_pemanfaatan">
                                            <option selected>Pilih Durasi Pemanfaatan Bangunan ...</option>
                                            <option value="> 5 Tahun">Lebih 5 Tahun</option>
                                            <option value="< 5 Tahun">Kurang 5 Tahun</option>
                                            {{-- <option value="Sementara">Sementara</option> --}}
                                        </select>
                                        @error('durasi_pemanfaatan')
                                            <span class="text-danger"><i> {{ $message }}</i></span>
                                        @enderror
                                    </div>
                                </div>
                                <h5 class="pb-2">Data Lokasi Bangunan</h5>
                                <div class="form-row">
                                    <div class="form-group col-md-4"> 
                                        
                                        <select id="inputState" class="form-control" @readonly(true) disabled
                                             wire:change="getDistrict()"
                                             wire:model="city_id">
                                            <option selected>Pilih Kota/Kab  ...</option>
                                            @foreach ($option_city as $item)
                                                <option value="{{$item->id}}"> {{$item->name}}</option>
                                            @endforeach
                                        </select>
                                      
                                        
                                        @error('city_id')
                                        <span class="text-danger"><i> {{ $message }}</i></span>
                                    @enderror
                                    </div>
                                    <div class="form-group col-md-4"> 
                                        <select id="inputState" class="form-control"  wire:change="getVillage()" wire:model="kecamatan_id">
                                            <option selected>Pilih Kecamatan  ...</option>
                                            @foreach ($option_district as $item)
                                                <option value="{{$item->id}}"> {{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('kecamatan_id')
                                        <span class="text-danger"><i> {{ $message }}</i></span>
                                    @enderror
                                    </div>
                                    <div class="form-group col-md-4"> 
                                        <select id="inputState" class="form-control" wire:model="kelurahan_id">
                                            <option selected>Pilih Kel/Desa  ...</option>
                                            @foreach ($option_village as $item)
                                                <option value="{{$item->id}}"> {{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('kelurahan_id')
                                        <span class="text-danger"><i> {{ $message }}</i></span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12"> 
                                      <textarea name="alamat" wire:model="alamat" placeholder="Alamat " class="form-control"
                                      cols="20" rows="5"></textarea>
                                        @error('alamat')
                                            <span class="text-danger"><i> {{ $message }}</i></span>
                                         @enderror
                                    </div>
                                </div>
                                <h5 class="pb-2">Gambar Lokasi*</h5>
                                <div class="form-row">
                                    <div class="form-group
                                    col-md-12"> 
                                        <input type="file" required wire:model="foto_bangunan" class="form-control"
                                        accept="image/*"/>
                                        @error('foto_bangunan')
                                            <span class="text-danger"><i> {{ $message }}</i></span>
                                        @enderror
                                    </div>
                                </div>

                              

                                <div class="form-row">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <div class="form-check">
                                              <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                              <label class="form-check-label" for="invalidCheck2">
                                                <small>By clicking Submit, you agree to our Terms & Conditions, Visitor Agreement and Privacy Policy.</small>
                                              </label>
                                            </div>
                                          </div>
                                
                                      </div>
                                </div>
                                
                                <div class="form-row">
                                    <button type="button"
                                         wire:click="store" wire:loading.attr="disabled"
                                         class="btn btn-danger">
                                         <span wire:loading.remove>SUBMIT PERMOHONAN</span>
                                         <span wire:loading class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                         <span wire:loading>Loading...</span>
                                        </button>
                                </div>
                            </form>
                            <hr>
                            <div class="form-group col-md-12"> 
                                <h4>Estimasi Retribusi PBG Bangunan Baru</h4>
                                <p>Perkiraan Retribusi : </p> <h2><strong>Rp. {{number_format($estimasi_retribusi,0,',','.')}}</strong></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </section>
    </section>
</div>
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.74.4/dist/L.Control.Locate.min.css" />

    <style>
        #map { height: 400px; }
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

    <script type="text/javascript">
        initMap();
  
        function initMap() {
            var points = "";
            var markersLayer = new L.LayerGroup();
            // var latitude = -3.3312959;
            // var longitude = 114.6125845;
            var map = L.map('map').setView([{{ $latitude }}, {{ $longitude }}], 13);
            // var map = L.map('map').setView([latitude, longitude], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

            markersLayer.addTo(map);
            L.control.locate({
                locateOptions: {
                    maxZoom: 13,  // Atur zoom level saat lokasi ditemukan
                    enableHighAccuracy: true // Gunakan GPS akurat
                },
                drawCircle: false,
                initialZoomLevel: 15, // Zoom level pertama kali
                keepCurrentZoomLevel: false
            }).addTo(map);

          

            var markerOptions = {
                title: "MyLocation",
                clickable: true,
                draggable: false,
            };
            var marker = L.marker(
                [{{ $latitude }}, {{ $longitude }}],
                markerOptions
            );
            marker.addTo(map).bindPopup("Pilih Lokasi").openPopup();
            marker.dragging.enable();
            marker.on("dragend", function(e) {
                document.getElementById("lat").value = marker.getLatLng().lat;
                document.getElementById("lng").value = marker.getLatLng().lng;
            });
            map.on("geosearch/showlocation", () => {
                if (marker) {
                    map.removeControl(marker);
                }
                map.eachLayer((item) => {
                    if (item instanceof L.Marker) {
                        // Once you found it, set the properties
                        item.options.draggable = true;
                        item.options.autoPan = true;
                        // Then enable the dragging. Without this, it wont work
                        item.dragging.enable();
                    }
                });
            });

            map.on("click", function(e) {
                var lat = e.latlng.lat;
                var lon = e.latlng.lng;
                if (marker != undefined) {
                    map.removeLayer(marker);
                }
                console.log(e);
                marker = L.marker([lat, lon]).addTo(map);
                // selectLocation(lat,lon)
                document.getElementById("lat").value = lat;
                document.getElementById("lng").value = lon;
                @this.set('latitude', lat);
                @this.set('longitude', lon);
            });

        }
    </script>
@endpush

