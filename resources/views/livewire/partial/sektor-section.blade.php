<section id="features-cards" class="features-cards section">
    <div class="container section-title" data-aos="fade-up">
        <h2>{{$sektor->count()}} Sektor</h2>
      </div>
    <div class="container">

      <div class="row gy-2">
        @php
              $input = array("orange", "blue", "green", "red");
        @endphp
        @foreach ($sektor as $item)
            @php
                shuffle($input);
                $random_keys=array_rand($input,4);
            @endphp
            <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                <div class="section-title feature-box {{$input[$random_keys[0]]}}">
                     <i class="bi bi-award"></i>
                <h5>{{$item->name}}</h5>
                <p> {{$item->total()}}</p>
                </div>
            </div>
        @endforeach

        {{-- <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
          <div class="feature-box orange">
            <i class="bi bi-award"></i>
            <h4>Corporis voluptates</h4>
            <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
          </div>
        </div><!-- End Feature Borx-->

        <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
          <div class="feature-box blue">
            <i class="bi bi-patch-check"></i>
            <h4>Explicabo consectetur</h4>
            <p>Est autem dicta beatae suscipit. Sint veritatis et sit quasi ab aut inventore</p>
          </div>
        </div><!-- End Feature Borx-->

        <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
          <div class="feature-box green">
            <i class="bi bi-sunrise"></i>
            <h4>Ullamco laboris</h4>
            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
          </div>
        </div><!-- End Feature Borx-->

        <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
          <div class="feature-box red">
            <i class="bi bi-shield-check"></i>
            <h4>Labore consequatur</h4>
            <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>
          </div>
        </div><!-- End Feature Borx-->

      </div> --}}

    </div>

  </section>