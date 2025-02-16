<div>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Permohonan PBG</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Daftar Permohonan</li>
        </ol>
      
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Permohonan PBG
            </div>
            <div class="card-body">
                <table id="datatablesSimple"
                    class="table table-bordered table-striped table-condensed" style=" font-size: 12px;">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NO. REGISTRASI</th>
                            <th>TANGGAL</th>
                            <th>NAMA PEMOHON</th>
                            <th>KEPEMILIKAN</th>
                            <th>BANGUNAN</th>
                            <th>LOKASI BANGUNAN</th>
                            <th>STATUS PERMOHONAN</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permohonanimb as $key=> $row)
                            <tr>
                                <td align="center">{{$loop->iteration}}</td>
                                <td>{{$row->nomor}}</td>
                                <td>{{Carbon\Carbon::parse($row->tanggal_permohonan)->format('d M Y')}}</td>
                                <td>{{$row->pemohon->nama}}</td>
                                <td>{{$row->pemilik_bangunan}}</td>
                                <td>{{$row->fungsibangunan->nama.', '.$row->jenisbangunan->nama}}</td>
                                <td>{{$row->alamat}}</td>
                                <td>{{$row->status_permohonan}}</td>

                                <td>
                                    <a href="{{route('admin.permohonan.detail',$row->id)}}" class="btn btn-primary">VIEW</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
                {{-- pagination --}}
                {{-- <div class="d-flex justify-content-center">
                    {!! $permohonanimb->links() !!}
                </div> --}}
            </div>
        </div>
    </div>
</div>
