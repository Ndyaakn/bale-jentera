<!DOCTYPE html>
<html lang="en"  lang="en" data-textdirection="ltr">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="description" content="Batera">
  <meta name="keywords" content="Batera">
  <meta name="author" content="Batera">
  <meta name="_token" content="{{ csrf_token() }}">
  <title>Batera - @yield('title')</title>
  

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/components.css">
  <link rel="stylesheet" href="../assets/css/custom.css">
 
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <!-- navbar -->
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <!-- sidebar toggle -->
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
              <i class="fas fa-bars"></i></a>
            </li>
          </ul>
        </form>
        <!-- profile -->
        <ul class="navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">
              <span class="user-name text-bold-700">
              {{ Auth::user()->username }}
              </span>
            </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-divider"></div>
              <a href="/sign-out" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <!-- side bar -->
      <div class="main-sidebar sidebar-style-2" data-scroll-to-active="true">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <!-- <img class="brand-logo" alt="logo" src="/app-assets/logo-wp.png"> -->
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="">BJ</a>
          </div>
          <!-- menu -->
          <ul class="sidebar-menu">
              <li class="nav-item dropdown ">
                <a href="/home" class="nav-link "><i class="fas fa-solid fa-house"></i></i><span>Dashboard</span></a>
              </li>
              <li class="nav-item menu-navigasi">
                <a href="/manajemen-meja" class="nav-link" data-toggle="dropdown"><i class="fas fa-solid fa-chair"></i> <span>Meja</span></a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-solid fa-users"></i><span>Pelanggan</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="kategori-pelanggan.html">Kategori pelanggan</a></li>
                  <li><a class="nav-link" href="/manajemen-pelayan">Data pelanggan</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a  class="nav-link has-dropdown"><i class="fas fa-solid fa-wheat-awn-circle-exclamation"></i> <span>Manajemen bahan</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="jenis-bahan.html">Jenis bahan</a></li>
                  <li><a class="nav-link" href="Data-bahan.html">Data bahan</a></li>
                  <li><a class="nav-link" href="Jurnal-bahan.html">Jurnal bahan</a></li>
                </ul>
              </li>x
              <li class="nav-item dropdown">
                <a class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Manajemen menu</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link beep beep-sidebar" href="kategori-stand.html">Kategori stand</a></li>
                  <li><a class="nav-link beep beep-sidebar" href="kategori-menu.html">Kategori menu</a></li>
                  <li><a class="nav-link beep beep-sidebar" href="Manajemen-menu.html">Data menu</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a href="Jurnal.html" class="nav-link" data-toggle="dropdown"><i class="fa-solid fa-book"></i> <span>Jurnal</span></a>
              </li>
              <li class="nav-item dropdown">
                <a href="Laporan.html" class="nav-link has-dropdown"><i class="fas fa-solid fa-chart-simple"></i> <span>Laporan keuangan</span></a>
              </li>
          </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">

        <section class="section">
          <!-- <div class="section-header">
            <h1>Blank Page</h1>
            @yield('content-header')
          </div> -->

          <div class="section-body">
            @yield('content')
          </div>
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
        </div>
        <div class="footer-right">
          2.3.0
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="/assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  

  <!-- Template JS File -->
  <script src="/assets/js/scripts.js"></script> 
  <script src="/assets/js/custom.js"></script>
  

  <!-- Page Specific JS File -->
  <script src="/assets/js/page/index-modal.js"></script>
</body>
</html>
