@push('styles')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

@endpush
@push('scripts')
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endpush
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
                             <h2>Riwayat Pembayaran</h2>
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
                                 <th>PERMOHONAN</th>
                                 <th>NO. REGISTRASI</th>
                                 <th>JENIS</th>
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
                                    <td>PBG</td>
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
                                            <a href="{{route('retribusi.pemohon.bayar', ['id'=>$row->permohonan->nomor,'jenis'=>'pbg'])}}" class="btn btn-primary btn-sm">Bayar</a>
                                        @elseif($row->status_pembayaran=="Dibayar")
                                            Menunggu Verifikasi
                                        @else
                                          Terbayar
                                        @endif
                                    </td>
                                 </tr>
                             @empty
                        
                             @endforelse
                             @foreach ($retribusireklame as $row)
                             <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>REKLAME</td>
                                <td>{{$row->permohonanreklame->nomor}}</td>
                                <td>{{$row->permohonanreklame->jenis_reklame}}</td>
                                <td>{{$row->permohonanreklame->alamat}}</td>
                                <td>{{Carbon\Carbon::parse($row->tanggal_tagihan)->format('d M Y')}}</td>
                                <td >Rp. {{number_format($row->jumlah_tagihan,0,',','.')}}</td>
                                <td>{{$row->status_pembayaran}}</td>
                                <td>
                                    {{-- <a href="{{route('anggota.edit', $row->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="{{route('anggota.show', $row->id)}}" class="btn btn-info btn-sm">Detail</a> --}}
                                    @if ($row->status_pembayaran == 'Belum Dibayar')
                                        <a href="{{route('retribusi.pemohon.bayar', ['id'=>$row->permohonanreklame->nomor,'jenis'=>'reklame'])}}" class="btn btn-primary btn-sm">Bayar</a>
                                    @elseif($row->status_pembayaran=="Dibayar")
                                        Menunggu Verifikasi
                                    @else
                                      Terbayar
                                    @endif
                                </td>
                             </tr>
                             @endforeach
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