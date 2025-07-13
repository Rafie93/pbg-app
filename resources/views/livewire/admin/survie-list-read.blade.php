<div>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Survie</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">{{$label}} Survei</li>
        </ol>
      
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Survei
            </div>
            <div class="card-body">
                @if ($label =="Penugasan")
                    <a href="{{route('survie.create')}}" class="btn btn-primary">+ Tambah {{$label}} Survei</a>
                    <br/>
                @endif
            
                <table id="datatablesSimple"
                class="table table-bordered table-striped table-condensed" style=" font-size: 13px;">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>PETUGAS</th>
                            <th>TANGGAL BERANGKAT</th>
                            <th>ALAMAT</th>
                            <th>BANGUNAN</th>
                            <th>MANGKRAK</th>
                            <th>KOSONG</th>
                            <th>MIRING</th>
                            <th>FOTO SURVIE</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($survie as $key=> $row)
                            <tr>
                                <td align="center">{{$loop->iteration}}</td>
                                <td>{{$row->petugas->name}}</td>
                                <td>{{$row->tanggal_berangkat}}</td>
                                <td>
                                    {{$row->alamat}}
                                </td>
                                <td>
                                    {{$row->jenis=="Reklame" ? $row->jenis_bangunan : $row->jenisbangunan->nama}},

                                    {{$row->jenis=="Reklame" ? $row->permohonanreklame->ukuran.' m' : $row->fungsibangunan->nama }}
                                    
                                </td>
                                <td align="center">
                                    <input type="checkbox" class="form-check-input"
                                     {{$row->is_mangkrak ? 'checked' : ''}} disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox" class="form-check-input"
                                    {{$row->is_kosong ? 'checked' : ''}} disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox" class="form-check-input"
                                     {{$row->is_miring ? 'checked' : ''}} disabled>
                                </td>
                                <td>
                                    <a href="{{asset('storage/'.$row->foto_survie)}}" target="_blank">
                                        <img height="100px"
                                        src="{{asset('storage/'.$row->foto_survie)}}" alt="">
                                    </a>
                                </td>
                                <td>
                                    @if ($label=="Pemeriksaan")
                                        <a href="{{route('survie.edit', $row->id)}}" class="btn btn-warning btn-sm">ISI SURVIE</a>

                                    @elseif($label=="Penugasan")
                                        <a href="{{route('survie.edit', $row->id)}}"
                                            style="width: 70px"
                                             class="btn btn-primary btn-sm">EDIT</a>
                                        <button wire:click="destroy({{$row->id}})"  style="width: 70px" class="btn btn-danger btn-sm">HAPUS</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
                {{-- {{$survie->links()}} --}}
            </div>
        </div>
    </div>
</div>
