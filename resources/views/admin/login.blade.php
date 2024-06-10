<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>LOGIN ADMIN SI LANNI</title>
    <meta name="description" content="Login Page" />
    <!-- Favicon Tags Start -->
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="img/favicon/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/favicon/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/favicon/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/favicon/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="img/favicon/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="img/favicon/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="img/favicon/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="img/favicon/apple-touch-icon-152x152.png" />
    <link rel="icon" type="image/png" href="img/favicon/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="img/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="img/favicon/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="img/favicon/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="img/favicon/favicon-128.png" sizes="128x128" />
    <meta name="application-name" content="&nbsp;" />
    <link rel="shortcut icon" href="https://sia.iainkendari.ac.id/assets/images/favicon.ico" type="image/x-icon">

    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="img/favicon/mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="img/favicon/mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="img/favicon/mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="img/favicon/mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="img/favicon/mstile-310x310.png" />
    <!-- Favicon Tags End -->
    <!-- Font Tags Start -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="font/CS-Interface/style.css" />
    <!-- Font Tags End -->
    <!-- Vendor Styles Start -->
    <link rel="stylesheet" href="{{asset('/')}}css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="{{asset('/')}}css/vendor/OverlayScrollbars.min.css" />

    <!-- Vendor Styles End -->
    <!-- Template Base Styles Start -->
    <link rel="stylesheet" href="{{asset('/')}}css/styles.css" />
    <!-- Template Base Styles End -->

    <link rel="stylesheet" href="{{asset('/')}}css/main.css" />
    <!-- <script src="{{asset('/')}}js/base/loader.js"></script> -->

    <style>
        .fixed-background {
            background: url("https://tracerstudy.iainkendari.ac.id/bg.jpeg") no-repeat center center;
            /* background-size: cover; */
            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body class="h-100">
    <!-- <div id="root" class="h-100"> -->
    <div class="h-100">
        <!-- Background Start -->
        <div class="fixed-background"></div>
        <!-- Background End -->

        <div class="container-fluid p-0 h-100 position-relative">
            <div class="row g-0 h-100">
                <!-- Left Side Start -->
                <div class="offset-0 col-12 d-none d-lg-flex offset-md-1 col-lg h-lg-100">
                    <div class="min-h-100 d-flex align-items-center">
                        <div class="w-100 w-lg-75 w-xxl-50">
                            <div>
                                <!-- <div class="mb-5">
                                    <h1 class="display-3 text-white">SI LANNI</h1>
                                    <h2 class="display-3 text-white">Sistem Informasi Pelacakan Alumni IAIN KENDARI</h1>
                                </div> -->
                                <!-- <p class="h6 text-white lh-1-5 mb-5">
                                    Dynamically target high-payoff intellectual capital for customized technologies. Objectively integrate emerging core competencies before
                                    process-centric communities...
                                </p>
                                <div class="mb-5">
                                    <a class="btn btn-lg btn-outline-white" href="index.html">Learn More</a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Left Side End -->

                <!-- Right Side Start -->
                <div class="col-12 col-lg-auto h-100 pb-4 px-4 pt-0 p-lg-0" style="background-color:white">
                    <div class="sw-lg-70 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 full-page-content-right-border">
                        <div class="sw-lg-50 px-5">
                            <div class="sh-11">
                                <a href="index.html">
                                    <!-- <div class="logo-default"></div> -->
                                    <img src="{{asset('/')}}logo-silanni-22.png" alt="logo" width="150">

                                </a>
                            </div>
                            <div class="mb-5">
                                <h2 class="cta-1 mb-0 text-primary">Selamat Datang,</h2>
                                <h2 class="cta-1 text-primary">di Sistem Informasi Pelacakan Alumni IAIN Kendari</h2>
                            </div>
                            <div class="mb-5">
                                <p class="h6">Masukkan Username dan Password untuk masuk.</p>
                                <!-- <p class="h6">
                                    Halaman ini khusus untuk alumni saja ya.
                                </p> -->
                            </div>
                            <div>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <label class="form-label">Username</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-cs-icon="navigate-diagonal"></i>
                                        <input type="email" class="form-control" placeholder="Masukkan Email" name="email" id="email" />
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <label class="form-label">Password</label>
                                    <div class=" mb-3 filled form-group tooltip-end-top">
                                        <i data-cs-icon="navigate-diagonal"></i>
                                        <input type="password" class="form-control" placeholder="Masukkan Password" name="password" id="password" />
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                </form>
                            </div>
                            <div class="mt-3">
                                <a class="btn btn-warning btn-sm" target="_blank" href="https://drive.google.com/file/d/1wEahIqSLGkL4t3CmoD1P4EPlqsZGVveV/view?usp=sharing">Download Panduan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Right Side End -->
            </div>
        </div>
    </div>


    <!-- Vendor Scripts Start -->
    <script src="{{asset('/')}}js/vendor/jquery-3.5.1.min.js"></script>
    <script src="{{asset('/')}}js/vendor/bootstrap.bundle.min.js"></script>
    <script src="{{asset('/')}}js/vendor/OverlayScrollbars.min.js"></script>
    <script src="{{asset('/')}}js/vendor/autoComplete.min.js"></script>
    <script src="{{asset('/')}}js/vendor/clamp.min.js"></script>
    <script src="{{asset('/')}}js/vendor/jquery.validate/jquery.validate.min.js"></script>
    <script src="{{asset('/')}}js/vendor/jquery.validate/additional-methods.min.js"></script>
    <!-- Vendor Scripts End -->

    <!-- Template Base Scripts Start -->
    <script src="{{asset('/')}}font/CS-Line/csicons.min.js"></script>
    <script src="{{asset('/')}}js/base/helpers.js"></script>
    <script src="{{asset('/')}}js/base/globals.js"></script>
    <script src="{{asset('/')}}js/base/nav.js"></script>
    <script src="{{asset('/')}}js/base/search.js"></script>
    <script src="{{asset('/')}}js/base/settings.js"></script>
    <script src="{{asset('/')}}js/base/init.js"></script>
    <!-- Template Base Scripts End -->
    <!-- Page Specific Scripts Start -->
    <script src="{{asset('/')}}js/pages/auth.login.js"></script>
    <script src="{{asset('/')}}js/common.js"></script>
    <script src="{{asset('/')}}js/scripts.js"></script>
    <!-- Page Specific Scripts End -->

</body>

</html>