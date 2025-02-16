<div>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Jenis bangunan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Jenis bangunan</li>
        </ol>
      
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data jenis bangunan
            </div>
            <div class="card-body">
                <a href="{{route('master.jenis-bangunan.form')}}" class="btn btn-primary">+ Tambah Jenis bangunan</a>
                <br/>
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Jenis Bangunan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jenisbangunan as $key=> $row)
                            <tr>
                                <td  align="center">{{$key+1}}</td>
                                <td>{{$row->nama}}</td>
                                <td>{{$row->status}}</td>
                                <td>
                                    <a href="{{route('master.jenis-bangunan.edit',$row->id)}}" class="btn btn-primary">EDIT</a>
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
