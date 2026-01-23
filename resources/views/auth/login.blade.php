<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login | Klinik</title>

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

              <h4 class="text-center">Selamat Datang</h4>
              <h6 class="font-weight-light text-center mb-4">
                Silakan login untuk melanjutkan
              </h6>

              <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                  <input
                    type="text"
                    name="login"
                    class="form-control form-control-lg"
                    placeholder="Username atau Email"
                    value="{{ old('login') }}"
                    required
                  >
                </div>

                <div class="form-group">
                  <input
                    type="password"
                    name="password"
                    class="form-control form-control-lg"
                    placeholder="Password"
                    required
                  >
                </div>

                @if ($errors->any())
                  <div class="alert alert-danger">
                    {{ $errors->first() }}
                  </div>
                @endif

                <div class="mt-3 d-grid gap-2">
                  <button
                    type="submit"
                    class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
                  >
                    SIGN IN
                  </button>
                </div>

                <div class="my-2 d-flex justify-content-between align-items-center">
                  <a href="#" class="auth-link text-primary">
                    Forgot password?
                  </a>
                </div>

                <div class="text-center mt-4 font-weight-light">
                  Belum punya akun?
                  <a href="#" class="text-primary">
                    Daftar
                  </a>
                </div>

              </form>

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
