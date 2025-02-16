<div>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Permohonan PBG</h1>
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
                        {{-- <img src="{{asset('storage/komunitas/'.$data->logo)}}"  width="200px" > --}}
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
                                    <td>Kepemilikan</td>
                                    <td>: {{$data->pemilik_bangunan}}</td>
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
                    @if ($data->status_permohonan=='Pengajuan')
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
                            role="tab" aria-controls="deskripsitab" aria-selected="false">Bangunan </a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{$tab_selected=='lokasi' ?'active' : ''}}" 
                            id="home-tab" data-toggle="tab" 
                                role="tab" wire:click="selecttab('lokasi')"
                            aria-controls="lokasitab" aria-selected="true">Lokasi </a>
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
                                    <td>Nama Bangunan</td>
                                    <td>: {{$data->nama_bangunan}}</td>
                                </tr>
                                <tr>
                                    <td>Fungsi Bangunan</td>
                                    <td>: {{$data->fungsiBangunan->nama}}</td>
                                </tr>
                                <tr>
                                    <td>Jenis Bangunan</td>
                                    <td>: {{$data->jenisBangunan->nama}}</td>
                                </tr>
                                <tr>
                                    <td>Luas Bangunan</td>
                                    <td>: {{$data->luas_bangunan}} m2</td>
                                </tr>
                                <tr>
                                    <td>Tinggi Bangunan</td>
                                    <td>: {{$data->tinggi_bangunan}} m</td>
                                </tr>
                                <tr>
                                    <td>Jumlah Lantai</td>
                                    <td>: {{$data->jumlah_lantai}}</td>
                                </tr>
                                <tr>
                                    <td>Kondisi Bangunan</td>
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
                                <tr>
                                    <td colspan="2">
                                        <div id="map" style="height: 400px;"></div>
                                    </td>
                                </tr>
                                
                            </table>
                        @elseif($tab_selected=="foto")
                            <div class="container">
                                <div class="row">
                                   <img src="{{asset('storage/'.$data->foto_bangunan)}}" width="100%" alt="">    
                                </div>
                            </div>                        
                        
                        @endif
                    </div>
                </div>
            </div>
    </div>
    </div>
</div>
