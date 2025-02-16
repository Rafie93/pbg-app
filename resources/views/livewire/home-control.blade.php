<div>
    <section id="hero" class="hero section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">
          
         {{-- @if ($sliders) --}}
          <div class="row align-items-center">
            {{-- @foreach ($sliders as $slide) --}}
            <div class="col-lg-6">
              <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
                <h1 class="mb-4">
                  Selamat Datang di Aplikasi Perizinan PBG
                  <br/>
                  <span class="accent-text">
                    <a href="{{route('ajukan.permohonan')}}">Ajukan</a>
                  </span>
                </h1>

                <p class="mb-4 mb-md-5">
                 
                </p>

              
              </div>
            </div>

            <div class="col-lg-6">
              <div class="hero-image" data-aos="zoom-out" data-aos-delay="300">
                {{-- <img src="{{asset('storage/slider/'.$slide->image)}}" alt="Hero Image" class="img-fluid"> --}}
                
              </div>
            </div>
            {{-- @endforeach --}}
          </div>
         {{-- @endif --}}




  

        </div>
  
      </section>
</div>
