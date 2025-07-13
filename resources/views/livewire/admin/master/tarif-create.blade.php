
<div>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tarif Retribusi</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('master.tarif')}}">Data Tarif Retribusi</a></li>
            <li class="breadcrumb-item active">Tambah Tarif</li>
        </ol>
      
        <div class="card mb-4">
           
            <div class="card-body">
                <form method="POST" >
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Kepemilikan *</label>
                        <div class="col-sm-10">
                     
                        <div class="form-check
                        form-check-inline">
                            <input class="form-check
                            form-check-input" type="checkbox" value="Perseorangan" wire:model="kepemilikan">
                            <label class="form-check
                            form-check-label">Perseorangan</label>
                        </div>
                        <div class="form-check
                        form-check-inline">
                            <input class="form-check
                            form-check-input" type="checkbox" value="Perusahaan" wire:model="kepemilikan">
                            <label class="form-check
                            form-check-label">Perusahaan</label>
                        </div>
                        <div class="form-check
                        form-check-inline">
                            <input class="form-check
                            form-check-input" type="checkbox" value="Pemerintah" wire:model="kepemilikan">
                            <label class="form-check
                            form-check-label">Pemerintah</label>
                        </div>
                        <div class="form-check
                        form-check-inline">
                            <input class="form-check
                            form-check-input" type="checkbox" value="Badan Hukum" wire:model="kepemilikan">
                            <label class="form-check
                            form-check-label">Badan Hukum</label>
                        </div>
                        @error('kepemilikan')
                            <span class="text-danger"><i>{{$message}}</i></span>   
                        @enderror
                        </div>
                        <label  class="col-sm-2 col-form-label">Fungsi Bangunan *</label>
                        <div class="col-sm-10">
                        <select  wire:model="fungsi_bangunan_id" class="form-control" multiple>
                            @foreach ($option_fungsi as $row)
                                <option value="{{$row->id}}">{{$row->nama}}</option>
                            @endforeach
                        </select>
                        @error('fungsi_bangunan_id')
                            <span class="text-danger"><i>{{$message}}</i></span>   
                        @enderror
                        </div>
                        <label  class="col-sm-2 col-form-label">Durasi Pemanfaatan *</label>
                        <div class="col-sm-10">
                       
                            <div class="form-check
                            form-check-inline">
                                <input class="form-check
                                form-check-input" type="checkbox" value="> 5 Tahun" wire:model="durasi_pemanfaatan">
                                <label class="form-check
                                form-check-label">Lebih 5 Tahun</label>
                            </div>
                            <div class="form-check
                            form-check-inline">
                                <input class="form-check
                                form-check-input" type="checkbox" value="< 5 Tahun" wire:model="durasi_pemanfaatan">
                                <label class="form-check
                                form-check-label">Kurang 5 Tahun</label>
                            </div>
                            @error('durasi_pemanfaatan')
                                <span class="text-danger"><i> {{ $message }}</i></span>
                            @enderror
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Luas Bangunan *</label>
                        <div class="col-sm-5">
                            <label  class="col-form-label">Minimal (m2)</label>

                        <input type="number" class="form-control" placeholder="Luas Bangunan Minimal"
                        required wire:model="min_luas_bangunan">
                        @error('min_luas_bangunan')
                            <span class="text-danger"><i>{{$message}}</i></span>   
                        @enderror
                        </div>
                        <div class="col-sm-5">
                            <label  class="col-form-label">Maksimal (m2)</label>
                        <input type="number" class="form-control" placeholder="Luas Bangunan Maksimal"
                        required wire:model="max_luas_bangunan">
                        @error('max_luas_bangunan')
                            <span class="text-danger"><i>{{$message}}</i></span>   
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Jumlah Lantai *</label>
                        <div class="col-sm-5">
                            <label  class="col-form-label">Minimal </label>

                            <input type="number" class="form-control" placeholder="Jumlah Lantai Minimal"
                            required wire:model="min_jumlah_lantai">
                            @error('min_jumlah_lantai')
                                <span class="text-danger"><i>{{$message}}</i></span>   
                            @enderror
                        </div>
                        <div class="col-sm-5">
                            <label  class="col-form-label">Maksimal </label>
                            <input type="number" class="form-control" placeholder="Jumlah Lantai Maksimal"
                            required wire:model="max_jumlah_lantai">
                            @error('max_jumlah_lantai')
                                <span class="text-danger"><i>{{$message}}</i></span>   
                            @enderror
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Tarif Retribusi *</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" placeholder="Tarif (Rp)"
                        required wire:model="tarif">
                        @error('tarif')
                            <span class="text-danger"><i>{{$message}}</i></span>
                        @enderror
                    </div>
                   
                    <br/> <br/>
                      
                      <div class="form-group row">
                        <label  class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <button type="button" wire:click="store"
                             class="btn btn-primary">SUBMIT</button>
                        </div>
                      </div>
                  </form>
            </div>
        </div>
    </div>
</div>
