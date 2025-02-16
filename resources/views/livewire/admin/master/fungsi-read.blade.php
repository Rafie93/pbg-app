<div>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Fungsi Bangnunan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Fungsi Bangunan</li>
        </ol>
      
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Fungsi
            </div>
            <div class="card-body">
                <a href="{{route('master.fungsi.form')}}" class="btn btn-primary">+ Tambah Fungsi Bangunan</a>
                <br/>
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Fungsi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fungsis as $key=> $row)
                            <tr>
                                <td  align="center">{{$key+1}}</td>
                                <td>{{$row->nama}}</td>
                                <td>{{$row->status}}</td>
                               
                                <td>
                                    <a href="{{route('master.fungsi.edit',$row->id)}}" class="btn btn-primary">EDIT</a>
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
