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
        <h1 class="mt-4">Survie</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('survie.list')}}">Survie</a></li>
            <li class="breadcrumb-item active">Tambah {{$label}} Survie</li>
        </ol>
      
        <div class="card mb-4">
           
            <div class="card-body">
              <form method="POST" enctype="multipart/form-data">
                   
                <div class="form-group row">
                  <label  class="col-sm-2 col-form-label">Nomor Registrasi *</label>
                  <div class="col-sm-10">
                    @if ($label=="Penugasan")
                    <div wire:ignore>
                        <select id="permohonanimb_id"
                             class="form-control select2" wire:model="permohonanimb_id">
                            <option value="">Pilih Nomor Registrasi</option>
                            @foreach ($option_permohonan as $row)
                                <option value="{{$row->id}}">{{$row->nomor.' | '.$row->pemohon->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                        <input type="text" class="form-control" value="{{$permohonans->nomor}}" disabled>
                        <input type="hidden" wire:model="permohonanimb_id" value="{{$permohonans->id}}">
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
                            <tr>
                                <td>Bangunan</td>
                                <td>: {{$permohonans ? $permohonans->fungsibangunan->nama.', '.
                                $permohonans->jenisbangunan->nama : '' }} </td>
                            </tr>
                            <tr>
                                <td>Luas Bangunan</td>
                                <td>: {{$permohonans ? $permohonans->luas_bangunan : '' }} m2</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>: {{$permohonans ? $permohonans->alamat.', '. $permohonans->village().', '.$permohonans->district() : '' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                 @if ($label=="Penugasan")
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Petugas Survie *</label>
                        <div class="col-sm-10">
                        <select class="form-control" wire:model="petugas_id">
                            <option value="">Pilih Petugas Survie</option>
                            @foreach ($option_petugas as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                        @error('petugas_id')
                            <span class="text-danger"><i>{{$message}}</i></span>   
                        @enderror
                        </div>
                    </div>
                 @endif
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Tanggal Berangkat </label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control"  wire:model="tanggal_berangkat">
                      @error('tanggal_berangkat')
                          <span class="text-danger"><i>{{$message}}</i></span>   
                      @enderror
                    </div>
                  </div>
                  @if ($label=="Pemeriksaan")
                    <div class="form-group
                    row">
                        <label  class="col-sm-2 col-form-label">Foto Survie *</label>
                        <div class="col-sm-10">
                            <input type="file" accept="image/*" 
                             class="form-control" wire:model="foto_survie">
                            @error('foto_survie')
                                <span class="text-danger"><i>{{$message}}</i></span>   
                            @enderror
                        </div>
                    </div>
                    {{-- CEK LIST MANGKRAK, KOSONG, MIRING --}}
                    <div class="form-group
                    row">
                        <label  class="col-sm-2 col-form-label">Kondisi Bangunan *</label>
                        <div class="col-sm-10">
                            <div class="form-check
                            form-check-inline">
                                <input type="checkbox" class="form-check-input"
                                wire:model="is_mangkrak" {{$is_mangkrak ? 'checked' : ''}}>
                                <label class="form-check
                                label">Mangkrak</label>
                            </div>
                            <div class="form-check
                            form-check-inline">
                                <input type="checkbox" class="form-check-input"
                                wire:model="is_kosong" {{$is_kosong ? 'checked' : ''}}
                                >
                                <label class="form-check
                                label">Kosong</label>
                            </div>
                            <div class="form-check
                            form-check-inline">
                                <input type="checkbox" class="form-check-input"
                                wire:model="is_miring" {{$is_miring ? 'checked' : ''}}>
                                <label class="form-check
                                label">Miring</label>
                            </div>
                            
                        </div>
                    </div>

                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">Keterangan </label>
                            <div class="col-sm-10">
                                <textarea class="form-control" wire:model="keterangan"></textarea>

                              @error('keterangan')
                                  <span class="text-danger"><i>{{$message}}</i></span>   
                              @enderror
                            </div>
                        </div>
                      
                  @endif

               
                  
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="button" wire:click="store"
                         class="btn btn-primary">SUBMIT</button>
                    </div>
                  </div>
              </form>
            </div>
        </div>
    </div>
</div>
