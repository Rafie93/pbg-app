
<div>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Petugas</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('master.petugas')}}">Petugas</a></li>
            <li class="breadcrumb-item active">Tambah petugas</li>
        </ol>
      
        <div class="card mb-4">
           
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Nama *</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="nama wajib disi"
                        required wire:model="name">
                        @error('name')
                            <span class="text-danger"><i>{{$message}}</i></span>   
                        @enderror
                        </div>
                    </div>
                    <div class="form-group
                    row">
                        <label  class="col-sm-2 col-form-label">Email *</label>
                        <div class="col-sm-10">
                        <input type="email" class="form-control" placeholder="email wajib disi"
                        required wire:model="email">
                        @error('email')
                            <span class="text-danger"><i>{{$message}}</i></span>   
                        @enderror
                        </div>
                    </div>
                    <div class="form-group
                    row">
                        <label  class="col-sm-2 col-form-label">Password {{$petugas_id ? '*' : ''}}</label>
                        <div class="col-sm-10">
                        <input type="password" {{$petugas_id ? 'required' : ''}}
                         class="form-control" placeholder="password {{$petugas_id ? '(isi untuk ubah)' : 'wajib disi'}}"
                         wire:model="password">
                        @error('password')
                            <span class="text-danger"><i>{{$message}}</i></span>   
                        @enderror
                        </div>
                    </div>
                    <div class="form-group
                    row">
                        <label  class="col-sm-2 col-form-label">Role *</label>
                        <div class="col-sm-10">
                        <select class="form-control" wire:model="role">
                            <option value="">Pilih Role</option>
                            @foreach ($option_role as  $key => $item)
                                <option value="{{$item['id']}}">{{$item['name']}}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <span class="text-danger"><i>{{$message}}</i></span>   
                        @enderror
                        </div>
                    </div>
                    <br/>
                      
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
