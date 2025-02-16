<div>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Penerbitan PBG</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Penerbitan PBG</li>
        </ol>
      
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Penerbitan PBG
            </div>
            <div class="card-body">
                {{-- tombol buat dan input pencarian --}}
                <a href="{{route('penerbitan.create')}}" class="btn btn-primary">+ Tambah Penerbitan PBG</a>
                <br/>

                <table id="datatablesSimple"
                    class="table table-bordered table-striped table-condensed" style=" font-size: 12px;">
                    
                    <thead>
                        <tr>
                            <th>NO</th>
                          
                            <th>Nomor PBG</th>
                            <th>Tanggal Penerbitan</th>
                            <th>Pemohon</th>
                            <th>Penanda Tangan</th>
                            <th>Jabatan Penanda Tangan</th>
                            <th>NIP Penanda Tangan</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penerbitan as $key=> $row)
                            <tr>
                                <td align="center">{{$loop->iteration}}</td>
                                <td>{{$row->nomor_imb}}</td>
                                <td>{{Carbon\Carbon::parse($row->tanggal_penerbitan)->format('d M Y')}}</td>
                                <td>{{$row->permohonan->pemohon->nama}}</td>
                                <td>{{$row->penanda_tangan}}</td>
                                <td>{{$row->jabatan_penanda_tangan}}</td>
                                <td>{{$row->nip_penanda_tangan}}</td>
                                <td>
                                    <a href="{{route('penerbitan.edit', $row->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
                {{-- pagination --}}
                {{-- {{$penerbitan->links()}} --}}
            </div>
        </div>
    </div>
</div>
