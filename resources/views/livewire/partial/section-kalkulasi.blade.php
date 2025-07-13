<section id="features-cards" class="features-cards section">
  <div class="container section-title" >
      <h2>Kalkulasi Biaya Retribusi</h2>
    </div>
  <div class="container">
    <div class="row gy-2 ">
      <div class="form-row">
        
        <div class="form-group col-md-4"> 
            <select id="inputState" class="form-control" wire:model="jenis_permohonan" wire:change="changeValue">
                <option selected>Pilih Jenis permohonan  ...</option>
                <option value="PBG">PBG</option>
                <option value="Reklame">Reklame</option>
            </select>
            @error('jenis_permohonan')
                <span class="text-danger"><i> {{ $message }}</i></span>
            @enderror
        </div>
        <div class="form-group col-md-4"> 
            <select id="inputState" class="form-control" wire:model="kepemilikan">
                @if ($jenis_permohonan=="Reklame")
                    <option selected>Pilih Jenis Reklame  ...</option>
                    <option value="Papan/Billboard">Papan/Billboard</option>
                    <option value="Videotron/Megatron">Videotron/Megatron</option>
                    <option value="Spanduk">Spanduk</option>
                    <option value="Baliho">Baliho</option>
                    <option value="Poster">Poster</option>
                @else 
                    <option selected>Pilih Jenis Kepemilikan  ...</option>
                    <option value="Perseorangan">Perseorangan</option>
                    <option value="Perusahaan">Perusahaan</option>
                    <option value="Pemerintah">Pemerintah</option>
                    <option value="Badan Hukum">Badan Hukum</option>
                @endif
               
            </select>
            @error('kepemilikan')
                <span class="text-danger"><i> {{ $message }}</i></span>
            @enderror
        </div>
        @if ($jenis_permohonan=="PBG")
        <div class="form-group col-md-4"> 
            <select id="inputState" class="form-control" wire:model="fungsi_bangunan">
                <option selected>Pilih Fungsi Bangunan ...</option>
                @foreach ($option_fungsi_bangunan as $item)
                    <option value="{{$item->id}}">Bangunan {{$item->nama}}</option>
                @endforeach
            </select>
            @error('fungsi_bangunan')
                <span class="text-danger"><i> {{ $message }}</i></span>
            @enderror
        </div>
        @endif

        <div class="form-group col-md-4"> 
            @if ($jenis_permohonan=="Reklame")
                <input type="number" wire:model="durasi_pemanfaatan"  class="form-control" 
                placeholder="durasi lama (bulan) contoh 2 " />
            @else
                <select id="inputState" class="form-control" wire:model="durasi_pemanfaatan">
                    <option selected>Pilih Durasi Pemanfaatan Bangunan ...</option>
                    <option value="> 5 Tahun">Lebih 5 Tahun</option>
                    <option value="< 5 Tahun">Kurang 5 Tahun</option>
                </select>
                
            @endif
            @error('durasi_pemanfaatan')
                <span class="text-danger"><i> {{ $message }}</i></span>
            @enderror
      </div>
      
        <div class="form-group col-md-4"> 

            <input type="text" wire:model="luas_bangunan"  class="form-control" 
            placeholder="{{$jenis_permohonan=='PBG' ? 'Luas Bangunan (m2)' : 'Ukuran (meter)'}}"/>
            @error('luas_bangunan')
                <span class="text-danger"><i> {{ $message }}</i></span>
            @enderror
        </div>
        @if ($jenis_permohonan=="PBG")
        <div class="form-group
        col-md-4"> 
            <input type="text" wire:model="jumlah_lantai"  class="form-control" 
            placeholder="Jumlah Lantai"/>
            @error('jumlah_lantai')
                <span class="text-danger"><i> {{ $message }}</i></span>
            @enderror
        </div>
        @endif

        {{-- tombol hitung perkiraan posisi center--}}
        <div class="form-group col-md-12"> 
            <button class="btn btn-primary" wire:click="hitungPerkiraan">Hitung Perkiraan Retribusi</button>
        </div>
        {{-- hasil group Estimasi Retribusi PBG Bangunan Baru --}}
        <div class="form-group col-md-12"> 
            <h4>Estimasi Retribusi PBG Bangunan Baru</h4>
            <p>Perkiraan Retribusi : </p> <h2><strong>Rp. {{number_format($estimasi_retribusi,0,',','.')}}</strong></h2>
        </div>
      
      
    </div>
      
    </div>
  </div>

</section>