<div>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tarif Retribusi Reklame</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data tarif Retribusi Reklame</li>
        </ol>
      
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Tarif Retribusi Reklame
            </div>
            <div class="card-body">
                <a href="{{route('master.tarif-reklame.create')}}" class="btn btn-primary">+ Tambah Tarif Retribusi</a>
                <br/>
                <table class="table table-bordered" >
                    <thead>
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Jenis Reklame</th>
                            <th rowspan="2">Durasi (Bulan)</th>
                            <th colspan="2" align="center">Ukuran</th>
                            <th rowspan="2">Tarif</th>
                            <th rowspan="2">Aksi</th>
                            
                        </tr>
                        <tr>
                            <td>Min (m)</td>
                            <td>Max (m)</td>
                          
                        </tr>
                    </thead>
                    <tbody>
                       @forelse ($tarifs as $key=> $row)
                            <tr>
                                <td  align="center">{{$key+1}}</td>
                                <td>{{$row->kepemilikan}}</td>
                                <td>{{$row->durasi_pemanfaatan}}</td>
                                <td align="center">{{$row->min_luas_bangunan}}</td>
                                <td align="center">{{$row->max_luas_bangunan}}</td>
                                <td align="right">Rp. {{number_format($row->tarif)}}</td>
                                <td align="center">
                                    <a href="{{route('master.tarif-reklame.edit', $row->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                    <button wire:click="delete({{$row->id}})" class="btn btn-danger btn-sm">Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" align="center">Data Tarif Retribusi Reklame Kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</div>
