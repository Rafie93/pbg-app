<div class="service-box">
    <h4>Menu Akun</h4>
    <div class="services-list">
      <a href="{{route('profile')}}" class="{{request()->segment(1)== 'profile' ? 'active' : ''}}"><i class="bi bi-arrow-right-circle"></i><span>Akun</span></a>
     
      
      <a href="{{route('logout')}}"><i class="bi bi-arrow-right-circle"></i><span>Logout</span></a>
    </div>
  </div>
 
  {{-- <div class="help-box d-flex flex-column justify-content-center align-items-center">
    <i class="bi bi-headset help-icon"></i>
    <h4>Have a Question?</h4>
    <p class="d-flex align-items-center mt-2 mb-0"><i class="bi bi-telephone me-2"></i> <span>+62 896-9195-5846</span></p>
    <p class="d-flex align-items-center mt-1 mb-0"><i class="bi bi-envelope me-2"></i> <a href="mailto:contact@example.com">contact@example.com</a></p>
  </div> --}}