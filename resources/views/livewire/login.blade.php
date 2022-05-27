<div>
    <div class="container">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="{{asset('storage/images/'.config('app.logo'))}}" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Connexion</h4></div>

              <div class="card-body">
                <form wire:submit.prevent="connecter" class="needs-validation"  novalidate="">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" placeholder="Adresse E-mail" wire:model="form.email" tabindex="1" required autofocus>

                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password"  class="control-label">Mot de passe</label>
                      <div class="float-right">
                        <a href="auth-forgot-password.html" class="text-small">
                          {{-- Forgot Password? --}}
                        </a>
                      </div>
                    </div>
                    <input type="password" placeholder="Mot de passe" class="form-control" wire:model="form.password" tabindex="2" required>

                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Se connecter
                    </button>
                  </div>
                </form>


              </div>
            </div>

          </div>
        </div>
      </div>
</div>
@section('js')
<script>
    window.addEventListener('errorLogin', event =>{
        iziToast.error({
        title: 'Connexion',
        message: 'Email ou mot de passe incorrect',
        position: 'topLeft'
        });
    })
</script>

@endsection
