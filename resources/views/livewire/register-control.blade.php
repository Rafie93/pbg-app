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
                                    <h2 class="py-3">Registration</h2>
                                    <p>
                                        Daftar akun dan lengkapilah data diri anda
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 py-5 border">
                           
                            <form>
                                <h5 class="pb-2">Data Akun</h5>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                      <input id="Full Name" name="name" 
                                        placeholder="Nama Anda *"
                                        wire:model="name"  required="required"
                                         class="form-control" type="text">
    
                                         @error('name')
                                            <span class="text-danger"><i> {{ $message }}</i></span>

                                         @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                      <input type="email" wire:model="email"  required="required" class="form-control" 
                                      id="inputEmail4" placeholder="Email *">
                                      @error('email')
                                            <span class="text-danger"><i> {{ $message }}</i></span>

                                         @enderror
                                    </div>
                                  </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input id="Mobile No." wire:model="phone" name="phone" placeholder="No HP/WA *" class="form-control" 
                                        required="required" type="text">
                                        @error('phone')
                                            <span class="text-danger"><i> {{ $message }}</i></span>

                                         @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <input id="Mobile No." wire:model="password" name="password" placeholder="Password *" class="form-control" 
                                        required="required" type="password">
                                        @error('password')
                                            <span class="text-danger"><i> {{ $message }}</i></span>
                                         @enderror
                                    </div>
                                   
                                </div>
                                <hr/>
                                <h5 class="pb-2">Data Pemohon</h5>
                                <div class="form-row">
                                    <div class="form-group col-md-6"> 
                                        <select id="inputState" class="form-control" wire:model="jenis_identitas">
                                            <option selected>Pilih Jenis Identitas  ...</option>
                                            <option value="KTP">KTP</option>
                                            <option value="KITAS">KITAS</option>
                                        </select>
                                        @error('jenis_identitas')
                                            <span class="text-danger"><i> {{ $message }}</i></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6"> 
                                        <input type="text" wire:model="no_identitas"  required="required" class="form-control" 
                                       placeholder="No Identitas ({{$jenis_identitas}})"/>
                                        @error('no_identitas')
                                            <span class="text-danger"><i> {{ $message }}</i></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12"> 
                                        <input type="text" wire:model="pekerjaan"  class="form-control" 
                                       placeholder="Pekerjaan (optional)"/>
                                        @error('pekerjaan')
                                              <span class="text-danger"><i> {{ $message }}</i></span>
  
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4"> 
                                        
                                        <select id="inputState" class="form-control" @readonly(true) disabled
                                             wire:change="getDistrict()"
                                             wire:model="city_id">
                                            <option selected>Pilih Kota/Kab  ...</option>
                                            @foreach ($option_city as $item)
                                                <option value="{{$item->id}}"> {{$item->name}}</option>
                                            @endforeach
                                        </select>
                                      
                                        
                                        @error('city_id')
                                        <span class="text-danger"><i> {{ $message }}</i></span>
                                    @enderror
                                    </div>
                                    <div class="form-group col-md-4"> 
                                        <select id="inputState" class="form-control"  wire:change="getVillage()" wire:model="kecamatan_id">
                                            <option selected>Pilih Kecamatan  ...</option>
                                            @foreach ($option_district as $item)
                                                <option value="{{$item->id}}"> {{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('kecamatan_id')
                                        <span class="text-danger"><i> {{ $message }}</i></span>
                                    @enderror
                                    </div>
                                    <div class="form-group col-md-4"> 
                                        <select id="inputState" class="form-control" wire:model="kelurahan_id">
                                            <option selected>Pilih Kel/Desa  ...</option>
                                            @foreach ($option_village as $item)
                                                <option value="{{$item->id}}"> {{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('kelurahan_id')
                                        <span class="text-danger"><i> {{ $message }}</i></span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12"> 
                                      <textarea name="alamat" wire:model="alamat" placeholder="Alamat " class="form-control"
                                      cols="20" rows="5"></textarea>
                                        @error('alamat')
                                            <span class="text-danger"><i> {{ $message }}</i></span>
                                         @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <div class="form-check">
                                              <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                              <label class="form-check-label" for="invalidCheck2">
                                                <small>By clicking Submit, you agree to our Terms & Conditions, Visitor Agreement and Privacy Policy.</small>
                                              </label>
                                            </div>
                                          </div>
                                
                                      </div>
                                </div>
                                
                                <div class="form-row">
                                    <button type="button"
                                         wire:click="store" wire:loading.attr="disabled"
                                         class="btn btn-danger">
                                         <span wire:loading.remove>Kirim Pendaftaran</span>
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
