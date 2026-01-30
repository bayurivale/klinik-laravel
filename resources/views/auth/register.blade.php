<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Register | Klinik</title>

  <!-- Plugins CSS -->
  <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">

  <!-- Layout styles -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row flex-grow">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">

              <div class="brand-logo text-center">
                <img src="{{ asset('assets/images/logo.svg') }}" alt="logo">
              </div>

              <h4 class="text-center">Buat Akun Baru</h4>
              <h6 class="font-weight-light text-center mb-4">
                Silakan isi data untuk mendaftar
              </h6>

              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif

              <!-- FORM REGISTER MANUAL -->
              <form method="POST" action="{{ route('register.post') }}">
              @csrf

              <div class="form-group">
                <input type="text" name="username"
                      class="form-control form-control-lg"
                      placeholder="Nama / Username"
                      value="{{ old('username') }}"
                      required>
              </div>

              <div class="form-group">
                <input type="email" name="email"
                      class="form-control form-control-lg"
                      placeholder="Email"
                      value="{{ old('email') }}"
                      required>
              </div>

              <div class="form-group">
                <input type="password" name="password"
                      class="form-control form-control-lg"
                      placeholder="Password"
                      required>
              </div>

              <div class="form-group">
                <input type="password" name="password_confirmation"
                      class="form-control form-control-lg"
                      placeholder="Konfirmasi Password"
                      required>
              </div>

              <!-- ALAMAT -->
              <div class="form-group">
                <input type="text" name="alamat"
                      class="form-control form-control-lg"
                      placeholder="Alamat"
                      value="{{ old('alamat') }}"
                      required>
              </div>

              <!-- JENIS KELAMIN -->
              <div class="form-group">
                <select name="jenis_kelamin"
                        class="form-control form-control-lg"
                        required>
                  <option value="">Pilih Jenis Kelamin</option>
                  <option value="L">Laki-laki</option>
                  <option value="P">Perempuan</option>
                </select>
              </div>

              <!-- NO TELEPON -->
              <div class="form-group">
                <input type="text" name="no_telepon"
                      class="form-control form-control-lg"
                      placeholder="No Telepon"
                      value="{{ old('no_telepon') }}"
                      required>
              </div>

              <div class="mt-3">
                <button type="submit"
                        class="btn btn-gradient-primary btn-lg w-100">
                  Daftar
                </button>
              </div>
            </form>


              <!-- ATAU REGISTER DENGAN GOOGLE -->
              <div class="mt-3 d-grid gap-2">
                <a href="{{ route('google.login') }}" 
                   class="btn btn-danger btn-lg w-100 text-white fw-bold">
                  Daftar dengan Google
                </a>
              </div>

              <div class="text-center mt-4 font-weight-light">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-primary">Login</a>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- JS -->
  <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('assets/js/misc.js') }}"></script>
  <script src="{{ asset('assets/js/settings.js') }}"></script>
  <script src="{{ asset('assets/js/todolist.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.cookie.js') }}"></script>
</body>
</html>
