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
                     
                   
                     <br/>
                     <table class="table table-borderd table-striped table-condensed" style=" font-size: 12px;">
                         <thead>
                             <tr>
                                 <th>NO</th>
                                 <th>NO. REGISTRASI</th>
                                 <th>BANGUNAN</th>
                                 <th>LOKASI BANGUNAN</th>
                                 <th>TANGGAL TAGIHAN</th>
                                 <th>JUMLAH TAGIHAN</th>
                                 <th>STATUS</th>
                                 <th>AKSI</th>
                             </tr>
                         </thead>
                         <tbody>
                             @forelse ($retribusi as $row)
                                 <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$row->permohonan->nomor}}</td>
                                    <td>{{$row->permohonan->fungsibangunan->nama.', '.$row->permohonan->jenisbangunan->nama}}</td>
                                    <td>{{$row->permohonan->alamat}}</td>
                                    <td>{{Carbon\Carbon::parse($row->tanggal_tagihan)->format('d M Y')}}</td>
                                    <td >Rp. {{number_format($row->jumlah_tagihan,0,',','.')}}</td>
                                    <td>{{$row->status_pembayaran}}</td>
                                    <td>
                                        {{-- <a href="{{route('anggota.edit', $row->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{route('anggota.show', $row->id)}}" class="btn btn-info btn-sm">Detail</a> --}}
                                        @if ($row->status_pembayaran == 'Belum Dibayar')
                                            <a href="{{route('retribusi.pemohon.bayar', $row->permohonan->nomor)}}" class="btn btn-primary btn-sm">Bayar</a>
                                        @elseif($row->status_pembayaran=="Dibayar")
                                            Menunggu Verifikasi
                                        @else
                                          Terbayar
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
                     {{$retribusi->links()}}
                     </div>
                 </div>
             </div>
         </div>
     </section>
    </section>
 </div>