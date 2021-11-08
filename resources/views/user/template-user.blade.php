<!DOCTYPE html>
<html lang="en" data-footer="true" data-override='{"attributes":{"layout": "boxed"}}'>

<head>
    @include('parts.head')
</head>

<body>
    <div id="root">
        <div id="nav" class="nav-container d-flex">
            <div class="nav-content d-flex">
                <!-- Logo Start -->
                <div class="logo position-relative">
                    <!-- <a href="Dashboards.Default.html"> -->
                    <!-- Logo can be added directly -->
                    <!-- <img src="img/logo/logo-white.svg" alt="logo" /> -->
                    <img src="{{asset('/')}}logo-silanni-22.png" alt="logo">

                    <!-- <img src="http://127.0.0.1:8000/logo-iain.png" alt="logo" style="width:40%">
                        <span style="font-size:14px;font-weight: 600;color:white">SI LANNI</span> -->
                    <!-- Or added via css to provide different ones for different color themes -->
                    <!-- <div class="img"></div> -->
                    <!-- </a> -->
                </div>
                <!-- Logo End -->


                <!-- User Menu Start -->
                <div class="user-container d-flex">
                    <a href="#" class="d-flex user position-relative" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <!-- <img class="profile" alt="profile" src="{{asset('/')}}img/profile/profile-11.jpg" /> -->
                        <img class="profile" alt="profile" src="{{asset('/')}}icon.jpeg" />

                        <!-- <div class="nama"></div> -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-end user-menu wide">

                        <div class="row mb-1 ms-0 me-0">

                            <div class="col-6 pe-1 ps-1">
                                <ul class="list-unstyled">
                                    <!-- <li>
                                        <a href="#">
                                            <i data-cs-icon="gear" class="me-2" data-cs-size="17"></i>
                                            <span class="align-middle">Settings</span>
                                        </a>
                                    </li> -->
                                    <li>
                                        <a href="#">
                                            <i data-cs-icon="logout" class="me-2" data-cs-size="17"></i>
                                            <span class="align-middle">Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- User Menu End -->

                <!-- Icons Menu Start -->
                <ul class="list-unstyled list-inline text-center menu-icons">
                    <li class="list-inline-item">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#searchPagesModal">
                            <i data-cs-icon="search" data-cs-size="18"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" id="pinButton" class="pin-button">
                            <i data-cs-icon="lock-on" class="unpin" data-cs-size="18"></i>
                            <i data-cs-icon="lock-off" class="pin" data-cs-size="18"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" id="colorButton">
                            <i data-cs-icon="light-on" class="light" data-cs-size="18"></i>
                            <i data-cs-icon="light-off" class="dark" data-cs-size="18"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" data-bs-toggle="dropdown" data-bs-target="#notifications" aria-haspopup="true" aria-expanded="false" class="notification-button">
                            <div class="position-relative d-inline-flex">
                                <i data-cs-icon="bell" data-cs-size="18"></i>
                                <span class="position-absolute notification-dot rounded-xl"></span>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end wide notification-dropdown scroll-out" id="notifications">
                            <div class="scroll">
                                <ul class="list-unstyled border-last-none">
                                    <li class="mb-3 pb-3 border-bottom border-separator-light d-flex">
                                        <img src="img/profile/profile-1.jpg" class="me-3 sw-4 sh-4 rounded-xl align-self-center" alt="..." />
                                        <div class="align-self-center">
                                            <a href="#">Joisse Kaycee just sent a new comment!</a>
                                        </div>
                                    </li>
                                    <li class="mb-3 pb-3 border-bottom border-separator-light d-flex">
                                        <img src="img/profile/profile-2.jpg" class="me-3 sw-4 sh-4 rounded-xl align-self-center" alt="..." />
                                        <div class="align-self-center">
                                            <a href="#">New order received! It is total $147,20.</a>
                                        </div>
                                    </li>
                                    <li class="mb-3 pb-3 border-bottom border-separator-light d-flex">
                                        <img src="img/profile/profile-3.jpg" class="me-3 sw-4 sh-4 rounded-xl align-self-center" alt="..." />
                                        <div class="align-self-center">
                                            <a href="#">3 items just added to wish list by a user!</a>
                                        </div>
                                    </li>
                                    <li class="pb-3 pb-3 border-bottom border-separator-light d-flex">
                                        <img src="img/profile/profile-6.jpg" class="me-3 sw-4 sh-4 rounded-xl align-self-center" alt="..." />
                                        <div class="align-self-center">
                                            <a href="#">Kirby Peters just sent a new message!</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
                <!-- Icons Menu End -->

                <!-- Menu Start -->
                <div class="menu-container flex-grow-1">
                    <ul id="menu" class="menu" style="margin-left:0;">
                        <li>
                            <a href="{{route('user.index')}}">
                                <i data-cs-icon="home" class="icon" data-cs-size="18"></i>
                                <span class="label">Dashboards</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://lpm.iainkendari.ac.id/tracer-study/">
                                <i data-cs-icon="chart-2" class="icon" data-cs-size="18"></i>
                                <span class="label">Hasil Tracer</span>
                            </a>
                        </li>


                    </ul>
                </div>
                <!-- Menu End -->

                <!-- Mobile Buttons Start -->
                <div class="mobile-buttons-container">
                    <!-- Scrollspy Mobile Button Start -->
                    <a href="#" id="scrollSpyButton" class="spy-button" data-bs-toggle="dropdown">
                        <i data-cs-icon="menu-dropdown"></i>
                    </a>
                    <!-- Scrollspy Mobile Button End -->

                    <!-- Scrollspy Mobile Dropdown Start -->
                    <div class="dropdown-menu dropdown-menu-end" id="scrollSpyDropdown"></div>
                    <!-- Scrollspy Mobile Dropdown End -->

                    <!-- Menu Button Start -->
                    <a href="#" id="mobileMenuButton" class="menu-button">
                        <i data-cs-icon="menu"></i>
                    </a>
                    <!-- Menu Button End -->
                </div>
                <!-- Mobile Buttons End -->
            </div>
            <div class="nav-shadow"></div>
        </div>

        <main>
            <div class="container">
                <!-- Title and Top Buttons Start -->
                <div class="page-title-container">
                    <div class="row">
                        <!-- Title Start -->
                        <div class="col-12 col-md-7">
                            <h1 class="mb-0 pb-0 display-4" id="title">{{$title}}</h1>
                            <!-- <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                                <ul class="breadcrumb pt-0">
                                    <li class="breadcrumb-item"><a href="Dashboards.Default.html">Home</a></li>
                                    <li class="breadcrumb-item"><a href="Pages.html">Pages</a></li>
                                    <li class="breadcrumb-item"><a href="Pages.Portfolio.html">Portfolio</a></li>
                                </ul>
                            </nav> -->
                        </div>
                        <!-- Title End -->


                    </div>
                </div>
                <!-- Title and Top Buttons End -->

                <div class="row gx-4 gy-5">
                    <!-- Left Side Start -->
                    <div class="col-12 col-xl-4 col-xxl-3">
                        <!-- Biography Start -->
                        <!-- <h2 class="small-title">Data Alumni</h2> -->
                        <div class="card">
                            <div class="card-body mb-n5">
                                <div class="d-flex align-items-center flex-column">
                                    <div class="mb-5 d-flex align-items-center flex-column">
                                        <div class="sw-13 position-relative mb-3">
                                            <!-- <img src="{{asset('/')}}img/profile/profile-11.jpg" class="img-fluid rounded-xl" alt="thumb" /> -->
                                            <img class="img-fluid rounded-xl" alt="profile" src="{{asset('/')}}icon.jpeg" />

                                        </div>
                                        <div class="h5 mb-0"><span id="nama"></span>
                                        </div>
                                        <div class="text-muted"><span id="nim"></span></div>
                                        <div class="text-muted">
                                            <!-- <i data-cs-icon="pin" class="me-1"></i> -->
                                            <span class="align-middle"><span id="prodi"></span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{route('user.logout')}}" class="col-12 mt-4 btn btn-light">Keluar</a>
                        <!-- Biography End -->
                    </div>
                    <!-- Left Side End -->

                    <!-- Right Side Start -->
                    <div class="col-12 col-xl-8 col-xxl-9">
                        <div class="tab-content">
                            <!-- Projects Tab Start -->
                            @yield('content')
                            <!-- Projects Tab End -->

                        </div>
                    </div>
                    <!-- Right Side End -->
                </div>
            </div>
        </main>

        <!-- Layout Footer Start -->
        <footer>
            <div class="footer-content">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <p class="mb-0 text-muted text-medium">Colored Strategies 2021</p>
                        </div>
                        <div class="col-sm-6 d-none d-sm-block">
                            <ul class="breadcrumb pt-0 pe-0 mb-0 float-end">
                                <li class="breadcrumb-item mb-0 text-medium">
                                    <a href="https://1.envato.market/BX5oGy" target="_blank" class="btn-link">Review</a>
                                </li>
                                <li class="breadcrumb-item mb-0 text-medium">
                                    <a href="https://1.envato.market/BX5oGy" target="_blank" class="btn-link">Purchase</a>
                                </li>
                                <li class="breadcrumb-item mb-0 text-medium">
                                    <a href="https://acorn-html-docs.coloredstrategies.com/" target="_blank" class="btn-link">Docs</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Layout Footer End -->
    </div>

    <!-- Theme Settings Modal Start -->
    <div class="modal fade modal-right scroll-out-negative" id="settings" data-bs-backdrop="true" tabindex="-1" role="dialog" aria-labelledby="settings" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable full" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Theme Settings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="scroll-track-visible">
                        <div class="mb-5" id="color">
                            <label class="mb-3 d-inline-block form-label">Color</label>
                            <div class="row d-flex g-3 justify-content-between flex-wrap mb-3">
                                <a href="#" class="flex-grow-1 w-50 option col" data-value="light-blue" data-parent="color">
                                    <div class="card rounded-md p-3 mb-1 no-shadow color">
                                        <div class="blue-light"></div>
                                    </div>
                                    <div class="text-muted text-part">
                                        <span class="text-extra-small align-middle">LIGHT BLUE</span>
                                    </div>
                                </a>
                                <a href="#" class="flex-grow-1 w-50 option col" data-value="dark-blue" data-parent="color">
                                    <div class="card rounded-md p-3 mb-1 no-shadow color">
                                        <div class="blue-dark"></div>
                                    </div>
                                    <div class="text-muted text-part">
                                        <span class="text-extra-small align-middle">DARK BLUE</span>
                                    </div>
                                </a>
                            </div>

                            <div class="row d-flex g-3 justify-content-between flex-wrap mb-3">
                                <a href="#" class="flex-grow-1 w-50 option col" data-value="light-red" data-parent="color">
                                    <div class="card rounded-md p-3 mb-1 no-shadow color">
                                        <div class="red-light"></div>
                                    </div>
                                    <div class="text-muted text-part">
                                        <span class="text-extra-small align-middle">LIGHT RED</span>
                                    </div>
                                </a>
                                <a href="#" class="flex-grow-1 w-50 option col" data-value="dark-red" data-parent="color">
                                    <div class="card rounded-md p-3 mb-1 no-shadow color">
                                        <div class="red-dark"></div>
                                    </div>
                                    <div class="text-muted text-part">
                                        <span class="text-extra-small align-middle">DARK RED</span>
                                    </div>
                                </a>
                            </div>

                            <div class="row d-flex g-3 justify-content-between flex-wrap mb-3">
                                <a href="#" class="flex-grow-1 w-50 option col" data-value="light-green" data-parent="color">
                                    <div class="card rounded-md p-3 mb-1 no-shadow color">
                                        <div class="green-light"></div>
                                    </div>
                                    <div class="text-muted text-part">
                                        <span class="text-extra-small align-middle">LIGHT GREEN</span>
                                    </div>
                                </a>
                                <a href="#" class="flex-grow-1 w-50 option col" data-value="dark-green" data-parent="color">
                                    <div class="card rounded-md p-3 mb-1 no-shadow color">
                                        <div class="green-dark"></div>
                                    </div>
                                    <div class="text-muted text-part">
                                        <span class="text-extra-small align-middle">DARK GREEN</span>
                                    </div>
                                </a>
                            </div>

                            <div class="row d-flex g-3 justify-content-between flex-wrap mb-3">
                                <a href="#" class="flex-grow-1 w-50 option col" data-value="light-purple" data-parent="color">
                                    <div class="card rounded-md p-3 mb-1 no-shadow color">
                                        <div class="purple-light"></div>
                                    </div>
                                    <div class="text-muted text-part">
                                        <span class="text-extra-small align-middle">LIGHT PURPLE</span>
                                    </div>
                                </a>
                                <a href="#" class="flex-grow-1 w-50 option col" data-value="dark-purple" data-parent="color">
                                    <div class="card rounded-md p-3 mb-1 no-shadow color">
                                        <div class="purple-dark"></div>
                                    </div>
                                    <div class="text-muted text-part">
                                        <span class="text-extra-small align-middle">DARK PURPLE</span>
                                    </div>
                                </a>
                            </div>

                            <div class="row d-flex g-3 justify-content-between flex-wrap mb-3">
                                <a href="#" class="flex-grow-1 w-50 option col" data-value="light-pink" data-parent="color">
                                    <div class="card rounded-md p-3 mb-1 no-shadow color">
                                        <div class="pink-light"></div>
                                    </div>
                                    <div class="text-muted text-part">
                                        <span class="text-extra-small align-middle">LIGHT PINK</span>
                                    </div>
                                </a>
                                <a href="#" class="flex-grow-1 w-50 option col" data-value="dark-pink" data-parent="color">
                                    <div class="card rounded-md p-3 mb-1 no-shadow color">
                                        <div class="pink-dark"></div>
                                    </div>
                                    <div class="text-muted text-part">
                                        <span class="text-extra-small align-middle">DARK PINK</span>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="mb-5" id="navcolor">
                            <label class="mb-3 d-inline-block form-label">Override Nav Palette</label>
                            <div class="row d-flex g-3 justify-content-between flex-wrap">
                                <a href="#" class="flex-grow-1 w-33 option col" data-value="default" data-parent="navcolor">
                                    <div class="card rounded-md p-3 mb-1 no-shadow">
                                        <div class="figure figure-primary top"></div>
                                        <div class="figure figure-secondary bottom"></div>
                                    </div>
                                    <div class="text-muted text-part">
                                        <span class="text-extra-small align-middle">DEFAULT</span>
                                    </div>
                                </a>
                                <a href="#" class="flex-grow-1 w-33 option col" data-value="light" data-parent="navcolor">
                                    <div class="card rounded-md p-3 mb-1 no-shadow">
                                        <div class="figure figure-secondary figure-light top"></div>
                                        <div class="figure figure-secondary bottom"></div>
                                    </div>
                                    <div class="text-muted text-part">
                                        <span class="text-extra-small align-middle">LIGHT</span>
                                    </div>
                                </a>
                                <a href="#" class="flex-grow-1 w-33 option col" data-value="dark" data-parent="navcolor">
                                    <div class="card rounded-md p-3 mb-1 no-shadow">
                                        <div class="figure figure-muted figure-dark top"></div>
                                        <div class="figure figure-secondary bottom"></div>
                                    </div>
                                    <div class="text-muted text-part">
                                        <span class="text-extra-small align-middle">DARK</span>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="mb-5" id="placement">
                            <label class="mb-3 d-inline-block form-label">Menu Placement</label>
                            <div class="row d-flex g-3 justify-content-between flex-wrap">
                                <a href="#" class="flex-grow-1 w-50 option col" data-value="horizontal" data-parent="placement">
                                    <div class="card rounded-md p-3 mb-1 no-shadow">
                                        <div class="figure figure-primary top"></div>
                                        <div class="figure figure-secondary bottom"></div>
                                    </div>
                                    <div class="text-muted text-part">
                                        <span class="text-extra-small align-middle">HORIZONTAL</span>
                                    </div>
                                </a>
                                <a href="#" class="flex-grow-1 w-50 option col" data-value="vertical" data-parent="placement">
                                    <div class="card rounded-md p-3 mb-1 no-shadow">
                                        <div class="figure figure-primary left"></div>
                                        <div class="figure figure-secondary right"></div>
                                    </div>
                                    <div class="text-muted text-part">
                                        <span class="text-extra-small align-middle">VERTICAL</span>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="mb-5" id="behaviour">
                            <label class="mb-3 d-inline-block form-label">Menu Behaviour</label>
                            <div class="row d-flex g-3 justify-content-between flex-wrap">
                                <a href="#" class="flex-grow-1 w-50 option col" data-value="pinned" data-parent="behaviour">
                                    <div class="card rounded-md p-3 mb-1 no-shadow">
                                        <div class="figure figure-primary left large"></div>
                                        <div class="figure figure-secondary right small"></div>
                                    </div>
                                    <div class="text-muted text-part">
                                        <span class="text-extra-small align-middle">PINNED</span>
                                    </div>
                                </a>
                                <a href="#" class="flex-grow-1 w-50 option col" data-value="unpinned" data-parent="behaviour">
                                    <div class="card rounded-md p-3 mb-1 no-shadow">
                                        <div class="figure figure-primary left"></div>
                                        <div class="figure figure-secondary right"></div>
                                    </div>
                                    <div class="text-muted text-part">
                                        <span class="text-extra-small align-middle">UNPINNED</span>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="mb-5" id="layout">
                            <label class="mb-3 d-inline-block form-label">Layout</label>
                            <div class="row d-flex g-3 justify-content-between flex-wrap">
                                <a href="#" class="flex-grow-1 w-50 option col" data-value="fluid" data-parent="layout">
                                    <div class="card rounded-md p-3 mb-1 no-shadow">
                                        <div class="figure figure-primary top"></div>
                                        <div class="figure figure-secondary bottom"></div>
                                    </div>
                                    <div class="text-muted text-part">
                                        <span class="text-extra-small align-middle">FLUID</span>
                                    </div>
                                </a>
                                <a href="#" class="flex-grow-1 w-50 option col" data-value="boxed" data-parent="layout">
                                    <div class="card rounded-md p-3 mb-1 no-shadow">
                                        <div class="figure figure-primary top"></div>
                                        <div class="figure figure-secondary bottom small"></div>
                                    </div>
                                    <div class="text-muted text-part">
                                        <span class="text-extra-small align-middle">BOXED</span>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="mb-5" id="radius">
                            <label class="mb-3 d-inline-block form-label">Radius</label>
                            <div class="row d-flex g-3 justify-content-between flex-wrap">
                                <a href="#" class="flex-grow-1 w-33 option col" data-value="rounded" data-parent="radius">
                                    <div class="card rounded-md radius-rounded p-3 mb-1 no-shadow">
                                        <div class="figure figure-primary top"></div>
                                        <div class="figure figure-secondary bottom"></div>
                                    </div>
                                    <div class="text-muted text-part">
                                        <span class="text-extra-small align-middle">ROUNDED</span>
                                    </div>
                                </a>
                                <a href="#" class="flex-grow-1 w-33 option col" data-value="standard" data-parent="radius">
                                    <div class="card rounded-md radius-regular p-3 mb-1 no-shadow">
                                        <div class="figure figure-primary top"></div>
                                        <div class="figure figure-secondary bottom"></div>
                                    </div>
                                    <div class="text-muted text-part">
                                        <span class="text-extra-small align-middle">STANDARD</span>
                                    </div>
                                </a>
                                <a href="#" class="flex-grow-1 w-33 option col" data-value="flat" data-parent="radius">
                                    <div class="card rounded-md radius-flat p-3 mb-1 no-shadow">
                                        <div class="figure figure-primary top"></div>
                                        <div class="figure figure-secondary bottom"></div>
                                    </div>
                                    <div class="text-muted text-part">
                                        <span class="text-extra-small align-middle">FLAT</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Theme Settings Modal End -->


    <!-- Theme Settings & Niches Buttons Start -->
    <div class="settings-buttons-container">
        <button type="button" class="btn settings-button btn-primary p-0" data-bs-toggle="modal" data-bs-target="#settings" id="settingsButton">
            <span class="d-inline-block no-delay" data-bs-delay="0" data-bs-offset="0,3" data-bs-toggle="tooltip" data-bs-placement="left" title="Settings">
                <i data-cs-icon="paint-roller" class="position-relative"></i>
            </span>
        </button>
    </div>
    <!-- Theme Settings & Niches Buttons End -->

    <!-- Search Modal Start -->
    <div class="modal fade modal-under-nav modal-search modal-close-out" id="searchPagesModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0 p-0">
                    <button type="button" class="btn-close btn btn-icon btn-icon-only btn-foreground" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ps-5 pe-5 pb-0 border-0">
                    <input id="searchPagesInput" class="form-control form-control-xl borderless ps-0 pe-0 mb-1 auto-complete" type="text" autocomplete="off" />
                </div>
                <div class="modal-footer border-top justify-content-start ps-5 pe-5 pb-3 pt-3 border-0">
                    <span class="text-alternate d-inline-block m-0 me-3">
                        <i data-cs-icon="arrow-bottom" data-cs-size="15" class="text-alternate align-middle me-1"></i>
                        <span class="align-middle text-medium">Navigate</span>
                    </span>
                    <span class="text-alternate d-inline-block m-0 me-3">
                        <i data-cs-icon="arrow-bottom-left" data-cs-size="15" class="text-alternate align-middle me-1"></i>
                        <span class="align-middle text-medium">Select</span>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Modal End -->

    <!-- Vendor Scripts Start -->
    <script src="{{asset('/')}}js/vendor/jquery-3.5.1.min.js"></script>
    <script src="{{asset('/')}}js/vendor/bootstrap.bundle.min.js"></script>
    <script src="{{asset('/')}}js/vendor/OverlayScrollbars.min.js"></script>
    <script src="{{asset('/')}}js/vendor/autoComplete.min.js"></script>
    <script src="{{asset('/')}}js/vendor/clamp.min.js"></script>
    <script src="{{asset('/')}}js/vendor/baguetteBox.min.js"></script>
    <script src="{{asset('/')}}js/cs/responsivetab.js"></script>
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
    <script src="{{asset('/')}}js/pages/portfolio.home.js"></script>
    <script src="{{asset('/')}}js/common.js"></script>
    <script src="{{asset('/')}}js/scripts.js"></script>
    <!-- Page Specific Scripts End -->

    <script>
        init();
        async function init() {
            let idData = '{{$iddata}}'
            const url = `https://sia.iainkendari.ac.id/alumni/tracer/data/${idData}`
            response = await fetch(url)
            responseMessage = await response.json()
            if (responseMessage.status == "sukses") {
                let nim = document.querySelector("#nim")
                let nama = document.querySelector("#nama")
                let prodi = document.querySelector("#prodi")
                nama.innerText = responseMessage.data[0].nama
                nim.innerText = responseMessage.data[0].nim
                prodi.innerText = responseMessage.data[0].prodi
            }
        }
    </script>
    @yield('js')
</body>

</html>