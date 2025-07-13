<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="/" class="{{request()->segment(1)== null ? 'active' : ''}}">Beranda</a></li>
          {{-- to section --}}
          @if (request()->segment(1)== null)
            <li><a href="#features-cards" class="">Kalkulasi Retribusi</a></li>              
          @endif
          @if (Auth::check())
            <li><a href="{{route('retribusi.pemohon')}}" class="{{request()->segment(1)== 'retribusi-pemohon' ? 'active' : ''}}">Pembayaran</a></li> 
          @else

          @endif
          <li><a href="{{route('hubungi-kami')}}" class="">Hubungi Kami</a></li>


         
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      @if (Auth::check())
          {{-- <a class="btn-getstarted" href="{{route('profile')}}">My Profile</a> --}}
          <div class="btn-getstarted">
           
            <a class="btn-register" href="{{route('profile')}}">My Profile</a>
          </div>

      @else
      <div class="btn-getstarted">
        <a class="btn-login" href="{{route('login')}}">Login</a>
        <a class="btn-register" href="{{route('register')}}">Daftar</a>
      </div>
        
      @endif
    

    </div>
  </header>
  
