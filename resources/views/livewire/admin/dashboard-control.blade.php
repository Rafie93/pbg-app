<div>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard Control</li>
        </ol>
        </ol>
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Kec Banjarmasin Utara</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="large text-white stretched-link" href="#">
                            <strong>Pengajuan : {{$total_aju_bjm_utara}}</strong>
                        </a><br/>
                        <a class="large text-white stretched-link" href="#">
                            <strong>Proses : {{$total_proses_bjm_utara}}</strong>
                        </a>
                        <a class="large text-white stretched-link" href="#">
                            <strong>Terbit : {{$total_imb_bjm_utara}}</strong>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Kec Banjarmasin Timur</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="large text-white stretched-link" href="#">
                            <strong>Pengajuan : {{$total_aju_bjm_timur}}</strong>
                        </a><br/>
                        <a class="large text-white stretched-link" href="#">
                            <strong>Proses : {{$total_proses_bjm_timur}}</strong>
                        </a>
                        <a class="large text-white stretched-link" href="#">
                            <strong>Terbit : {{$total_imb_bjm_timur}}</strong>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Kec Banjarmasin Selatan</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="large text-white stretched-link" href="#">
                            <strong>Pengajuan : {{$total_aju_bjm_selatan}}</strong>
                        </a><br/>
                        <a class="large text-white stretched-link" href="#">
                            <strong>Proses : {{$total_proses_bjm_selatan}}</strong>
                        </a>
                        <a class="large text-white stretched-link" href="#">
                            <strong>Terbit : {{$total_imb_bjm_selatan}}</strong>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Kec Banjarmasin Barat</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="large text-white stretched-link" href="#">
                            <strong>Pengajuan : {{$total_aju_bjm_barat}}</strong>
                        </a>
                        <a class="large text-white stretched-link" href="#">
                            <strong>Proses : {{$total_proses_bjm_barat}}</strong>
                        </a>
                        <a class="large text-white stretched-link" href="#">
                            <strong>Terbit : {{$total_imb_bjm_barat}}</strong>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Kec Banjarmasin Tengah</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="large text-white stretched-link" href="#">
                            <strong>Pengajuan : {{$total_aju_bjm_tengah}}</strong>
                        </a><br/>
                        <a class="large text-white stretched-link" href="#">
                            <strong>Proses : {{$total_proses_bjm_tengah}}</strong>
                        </a>
                        <a class="large text-white stretched-link" href="#">
                            <strong>Terbit : {{$total_imb_bjm_tengah}}</strong>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @if ($role==1 || $role==2)
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Permohonan PBG Belum Verifikasi
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
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
                                    <td>
                                        {{$row->fungsibangunan ? $row->fungsibangunan->nama : '-'}}, {{$row->jenisbangunan ? $row->jenisbangunan->nama : ''}}</td>
                                    <td>{{$row->alamat}}</td>
                                    <td>{{$row->status_permohonan}}</td>

                                    <td>
                                        <a href="{{route('admin.permohonan.detail',$row->id)}}" class="btn btn-primary">VIEW</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- paginate --}}
                    <div class="d-flex justify-content-center">
                        {!! $permohonanimb->links() !!}
                    </div>
                
                </div>
            </div>
            <br>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Permohonan Reklame Belum Verifikasi
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>NO</th>
                            <th>NO. REGISTRASI</th>
                            <th>TANGGAL</th>
                            <th>NAMA PEMOHON</th>
                            <th>JENIS REKLAME</th>
                            <th>UKURAN</th>
                            <th>LOKASI</th>
                            <th>STATUS PERMOHONAN</th>
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
                                    <td>{{$row->ukuran}}</td>
                                    <td>{{$row->alamat}}</td>
                                    <td>{{$row->status_permohonan}}</td>
                                    <td>
                                        <a href="{{route('admin.permohonan.detail',$row->id)}}" class="btn btn-primary">VIEW</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- paginate --}}
                    <div class="d-flex justify-content-center">
                        {!! $permohonanreklame->links() !!}
                    </div>
                
                </div>
            </div>
        @endif
        
        
    </div>
</div>

