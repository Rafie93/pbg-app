<div>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Retribusi</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Retribusi</li>
        </ol>
      
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Retribusi 
            </div>
            <div class="card-body">
                <a href="{{route('retribusi.create')}}" class="btn btn-primary">+ Tambah Retribusi</a>
                <table id="datatablesSimple"
                 class="table table-bordered table-striped table-condensed" style=" font-size: 13px;">
                    <thead>
                        <tr>
                            <th >No</th>
                            <th >No. Reg</th>
                            <th >Nama</th>
                            <th >Bangunan</th>
                            <th >Lokasi</th>
                            <th >Biaya Retribusi</th>
                            <th >Tanggal Tagihan</th>
                            <th>Tanggal Bayar</th>
                            <th>Bukti</th>
                            <th>Status</th>
                            <th >Aksi</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        @foreach ($retribusis as $key=> $row)
                            <tr>
                                <td align="center">{{$loop->iteration}}</td>
                                <td>{{$row->permohonan->nomor}}</td>
                                <td>{{$row->permohonan->pemohon->nama}}</td>
                                <td>{{$row->permohonan->fungsibangunan->nama.', '.$row->permohonan->jenisbangunan->nama}}</td>
                                <td>{{$row->permohonan->alamat.', '.$row->permohonan->village().', '.$row->permohonan->district()}}</td>
                                <td align="right">{{number_format($row->jumlah_tagihan)}}</td>
                                <td>{{$row->tanggal_tagihan}}</td>
                                <td>{{$row->tanggal_bayar}}</td>
                                <td>
                                    @if ($row->tanggal_bayar)
                                    <a target="__blank"
                                         href="{{asset('storage/'.$row->bukti_pembayaran)}}"><u>Lihat Bukti</u></a>
                                    @endif
                                </td>
                                <td>{{$row->status_pembayaran}}</td>
                                <td>
                                    <a href="{{route('retribusi.detail',$row->id)}}" class="btn btn-primary">VIEW</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
                {{-- pagination --}}
                {{-- <div class="d-flex justify-content-center">
                    {!! $retribusis->links() !!}
                </div> --}}
            </div>
        </div>
    </div>
</div>
