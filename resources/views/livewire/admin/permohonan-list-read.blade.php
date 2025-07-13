<div>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Permohonan </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Daftar Permohonan</li>
        </ol>
      
      

        <div class="card mb-4">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">PBG</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Reklame</button>
                </li>
             
            </ul>
            <div class="tab-content mt-3" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Permohonan Reklame
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
                                    <th>JENIS REKLAME</th>
                                    <th>TEKS</th>
                                    <th>UKURAN</th>
                                    <th>DURASI</th>
                                    <th>LOKASI</th>
                                    <th>STATUS</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permohonanreklame as $key=> $row)
                                    <tr>
                                        <td align="center">{{$loop->iteration}}</td>
                                        <td>{{$row->nomor}}</td>
                                        <td>{{Carbon\Carbon::parse($row->tanggal_permohonan)->format('d M Y')}}</td>
                                        <td>{{$row->pemohon->nama}}</td>
                                        <td>{{$row->jenis_reklame}}</td>
                                        <td>{{$row->teks_reklame}}</td>

                                        <td>{{$row->ukuran}}</td>
                                        <td>{{$row->durasi_pemanfaatan}}</td>
                                        <td>{{$row->alamat}}</td>
                                        <td>{{$row->status_permohonan}}</td>
        
                                        <td>
                                            <a href="{{route('admin.permohonan.reklame.detail',$row->id)}}" class="btn btn-primary">VIEW</a>
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
    </div>
</div>
