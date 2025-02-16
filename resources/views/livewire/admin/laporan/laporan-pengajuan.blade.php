<div>
    <div class="container-fluid">
        <h1 class="mt-4">Laporan Pengajuan</h1>
        <ol class="breadcrumb
        mb-4">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Laporan Pengajuan</li>
        </ol>
        {{-- nuatkan input periode tanggal mulai dan akhir --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Filter Laporan
                    </div>
                    <div class="card-body">
                        <form action="{{route('laporan.pengajuan.pdf')}}" method="get"
                            target="_blank">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group
                                    mb-3">
                                        <label for="">Tanggal Mulai</label>
                                        <input type="date" name="startdate" class="form-control" value="{{request()->get('start_date')}}">
                                        @error('start_date')
                                        <div class="text-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group
                                    mb-3">
                                        <label for="">Tanggal Akhir</label>
                                        <input type="date" name="enddate" class="form-control" value="{{request()->get('end_date')}}">
                                        @error('end_date')
                                        <div class="text-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group
                                    mb-3">
                                        <label for="">Status</label>
                                        <select name="status" id="" class="form-control">
                                            <option value="">Semua Status</option>
                                            <option value="Diajukan">Diajukan</option>
                                            <option value="Diproses">Diproses</option>

                                        </select>
                                        @error('status')
                                        <div class="text-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- tombol cetak --}}
                                <div class="col-md-3">
                                    <br/>
                                    <div class="form-group
                                    mb-3">
                                        <label for=""></label>
                                        <button type="submit" class="btn btn-primary btn-block">Cetak Laporan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

</div>
