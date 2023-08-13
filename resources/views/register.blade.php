<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Login</title>
  <link href="{{ asset('themes/css/styles.css') }}" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
  <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
      <main>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5">
              <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                <div class="card-body">
                  <form action="{{ route('register.store') }}" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                      <input class="form-control @error('name') is-invalid @enderror" name="name" id="name" type="text" value="{{ old('name') }}" placeholder="nama" />
                      <label for="name">Nama</label>
                      @error('name')
                        <span class="text-danger fst-italic">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-floating mb-3">
                      <input class="form-control @error('email') is-invalid @enderror" name="email" id="name" type="email" value="{{ old('email') }}" placeholder="email" />
                      <label for="name">Email</label>
                      @error('email')
                        <span class="text-danger fst-italic">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-floating mb-3">
                      <input class="form-control @error('password') is-invalid @enderror" name="password" id="password" type="password" placeholder="password" />
                      <label for="password">Password</label>
                      @error('password')
                        <span class="text-danger fst-italic">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-floating mb-3">
                      <input class="form-control" name="password_confirmation" id="password_confirmation" type="password" placeholder="password_confirmation" />
                      <label for="password_confirmation">Password Konfirmasi</label>
                    </div>
                    <div class="mt-4 mb-0 d-grid gap-2">
                      <button type="submit" class="btn btn-primary btn-block">Daftar</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="{{ asset('themes/js/scripts.js') }}"></script>
</body>
</html>
