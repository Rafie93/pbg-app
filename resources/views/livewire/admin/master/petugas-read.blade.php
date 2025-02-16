<div>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Petugas</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Petugas</li>
        </ol>
      
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Petugas
            </div>
            <div class="card-body">
                <a href="{{route('master.petugas.form')}}" class="btn btn-primary">+ Tambah Petugas</a>
                <br/>
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($petugas as $key=> $row)
                            <tr>
                                <td  align="center">{{$key+1}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->roles()}}</td>
                                <td>
                                    <a href="{{route('master.petugas.edit',$row->id)}}" class="btn btn-primary">EDIT</a>
                                    <button wire:click="delete('{{$row->id}}')" class="btn btn-danger">HAPUS</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</div>
