<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="/app-assets/logo-wp.png">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" contet="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords"
        content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>Batera - Login</title>
    <link href="/app-assets/fonts/fonts.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/app-assets/fonts/line-awesome/css/line-awesome.min.css">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/icheck/custom.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/app.min.css">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/login-register.min.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <!-- END Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/toastr.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/extensions/toastr.min.css">
</head>

<body class="vertical-layout vertical-menu-modern 1-column menu-expanded blank-page blank-page bg-gradient-x-dark"
    data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content h-100">
        <div class="content-wrapper h-100">
            <div class="content-body row h-100">
                <div class="col-7">
                    <div class="d-flex h-100">
                        <div class="justify-content-center align-self-center text-center mx-auto">
                            <img src="https://source.unsplash.com/1600x900/?restaurant" alt="branding logo">
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="row h-100">
                        <div class="col-12 box-shadow-2 p-0 h-100">
                            <div class="card border-grey border-lighten-3 mr-1 rounded-0 w-100 h-100" style="padding: 0% 17% 0% 17% !important;">
                                <div class="card-header border-0 pt-4 pb-2 mt-5">
                                    <div class="card-title text-center">
                                        <div class="pb-2">
                                            <img src="/app-assets/logo-wp.png" class="img-fluid"
                                                alt="logo Batera" width="150" height="150">
                                            </h6>
                                        </div>
                                        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Batera</span>
                                    </div>
                                </div>
                                <div class="card-content" id="add-content">
                                    <div class="card-body pt-1" id="remove-content">
                                        <form class="form-horizontal form-simple" method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <fieldset class="form-group position-relative has-icon-left mb-1">
                                                <input type="text" name="email" class="form-control" placeholder="Masukkan alamat e-mail" autofocus required>
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="password" name="password" class="form-control"id="user-password" placeholder="Masukkan password" minlength="6" required>
                                                <div class="form-control-position">
                                                    <i class="ft-lock"></i>
                                                </div>
                                            </fieldset>
                                            <div class="form-group mb-3">
                                                <button type="submit" class="btn btn-block round box-shadow-3" style="background-color: #92CB48; color: white;">
                                                <i class="ft-unlock"></i> Login
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <!-- BEGIN VENDOR JS-->
    <script src="/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript">
    </script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script src="/app-assets/js/core/app-menu.min.js" type="text/javascript"></script>
    <script src="/app-assets/js/core/app.min.js" type="text/javascript"></script>
    <!-- END MODERN JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="/app-assets/js/scripts/forms/form-login-register.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
    <script src="/app-assets/vendors/js/extensions/toastr.min.js" type="text/javascript"></script>
    <script src="/app-assets/js/scripts/extensions/toastr.min.js" type="text/javascript"></script>
    <script src="/js/sw-loader.js"></script>
    @yield('script')

    <script>

    </script>
    @if(session('OK'))
        <script>
            toastr.success('{{ session("OK") }}', 'Success!');
        </script>
    @endif
    @if(session('ERR'))
        <script>
            toastr.error('{{ session("ERR") }}', 'Error!');
        </script>
    @endif
</body>

</html>
