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
