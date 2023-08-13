<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">
    <title>@yield('title')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('themes/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  </head>
  <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
      <!-- Navbar Brand-->
      <a class="navbar-brand ps-3" href="index.html">ASMIP</a>
      <!-- Sidebar Toggle-->
      <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
      <!-- Navbar Search-->
      <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        
      </form>
      <!-- Navbar-->
      <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li>
              <form action="{{ route('logout') }}" method="post" class="nav-link">
                @csrf
                <button type="submit" class="border-0 bg-white">Logout</button>
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <div id="layoutSidenav">
      <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
          <div class="sb-sidenav-menu">
            <div class="nav">
              <div class="sb-sidenav-menu-heading">Core</div>
              <a class="nav-link {{ request()->is(['dashboard', 'dashboard/*']) ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
              </a>
              <a class="nav-link {{ request()->is(['kasir', 'kasir/*']) ? 'active' : '' }}" href="{{ route('kasir') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-cash-register"></i></div>
                Kasir
              </a>
              <a class="nav-link {{ request()->is(['barang', 'barang/*']) ? 'active' : '' }}" href="{{ route('barang') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-boxes-stacked"></i></div>
                Barang
              </a>
              <a class="nav-link {{ request()->is(['transaksi', 'transaksi/*']) ? 'active' : '' }}" href="{{ route('transaksi') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-exchange"></i></div>
                Transaksi
              </a>
            </div>
          </div>
          <div class="sb-sidenav-footer">
            <div class="small">Login sebagai:</div>
            <span class="text-capitalize">{{ Auth::user()->role }}</span>
          </div>
        </nav>
      </div>
      <div id="layoutSidenav_content">
        <main>
          @yield('content')
        </main>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('themes/js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('themes/js/datatables-simple-demo.js') }}"></script>

    <script>
      function rupiahJs(bilangan) {
        let	number_string = bilangan.toString(),
          split= number_string.split(","),
          sisa= split[0].length % 3,
          rupiah= split[0].substr(0, sisa),
          ribuan= split[0].substr(sisa).match(/\d{1,3}/gi);

        if (ribuan) {
          separator = sisa ? "." : "";
          rupiah += separator + ribuan.join(".");
        }
        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;

        return rupiah;
      }
      function rupiahJsKeyup(angka, prefix) {
        let number_string = angka.replace(/[^,\d]/g, "").toString(),
          split= number_string.split(","),
          sisa= split[0].length % 3,
          rupiah= split[0].substr(0, sisa),
          ribuan= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
          separator = sisa ? "." : "";
          rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "";
      }
    </script>
    
    @yield('script')
  </body>
</html>
