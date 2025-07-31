@push('styles')
    <style>
        .form-group{
            padding: 5px;
        }
    </style>
@endpush
<div>
    <section>
        <section id="service-details" class="service-details section">
            <div class="container">
              <div class="row gy-5">
                <div class="col-lg-4">
      
                      @include('livewire.partial.menu-profile')
      
                </div>
      
                <div class="col-lg-8 ps-lg-5" >
                    <div class="container">
                        <div class="row gutters">
                        <div class="col-12">
                            <div class="card h-100 ">
                              <form method="POST">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <h6 class="mb-2 text-primary">Personal Details</h6>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="fullName"
                                                wire:model="name"
                                                 placeholder="Enter full name">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="eMail">Email</label>
                                                <input type="email" class="form-control"
                                                wire:model="email" id="eMail" placeholder="Enter email ID">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" class="form-control" 
                                                wire:model="phone" id="phone" placeholder="Enter phone number">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="website">Password Baru</label>
                                                <input type="password" class="form-control"
                                                 id="password" placeholder="isi password ba jika ingin merubah">
                                            </div>
                                        </div>
                                        <br/><br/><hr>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Jenis Identitas</label>
                                                <select id="inputState" class="form-control" wire:model="jenis_identitas">
                                                    <option selected>Pilih Jenis Identitas  ...</option>
                                                    <option value="KTP">KTP</option>
                                                    <option value="KITAS">KITAS</option>
                                                </select>
                                                @error('jenis_identitas')
                                                    <span class="text-danger"><i> {{ $message }}</i></span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="fullName">No Identitas</label>
                                                <input type="text" wire:model="no_identitas"  required="required" class="form-control" 
                                                    placeholder="No Identitas ({{$jenis_identitas}})"/>
                                                @error('no_identitas')
                                                    <span class="text-danger"><i> {{ $message }}</i></span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Pekerjaan</label>
                                                <input type="text" wire:model="pekerjaan"  class="form-control" 
                                                placeholder="Pekerjaan (optional)"/>
                                                 @error('pekerjaan')
                                                       <span class="text-danger"><i> {{ $message }}</i></span>
           
                                                 @enderror
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Kota</label>
                                                <select id="inputState" class="form-control" @readonly(true) disabled
                                                 wire:change="getDistrict()"
                                                 wire:model="city_id">
                                                @foreach ($option_city as $item)
                                                    <option value="{{$item->id}}"> {{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('city_id')
                                            <span class="text-danger"><i> {{ $message }}</i></span>
                                        @enderror
                                            </div>
                                        </div>
                                       
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Kecamatan</label>
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
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Kelurahan</label>
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
                                   
                                    <br/>
                                    <div class="row gutters">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="text-right">
                                                <button type="button" id="submit" wire:click="update"
                                                 name="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </form>
                            </div>
                        </div>
                        </div>
                        </div>
                </div>
      
              </div>
      
            </div>
      
        </section>
    </section>
</div>
