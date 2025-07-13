<div>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Permohonan Reklame</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Daftar Permohonan</li>
            <li class="breadcrumb-item active">Detail Permohonan</li>
        </ol>
    <div class="card mb-4 mt-10">
            <div class="container">
                <div class="detail-ekraf">
                    <div class="detail-ekraf-head">
                    <div class="top">
                        <div class="logos media">
                        <div class="media-body">
                            <div class="title">{{$data->nama}}</div>
                        </div>
                        </div>
                
                    
                    </div>
                    <div class="bottom">
                       <table class="table">
                            <thead>
                                <tr>
                                    <td>Nomor Registrasi</td>
                                    <td>: {{$data->nomor}}</td>
                                    <td>Tanggal Registrasi</td>
                                    <td>: {{$data->tanggal_permohonan}}</td>
                                </tr>
                                <tr>
                                    <td>Jenis Reklame</td>
                                    <td>: {{$data->jenis_reklame}}</td>
                                    <td>Alamat</td>
                                    <td>: {{$data->village()}}, {{$data->district()}}</td>
                                </tr>
                                <tr>
                                    <td>Nama Pemohon</td>
                                    <td>: {{$data->pemohon->nama}}</td>
                                    <td>No HP</td>
                                    <td>: {{$data->pemohon->no_hp}}</td>
                                </tr>
                                <tr>
                                    <td>Status Permohonan</td>
                                    <td colspan="3">: 
                                        {{$data->status_permohonan}}
                                    </td>
                                   
                                </tr>
                            </thead>
                       </table>
                    </div>
                    @if ($data->status_permohonan=='Diajukan' || $data->status_permohonan=='Pengajuan')
                    <br/>
                         <div class="mt-10">
                             <button wire:click="terima()"  class="btn btn-primary">SETUJUI</button>
                             <button wire:click="tolak()"   class="btn btn-danger ">TOLAK</button>
                         </div>
                    @endif
 
                    </div>

                 
                    <hr/>

                
                    <div class="detail-ekraf-main">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{$tab_selected=='deskripsi' ?'active' : ''}}" 
                            id="deskripsitab-tab" data-toggle="tab" wire:click="selecttab('deskripsi')"
                            role="tab" aria-controls="deskripsitab" aria-selected="false">Deskripsi </a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{$tab_selected=='lokasi' ?'active' : ''}}" 
                            id="home-tab" data-toggle="tab" 
                                role="tab" wire:click="selecttab('lokasi')"
                            aria-controls="lokasitab" aria-selected="true">Alamat </a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{$tab_selected=='foto' ?'active' : ''}}" 
                            id="home-tab" data-toggle="tab" 
                                role="tab" wire:click="selecttab('foto')"
                            aria-controls="fototab" aria-selected="true">Foto Bangunan </a>
                        </li>
                    
                    </ul>
                    
                    </div>
                    <div class="tab-content">
                        @if ($tab_selected=="deskripsi")
                            <table class="table table-striped">
                                <tr>
                                    <td>Jenis Reklame</td>
                                    <td>: {{$data->jenis_reklame}}</td>
                                </tr>
                                <tr>
                                    <td>Teks Reklame</td>
                                    <td>: {{$data->teks_reklame}}</td>
                                </tr>
                              
                                <tr>
                                    <td>Ukuran</td>
                                    <td>: {{$data->ukuran}} m</td>
                                </tr>
                               
                                <tr>
                                    <td>Jumlah Reklame</td>
                                    <td>: {{$data->jumlah_reklame}}</td>
                                </tr>
                                <tr>
                                    <td>Kondisi </td>
                                    <td>: {{$data->kondisi_bangunan}}</td>
                                </tr>
                                <tr>
                                    <td>Durasi Pemanfaatan</td>
                                    <td>: {{$data->durasi_pemanfaatan}}</td>
                                </tr>
                               
                                
                            </table>
                        @elseif($tab_selected=="lokasi")
                            <table class="table table-striped">
                                <tr>
                                    <td>Alamat</td>
                                    <td>: {{$data->alamat}}</td>
                                </tr>
                               
                                <tr>
                                    <td>Kelurahan</td>
                                    <td>: {{$data->village()}}</td>
                                </tr>
                                <tr>
                                    <td>Kecamatan</td>
                                    <td>: {{$data->district()}}</td>
                                </tr>
                                <tr>
                                    <td>Kota</td>
                                    <td>: Banjarmasin</td>
                                </tr>
                              
                                
                            </table>
                        @elseif($tab_selected=="foto")
                            <div class="container">
                                <div class="row">
                                   <img src="{{asset('storage/'.$data->foto_bangunan)}}" width="100%"  alt="">    
                                </div>
                            </div>                        
                        
                        @endif
                        <div id="map" wire:ignore></div>

                    </div>
                </div>
            </div>
    </div>
    </div>
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
            var map = L.map('map').setView([{{ $data->latitude }}, {{ $data->longitude }}], 17);
            // var map = L.map('map').setView([latitude, longitude], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

            markersLayer.addTo(map);  
            var marker = L.marker([{{ $data->latitude }}, {{ $data->longitude }}]).addTo(map);
   

        }
    </script>
@endpush

