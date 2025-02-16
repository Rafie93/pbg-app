
<div>
    <section >
        <section id="features-cards" class="features-cards section">
       
        <div class="container">
            <div class="row">
                <section class="vh-100">
                    <div class="container-fluid h-custom ">
                      <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-md-9 col-lg-6 col-xl-5">
                          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                            class="img-fluid" alt="Sample image">
                        </div>
                        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 card">
                          <div class="mb-4 ml-2 mr-2" >
                            <form>
                                <!-- Email input -->
                                <div data-mdb-input-init class="form-outline mt-4 mb-4">
                                    <label class="form-label" for="form3Example3">Email address</label>
    
                                  <input type="email" wire:model="email" id="form3Example3" class="form-control form-control-lg"
                                    placeholder="Enter a valid email address" />
                                    @error('email')
                                    <span class="text-danger"><i> {{ $message }}</i></span>

                                 @enderror
                                </div>
                      
                                <!-- Password input -->
                                <div data-mdb-input-init class="form-outline mb-3">
                                    <label class="form-label" for="form3Example4">Password</label>
    
                                  <input type="password" wire:model="password" id="form3Example4" class="form-control form-control-lg"
                                    placeholder="Enter password" />
                                    @error('password')
                                    <span class="text-danger"><i> {{ $message }}</i></span>

                                 @enderror
                                </div>
                      
                                <div class="d-flex justify-content-between align-items-center">
                                  <!-- Checkbox -->
                                  <div class="form-check mb-0">
                                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                    <label class="form-check-label" for="form2Example3">
                                      Remember me
                                    </label>
                                  </div>
                                  <a href="#!" class="text-body">Forgot password?</a>
                                </div>
                      
                                <div class="text-center text-lg-start mt-4 pt-2">
                                  <button  type="button" wire:click="store" wire:loading.attr="disabled"
                                   data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg"
                                    style="padding-left: 2.5rem; padding-right: 2.5rem;">
                                    <span wire:loading.remove>Login</span>
                                    <span wire:loading class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    <span wire:loading>Loading...</span>
                                  </button>


                                  <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="{{route('register')}}"
                                      class="link-danger">Register</a></p>
                                </div>
                      
                              </form>
                          </div>
                        </div>
                      </div>
                    </div>
                 
                  </section>
            </div>
        </div>

        </section>
    </section>
    
</div>
