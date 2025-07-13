@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .form-group{
            padding: 5px;
        }
    </style>
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            // change
            $('#permohonanimb_id').on('change', function (e) {
                let data = $(this).val();
                @this.set('permohonanimb_id', data);
                @this.getPermohonan(data);
            });
        });
    </script>
@endpush
<div>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Penerbitan </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('penerbitan.list')}}">Penerbitan </a></li>
            <li class="breadcrumb-item active">Tambah Penerbitan </li>
        </ol>
      
        <div class="card mb-4">
           
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Jenis *</label>
                        <div class="col-sm-10">
                              <select id="jenis" wire:change="changeValue"
                                   class="form-control" wire:model="jenis">
                                  <option value="">Pilih Jenis</option>
                                  <option value="PBG">PBG</option>
                                  <option value="Reklame">Reklame</option>
                                  
                              </select>
                       
                          @error('jenis')
                              <span class="text-danger"><i>{{$message}}</i></span>   
                          @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Nomor Registrasi *</label>
                        <div class="col-sm-10">
                        
                              @if ($jenis=="PBG")
                              <select id="permohonanimb_id"
                              class="form-control " wire:model="permohonanimb_id" wire:change="getPermohonan">
                                  <option value="">Pilih Nomor Registrasi</option>
                                     @foreach ($option_permohonan as $row)
                                         <option value="{{$row->id}}">{{$row->nomor.' | '.$row->pemohon->nama}}</option>
                                     @endforeach
                                </select>
                              @elseif($jenis=="Reklame")
                              <select id="permohonanimb_id"
                              class="form-control " wire:model="permohonanimb_id" wire:change="getPermohonan">
                                  <option value="">Pilih Nomor Registrasi</option>
                                 
                                     @foreach ($option_permohonan_reklame as $row)
                                         <option value="{{$row->id}}">{{$row->nomor.' | '.$row->pemohon->nama}}</option>
                                     @endforeach
                              </select>
                            @endif
                             
                         
                          @error('permohonanimb_id')
                              <span class="text-danger"><i>{{$message}}</i></span>   
                          @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                          <label  class="col-sm-2 col-form-label">Pemohon</label>
                          <div class="col-sm-10">
                              <table class="table table-striped">
                                  <tr>
                                      <td style="width: 25%">Nama Pemohon</td>
                                      <td>: {{$permohonans ? $permohonans->pemohon->nama : ''}}</td>
                                  </tr>
                                  <tr>
                                      <td>No HP</td>
                                      <td>: {{$permohonans ? $permohonans->pemohon->no_hp : ''}}</td>
                                  </tr>
                                  @if ($jenis=="PBG")
                                      <tr>
                                          <td>Bangunan</td>
                                          <td>: {{$permohonans ? $permohonans->fungsibangunan->nama.', '.
                                          $permohonans->jenisbangunan->nama : '' }} </td>
                                      </tr>
                                      <tr>
                                          <td>Luas Bangunan</td>
                                          <td>: {{$permohonans ? $permohonans->luas_bangunan : '' }} m2</td>
                                      </tr>
                                  @else
                                      <tr>
                                          <td>Jenis Reklame</td>
                                          <td>: {{$permohonans ? $permohonans->jenis_reklame.', '.
                                          $permohonans->ukuran : '' }} </td>
                                      </tr>
                                      <tr>
                                          <td>Teks</td>
                                          <td>: {{$permohonans ? $permohonans->teks_reklame : '' }} </td>
                                      </tr>
                                  @endif
                                  
                                  <tr>
                                      <td>Alamat</td>
                                      <td>: {{$permohonans ? $permohonans->alamat.', '. $permohonans->village().', '.$permohonans->district() : '' }}</td>
                                  </tr>
                              </table>
                          </div>
                      </div>
                    <div class="form-group
                    row">
                        <label  class="col-sm-2 col-form-label">Nomor PBG  *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control"  wire:model="nomor_imb"
                            placeholder="Masukkan Nomor PBG (kosoongkan jika ingin diisi otomatis)">
                            @error('nomor_imb')
                                <span class="text-danger"><i>{{$message}}</i></span>   
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Tanggal Penerbitan *</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control"  wire:model="tanggal_penerbitan">
                          @error('tanggal_penerbitan')
                              <span class="text-danger"><i>{{$message}}</i></span>   
                          @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Tanggal kadaluarsa *</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control"  wire:model="tanggal_kadaluarsa">
                          @error('tanggal_kadaluarsa')
                              <span class="text-danger"><i>{{$message}}</i></span>   
                          @enderror
                        </div>
                    </div>
                      <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Penanda Tangan *</label>
                        <div class="col-sm-10">
                            {{-- <input type="text" class="form-control"  wire:model="penanda_tangan"
                            placeholder="Masukkan Nama Penanda Tangan PBG"> --}}
                            <select id="penanda_tangan"
                                class="form-control" wire:model="penanda_tangan">
                            <option value="">Pilih Nama Penandatangan</option>
                            @foreach ($penandatangan as $row)
                                <option value="{{$row->nama}}">{{$row->nama}} ||{{$row->nip}}</option>
                            @endforeach
                        </select>
                          @error('penanda_tangan')
                              <span class="text-danger"><i>{{$message}}</i></span>   
                          @enderror
                        </div>
                      </div>

                      
                      
                      
                      <div class="form-group row">
                        <label  class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <button type="button" wire:click="store"
                             class="btn btn-primary">TERBITKAN PBG</button>
                        </div>
                      </div>
                  </form>
            </div>
        </div>
    </div>
</div>
