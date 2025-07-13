@push('styles')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

@endpush
@push('scripts')
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endpush
<div>
    <section >
        <section id="features-cards" class="features-cards section">
       
        <div class="container">
            <div class="row">
                <div class="container">
                    <div class="row ">
                        <div class="col-md-4 py-5 bg-primary text-white text-center ">
                            <div class=" ">
                                <div class="card-body">
                                    <img src="http://www.ansonika.com/mavia/img/registration_bg.svg" style="width:30%">
                                    <h2 class="py-3">Pembayaran</h2>
                                    <p>
                                       Lakukan pembayaran retribusi dengan mengisi form di bawah ini dan mengunggah bukti pembayaran, kami akan segera memprosesnya.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 py-5 border">
                           
                            <form>
                                <h5 class="pb-2">Data Retribusi</h5>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Nomor Registrasi</label>
                                        @if ($jenis_permohonan=='reklame')
                                            <input readonly value="{{$retribusis->permohonanreklame->nomor}}" class="form-control" type="text">  
                                        @else
                                             <input readonly value="{{$retribusis->permohonan->nomor}}" class="form-control" type="text">  
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Pemohon</label>
                                        @if ($jenis_permohonan=='reklame')
                                        <input readonly value="{{$retribusis->permohonanreklame->pemohon->nama}}" class="form-control" type="text">  
                                        @else
                                        <input readonly value="{{$retribusis->permohonan->pemohon->nama}}" class="form-control" type="text">  
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        @if ($jenis_permohonan=='reklame')
                                        <label for="inputEmail4">Jenis Reklame</label>
                                        <input readonly value="{{$retribusis->permohonanreklame->jenis_reklame.',('.$retribusis->permohonanreklame->ukuran}} m)" class="form-control" type="text"> 
                                        @else
                                        <label for="inputEmail4">Bangunan</label>
                                        <input readonly value="{{$retribusis->permohonan->fungsibangunan->nama.','.$retribusis->permohonan->jenisbangunan->nama}}" class="form-control" type="text"> 
                                        @endif 
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Alamat</label>
                                        <input readonly value="{{$retribusis->permohonan->alamat.','.$retribusis->permohonan->village()}}" class="form-control" type="text">  
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Tanggal Tagihan</label>
                                        <input readonly value="{{$retribusis->tanggal_tagihan}}" class="form-control" type="text">  
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Jumlah Retribusi</label>
                                        <input readonly value="Rp. {{number_format($retribusis->jumlah_tagihan)}}" class="form-control" type="text">  
                                    </div>
                                  </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Tanggal Pembayaran :</label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="date" class="form-control" wire:model="tanggal_bayar"  placeholder="Tanggal Pembayaran">
                                        @error('tanggal_bayar')
                                            <span class="text-danger"><i> {{ $message }}</i></span>
                                         @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        {{-- upload file --}}
                                        <label for="">Upload Bukti Pembayaran *</label>
                                        <input type="file" wire:model="bukti_pembayaran" accept="image/*"
                                        class="form-control" id="inputPassword4" placeholder="Bukti Pembayaran *">
                                        @error('bukti_pembayaran')
                                            <span class="text-danger"><i> {{ $message }}</i></span>

                                         @enderror
                                    </div>

                                   
                                   
                                </div>
                               
                               
                                
                                <div class="form-row">
                                    <button type="button"
                                         wire:click="store" wire:loading.attr="disabled"
                                         class="btn btn-danger">
                                         <span wire:loading.remove>KIRIM BUKTI PEMBAYARAN</span>
                                         <span wire:loading class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                         <span wire:loading>Loading...</span>
                                        </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </section>
    </section>
</div>
