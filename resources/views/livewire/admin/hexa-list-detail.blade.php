
<div>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Hexa Helix </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item ">Data Hexa Helix</li>
            <li class="breadcrumb-item active">Detail Hexa Helix</li>
        </ol>
    <div class="card mb-4 mt-10">
        <div class="container">
            <div class="detail-ekraf">
                <div class="detail-ekraf-head">
                  <div class="top">
                    <div class="logos media">
                      <img src="{{asset('storage/hexahelic/'.$data->logo)}}"  width="200px" >
                      <div class="media-body">
                        <div class="title">{{$data->nama}}</div>
                        <span>{{$data->jenis_lembaga}}</span>
                      </div>
                    </div>
            
                   
                  </div>
                  <div class="bottom">
                    <div class="row">
                      
                  
                      <div class="col-lg-20 col-md-4">
                        <div class="box">
                          <div>Email</div>
                          <a href="mailto:{{$data->email}}" style="overflow-wrap: break-word;">{{$data->email}}</a>
                        </div>
                      </div>
                     
                      <div class="col-lg-20 col-md-4">
                        <div class="box">
                          <div>Telp</div>
                          <span style="overflow-wrap: break-word;">{{$data->kontak}}</span>
                        </div>
                      </div>
                      <div class="col-lg-20 col-md-4">
                        <div class="box">
                          <div>Medos</div>
                          <span style="overflow-wrap: break-word;">{!!$data->medsos!!}</span>
                        </div>
                      </div>
                      <div class="col-lg-20 col-md-4">
                        <div class="box">
                          <div>Website</div>
                          <span style="overflow-wrap: break-word;">{{$data->website}}</span>
                        </div>
                      </div>
                     
                      <div class="col-lg-20 col-md-4">
                        <div class="box">
                          <div>Alamat</div>
                          <span style="overflow-wrap: break-word;">{{$data->alamat}}</span>
                        </div>
                      </div>
                      <div class="col-lg-20 col-md-4">
                        <div class="box">
                          <div>Kota</div>
                          <span style="overflow-wrap: break-word;">{{$data->city()}}</span>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                  <span class="text-blue"> {!! $data->status() !!}</span>
                  @if ($data->status==1)
                  <br/>
                       <div class="mt-10">
                           <button wire:click="terima()"  class="btn btn-primary">VERIFIKASI</button>
                           <button wire:click="tolak()"   class="btn btn-danger ">TOLAK</button>
                       </div>
                  @endif
                </div>

                
            
                <div class="detail-ekraf-main">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link {{$tab_selected=='kerjasama' ?'active' : ''}}" 
                        id="kerjasamatab-tab" data-toggle="tab" wire:click="selecttab('kerjasama')"
                          role="tab" aria-controls="kerjasamatab" aria-selected="false">Bentuk Kerjasama </a>
                      </li>

                    <li class="nav-item" role="presentation">
                      <a class="nav-link {{$tab_selected=='deskripsi' ?'active' : ''}}" 
                       id="home-tab" data-toggle="tab" 
                        role="tab" wire:click="selecttab('deskripsi')"
                       aria-controls="deskripsitab" aria-selected="true">Deskripsi</a>
                    </li>
                  
                  
                    <li class="nav-item" role="presentation">
                      <a class="nav-link {{$tab_selected=='map' ?'active' : ''}}"  
                      id="contact-tab" data-toggle="tab" wire:click="selecttab('map')"
                      role="tab" aria-controls="contact" aria-selected="false">Map</a>
                    </li>
                  </ul>
                
                </div>
                <div class="tab-content">
                    @if ($tab_selected=="kerjasama")
                        @if ($data->bentuk_kerjasama != null)
                            @foreach (json_decode($data->bentuk_kerjasama) as $item)
                                @php
                                $jk = DB::table('jenis_kerjasama')->where("id",$item)->first();
                                @endphp
                                @if ($jk)
                                    <li> {{$jk->name}}</li>
                                @endif
                                
                            @endforeach
                        @endif
                    @elseif($tab_selected=="deskripsi")
                         <p>{!!$data->deskripsi!!}</p>

                 
                    @elseif($tab_selected=="map")

                    @endif
                </div>
              </div>
        </div>
    </div>
    </div>
</div>
