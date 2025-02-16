<div>
   <section>
    <section id="hero"  class="service-details section">
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-12 ps-lg-12" >
                    <div class="service-box">
                        {{-- header --}}
                    <div class="row">
                        <div class="col-lg-6">
                            <h2>Daftar Permohonan</h2>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex justify-content-end">
                              
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="text" wire:model="search" class="form-control" placeholder="Cari Permohonan">
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex justify-content-end">
                                <a class="btn btn-primary "  href="{{route('ajukan.permohonan')}}">+ Tambah Permohonan</a>
                            </div>
                        </div>
                    </div>
                  
                    <br/>
                    <table class="table table-borderd table-striped table-condensed" style=" font-size: 12px;">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NO. REGISTRASI</th>
                                <th>TANGGAL</th>
                                <th>NAMA PEMOHON</th>
                                <th>KEPEMILIKAN</th>
                                <th>LOKASI BANGUNAN</th>
                                <th>STATUS PERMOHONAN</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($daftarpermohonan as $row)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$row->nomor}}</td>
                                    <td>{{Carbon\Carbon::parse($row->tanggal_permohonan)->format('d M Y')}}</td>
                                    <td>{{$row->pemohon->nama}}</td>
                                    <td>{{$row->pemilik_bangunan}}</td>
                                    <td>{{$row->alamat}}</td>
                                    <td>{{$row->status_permohonan}}</td>
                                    <td>
                                        {{-- <a href="{{route('anggota.edit', $row->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{route('anggota.show', $row->id)}}" class="btn btn-info btn-sm">Detail</a> --}}
                                        @if ($row->status_permohonan == 'Pengajuan')
                                            <button wire:click="destroy({{$row->id}})" class="btn btn-danger btn-sm">Hapus</button>
                                                 <a href="" class="btn btn-warning btn-sm">Edit</a>

                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">Data tidak ditemukan</td>
                                </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                    {{$daftarpermohonan->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
   </section>
</div>