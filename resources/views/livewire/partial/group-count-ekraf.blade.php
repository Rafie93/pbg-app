
<div class="row stats-row gy-4 mt-5" data-aos="fade-up" data-aos-delay="500">
    
    <div class="col-lg-3 col-md-6">
      <div class="stat-item">
        <div class="stat-icon">
          <i class="bi bi-trophy"></i>
        </div>
        <div class="stat-content">
          <h4>{{$city_count}}</h4>
          <p class="mb-0">Kota dan Kabupaten</p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="stat-item">
        <div class="stat-icon">
          <i class="bi bi-briefcase"></i>
        </div>
        <div class="stat-content">
          <h4>{{$pelaku_ekraf->count()}}</h4>
          <p class="mb-0">Pelaku Ekraf</p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="stat-item">
        <div class="stat-icon">
          <i class="bi bi-graph-up"></i>
        </div>
        <div class="stat-content">
          <h4>{{$total_komunitas}}</h4>
          <p class="mb-0">Komunitas</p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="stat-item">
        <div class="stat-icon">
          <i class="bi bi-award"></i>
        </div>
        <div class="stat-content">
          <h4>{{$total_produk}}</h4>
          <p class="mb-0">Produk</p>
        </div>
      </div>
    </div>
  </div>