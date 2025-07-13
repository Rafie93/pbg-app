<div>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tarif Retribusi PBG</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data tarif Retribusi PBG</li>
        </ol>
      
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Tarif Retribusi PBG
            </div>
            <div class="card-body">
                <a href="{{route('master.tarif.create')}}" class="btn btn-primary">+ Tambah Tarif Retribusi PBG</a>
                <br/>
                <table class="table table-bordered" >
                    <thead>
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Kepemilikan</th>
                            <th rowspan="2">Fungsi Bangunan</th>
                            <th rowspan="2">Durasi</th>
                            <th colspan="2" align="center">Luas Bangunan</th>
                            <th colspan="2"  align="center">Lantai</th>
                            <th rowspan="2">Tarif</th>
                            <th rowspan="2">Aksi</th>
                            
                        </tr>
                        <tr>
                            <td>Min (m2)</td>
                            <td>Max (m2)</td>
                            <td>Min</td>
                            <td>Max</td>
                        </tr>
                    </thead>
                    <tbody>
                       @forelse ($tarifs as $key=> $row)
                            <tr>
                                <td  align="center">{{$key+1}}</td>
                                <td>{{$row->kepemilikan}}</td>
                                <td>{{$row->fungsibangunan->nama}}</td>
                                <td>{{$row->durasi_pemanfaatan}}</td>
                                <td align="center">{{$row->min_luas_bangunan}}</td>
                                <td align="center">{{$row->max_luas_bangunan}}</td>
                                <td align="center">{{$row->min_jumlah_lantai}}</td>
                                <td align="center">{{$row->max_jumlah_lantai}}</td>
                                <td align="right">Rp. {{number_format($row->tarif)}}</td>
                                <td align="center">
                                    <a href="{{route('master.tarif.edit', $row->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                    <button wire:click="delete({{$row->id}})" class="btn btn-danger btn-sm">Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" align="center">Data Tarif Retribusi Kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</div>
