<div>
  <div class="container-fluid px-4">
      <h1 class="mt-4">Retribusi</h1>
      <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item active">Daftar Retribusi</li>
          <li class="breadcrumb-item active">Detail Retribusi</li>
      </ol>
  <div class="card mb-4 mt-10">
          <div class="container">
              <div class="detail-ekraf">
                  <div class="detail-ekraf-head">
                
                  <div class="bottom">
                     <table class="table">
                          <thead>
                              <tr>
                                  <td>Nomor Registrasi</td>
                                  <td>: {{$data->permohonan->nomor}}</td>
                                  <td>Tanggal Registrasi</td>
                                  <td>: {{$data->permohonan->tanggal_permohonan}}</td>
                              </tr>
                              <tr>
                                  <td>Kepemilikan</td>
                                  <td>: {{$data->permohonan->pemilik_bangunan}}</td>
                                  <td>Alamat</td>
                                  <td>: {{$data->permohonan->village()}}, {{$data->permohonan->district()}}</td>
                              </tr>
                              <tr>
                                  <td>Nama Pemohon</td>
                                  <td>: {{$data->permohonan->pemohon->nama}}</td>
                                  <td>No HP</td>
                                  <td>: {{$data->permohonan->pemohon->no_hp}}</td>
                              </tr>
                             
                          </thead>
                          <tbody>
                            <tr>
                              <td>Tanggal Tagihan</td>
                              <td>: {{$data->tanggal_tagihan}}</td>
                              <td>Tanggal Pembayaran</td>
                              <td>: {{$data->tanggal_bayar}}</td>
                            </tr>
                            <tr>
                              <td>Biaya Retribusi</td>
                              <td>: Rp. {{number_format($data->jumlah_tagihan)}}</td>
                              <td>Status Pembayaran</td>
                              <td>: {{$data->status_pembayaran}}</td>
                            </tr>
                            <tr>
                              <td>Bukti Pembayaran</td>
                              <td colspan="3">
                                @if ($data->bukti_pembayaran)
                                <a href="{{asset('storage/'.$data->bukti_pembayaran)}}" target="_blank">
                                  <img height="100px"
                                  src="{{asset('storage/'.$data->bukti_pembayaran)}}" alt="">
                                </a>
                                @endif
                              </td>
                            </tr>
                          </tbody>
                     </table>
                  </div>
                  @if ($data->status_pembayaran=='Dibayar')
                    <br/>
                      <div class="mt-10">
                          <button wire:click="terima()"  class="btn btn-primary">VERIFIKASI PEMBAYARAN</button>
                          <button wire:click="tolak()"   class="btn btn-danger ">TOLAK PEMBAYARAN</button>
                      </div>
                      <br/>
                  @endif

                   </div>
              </div>
          </div>
  </div>
  </div>
</div>
