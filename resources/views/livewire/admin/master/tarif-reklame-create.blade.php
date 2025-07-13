@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />
    <style>
        .form-group{
            padding: 5px;
        }
    </style>
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
    <script>
      
        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        })
        
    </script>
    
@endpush
<div>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tarif Retribusi Reklame</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('master.tarif-reklame')}}">Tarif Retribusi Reklame</a></li>
            <li class="breadcrumb-item active">Tambah Tarif Retribusi Reklame</li>
        </ol>
      
        <div class="card mb-4">
           
            <div class="card-body">
                <form method="POST" >
                   
                    <div class="form-group row">
                      <label  class="col-sm-2 col-form-label">Jenis Reklame*</label>
                      <div class="col-sm-10">
                        <select id="inputState" class="form-control"
                                wire:model="jenis_reklame">
                            <option selected>... Pilih Jenis Reklame  ...</option>
                            <option value="Papan/Billboard">Papan/Billboard</option>
                            <option value="Videotron/Megatron">Videotron/Megatron</option>
                            <option value="Spanduk">Spanduk</option>
                            <option value="Baliho">Baliho</option>
                            <option value="Poster">Poster</option>
                        </select>
                        @error('jenis_reklame')
                            <span class="text-danger"><i> {{ $message }}</i></span>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Durasi (Bulan)*</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" wire:model="durasi">
                          @error('durasi')
                              <span class="text-danger"><i> {{ $message }}</i></span>
                          @enderror
                        </div>
                      </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Ukuran *</label>
                        <div class="col-sm-5">
                            <label  class="col-form-label">Minimal (meter)</label>

                        <input type="number" class="form-control" placeholder="Ukuran Minimal"
                        required wire:model="min_ukuran">
                        @error('min_ukuran')
                            <span class="text-danger"><i>{{$message}}</i></span>   
                        @enderror
                        </div>
                        <div class="col-sm-5">
                            <label  class="col-form-label">Maksimal (meter)</label>
                        <input type="number" class="form-control" placeholder="Ukuran Maksimal"
                        required wire:model="max_ukuran">
                        @error('max_ukuran')
                            <span class="text-danger"><i>{{$message}}</i></span>   
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Tarif Retribusi *</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" placeholder="Tarif (Rp)"
                        required wire:model="tarif">
                        @error('tarif')
                            <span class="text-danger"><i>{{$message}}</i></span>
                        @enderror
                    </div>
                    
                      
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
