
<div>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tarif Retribusi</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('master.tarif')}}">Data Tarif Retribusi</a></li>
            <li class="breadcrumb-item active">Edit Tarif</li>
        </ol>
      
        <div class="card mb-4">
           
            <div class="card-body">
                <form method="POST" >
                   
                    <br/>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Tarif Retribusi *</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" placeholder="Tarif (Rp)"
                        required wire:model="tarif">
                        @error('tarif')
                            <span class="text-danger"><i>{{$message}}</i></span>
                        @enderror
                    </div>
                   
                    <br/> <br/>
                      
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
