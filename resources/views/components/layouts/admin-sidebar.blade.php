<div class="sb-sidenav-menu">
    <div class="nav">
        <div class="sb-sidenav-menu-heading">MENU</div>
        <a class="nav-link {{request()->segment(1)== 'dashboard' ? 'active' : ''}}" href="{{route('dashboard')}}">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Dashboard
        </a>
        @if (auth()->user()->role == 1 || auth()->user()->role == 2)
            <a class="nav-link {{request()->segment(1)== 'permohonan' ? 'active' : ''}} " href="{{route('permohonan.list')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                Permohonan
            </a>
            <a class="nav-link {{request()->segment(1)== 'retribusi' ? 'active' : ''}}" href="{{route('retribusi.list')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Retribusi
            </a>
            <a class="nav-link {{request()->segment(1)== 'survie' ? 'active' : ''}} " href="{{route('survie.list')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                Survei
            </a>
            <a class="nav-link {{request()->segment(1)== 'penerbitan-imb' ? 'active' : ''}} " href="{{route('penerbitan.list')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                Penerbitan
            </a>
            <a class="nav-link {{request()->segment(1)== 'sebaran' ? 'active' : ''}} " href="{{route('peta')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
               Sebaran Lokasi
            </a>
        
            <div class="sb-sidenav-menu-heading">LAPORAN</div>

            <a class="nav-link {{request()->segment(1)== 'laporan' ? '' : 'collapsed'}}" href="#" 
            data-bs-toggle="collapse" data-bs-target="#collapsePagesLaporan" 
                aria-expanded="false" aria-controls="collapsePagesLaporan">
                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                Laporan - Laporan
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse {{request()->segment(1)== 'laporan' ? 'show' : ''}}" id="collapsePagesLaporan" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link {{request()->segment(2)== 'laporan-pengajuan' ? 'active' : ''}}" 
                        href="{{route('laporan.pengajuan')}}">Laporan Pengajuan PBG</a>
                    <a class="nav-link {{request()->segment(2)== 'laporan-reklame' ? 'active' : ''}}" 
                            href="{{route('laporan.reklame')}}">Laporan Pengajuan Reklame</a>
                    <a class="nav-link {{request()->segment(2)== 'laporan-retribusi' ? 'active' : ''}}" 
                        href="{{route('laporan.retribusi')}}">Laporan Retribusi</a>
                    <a class="nav-link {{request()->segment(2)== 'laporan-survie' ? 'active' : ''}}" 
                        href="{{route('laporan.survie')}}">Laporan Survie</a>
                    <a class="nav-link {{request()->segment(2)== 'laporan-penerbitan-imb' ? 'active' : ''}}" 
                        href="{{route('laporan.penerbitan')}}">Laporan Penerbitan</a>
                   
                    <a class="nav-link {{request()->segment(2)== 'rekap-survie' ? 'active' : ''}}" 
                            href="{{route('rekap.survie')}}">Rekapitulasi Survie Bangunan</a>
                    <a class="nav-link {{request()->segment(2)== 'rekap-pembayaran' ? 'active' : ''}}" 
                        href="{{route('rekap.pembayaran')}}">Rekapitulasi Pembayaran</a>
                    <a class="nav-link {{request()->segment(2)== 'rekap-reklame' ? 'active' : ''}}" 
                        href="{{route('rekap.reklame')}}">Rekapitulasi Perizinan Reklame</a>  
                    <a class="nav-link {{request()->segment(2)== 'perizinan' ? 'active' : ''}}" 
                        href="{{route('laporan.perizinan')}}">Laporan Perizinan</a>  
                </nav>
            
            </div>
        
            <div class="sb-sidenav-menu-heading">MASTER</div>

            <a class="nav-link {{request()->segment(1)== 'master' ? '' : 'collapsed'}}" href="#" 
            data-bs-toggle="collapse" data-bs-target="#collapsePages" 
                aria-expanded="false" aria-controls="collapsePages">
                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                Master Data
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse {{request()->segment(1)== 'master' ? 'show' : ''}}" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link {{request()->segment(2)== 'jenis-bangunan' ? 'active' : ''}}" href="{{route('master.jenis-bangunan')}}">Jenis Bangunan</a>
                    <a class="nav-link {{request()->segment(2)== 'fungsi' ? 'active' : ''}}" href="{{route('master.fungsi')}}">Fungsi Bangunan</a>
                    <a class="nav-link {{request()->segment(2)== 'petugas' ? 'active' : ''}}" href="{{route('master.petugas')}}">Petugas</a>
                    <a class="nav-link {{request()->segment(2)== 'tarif' ? 'active' : ''}}" href="{{route('master.tarif')}}">Tarif Retribusi PBG</a>
                    <a class="nav-link {{request()->segment(2)== 'tarif-reklame' ? 'active' : ''}}" href="{{route('master.tarif-reklame')}}">Tarif Reklame</a>

                </nav>
            
            </div>
        @elseif(auth()->user()->role == 4) 
            <a class="nav-link {{request()->segment(1)== 'survie' ? 'active' : ''}} " href="{{route('survie.list')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                Survie
            </a>
        @endif
        
        
    </div>
</div>