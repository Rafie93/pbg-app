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
        <h1 class="mt-4">Fungsi Bangunan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('master.fungsi')}}">Data Fungsi bangunan</a></li>
            <li class="breadcrumb-item active">Tambah fungsi</li>
        </ol>
      
        <div class="card mb-4">
           
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                   
                    <div class="form-group row">
                      <label  class="col-sm-2 col-form-label">Nama *</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="nama fungsi Bangunan wajib disi"
                         required wire:model="nama">
                        @error('nama')
                            <span class="text-danger"><i>{{$message}}</i></span>   
                        @enderror
                      </div>
                    </div>

                       
                    <div class="form-group row">
                      <label  class="col-sm-2 col-form-label">Status *</label>
                      <div class="col-sm-10">
                        <select class="form-control" wire:model="status">
                            <option value="">Pilih Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                        @error('status')
                            <span class="text-danger"><i>{{$message}}</i></span>   
                        @enderror
                      </div>
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
