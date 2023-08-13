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
                  <form action="{{ route('login.auth') }}" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                      <input class="form-control" name="email" id="email" type="email" placeholder="name@example.com" />
                      <label for="email">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input class="form-control" name="password" id="password" type="password" placeholder="Password" />
                      <label for="password">Password</label>
                    </div>
                    <div class="form-check mb-3">
                      <input class="form-check-input"name="remember" id="remember" type="checkbox" value="" />
                      <label class="form-check-label" for="remember">Remember Password</label>
                    </div>
                    <div class="mt-4 mb-0 d-grid gap-2">
                      <button type="submit" class="btn btn-primary btn-block">Login</button>
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
