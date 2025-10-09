<!DOCTYPE html>
<html lang="en-US" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <!-- ===============================================-->
        <!--    Document Title-->
        <!-- ===============================================-->
        <title> Reset Password</title>


        <!-- ===============================================-->
        <!--    Favicons-->
        <!-- ===============================================-->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon.png') }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">
        <link rel="manifest" href="{{ asset('portal/assets/img/favicons/manifest.json') }}">
        <meta name="msapplication-TileImage" content="{{ asset('img/favicon.png') }}">
        <meta name="theme-color" content="#ffffff">
        <script src="{{ asset('vendors/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ asset('vendors/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/js/config.js') }}"></script>


        <!-- ===============================================-->
        <!--    Stylesheets-->
        <!-- ===============================================-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
        <link href="{{ asset('vendors/simplebar/simplebar.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
        <link href="{{ asset('assets/css/theme-rtl.min.css') }}" type="text/css" rel="stylesheet" id="style-rtl">
        <link href="{{ asset('assets/css/theme.min.css') }}" type="text/css" rel="stylesheet" id="style-default">
        <link href="{{ asset('assets/css/user-rtl.min.css') }}" type="text/css" rel="stylesheet" id="user-style-rtl">
        <link href="{{ asset('assets/css/user.min.css') }}" type="text/css" rel="stylesheet" id="user-style-default">
        <script>
        var phoenixIsRTL = window.config.config.phoenixIsRTL;
        if (phoenixIsRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
        </script>
    </head>


    <body>
     

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <div class="container-fluid bg-300 dark__bg-1200">
        <div class="bg-holder bg-auth-card-overlay" style="background-image:url({{ asset('assets/img/bg/37.png') }});">
        </div>
        <!--/.bg-holder-->

        <div class="row flex-center position-relative min-vh-100 g-0 py-5">
          <div class="col-11 col-sm-10 col-xl-8">
            <div class="card border border-200 auth-card">
              <div class="card-body pe-md-0">
                <div class="row align-items-center gx-0 gy-7">
                  <div class="col-auto bg-100 dark__bg-1100 rounded-3 position-relative overflow-hidden auth-title-box">
                    <div class="bg-holder" style="background-image:url({{ asset('assets/img/bg/38.png') }});">
                    </div>
                    <!--/.bg-holder-->

                     <div class="position-relative px-4 px-lg-7 pt-7 pb-7 pb-sm-5 text-center text-md-start pb-lg-7 pb-md-7">
                      <h3 class="mb-3 text-black fs-1">Food App Portal</h3>
                      <p class="text-700">Admin Portal To Manage All Company Relative Task At One Plateform</p>
                      <ul class="list-unstyled mb-0 w-max-content w-md-auto mx-auto">
                        <li class="d-flex align-items-center"><span class="uil uil-check-circle text-success me-2"></span><span class="text-700 fw-semi-bold">Categories</span></li>
                        <li class="d-flex align-items-center"><span class="uil uil-check-circle text-success me-2"></span><span class="text-700 fw-semi-bold">Products Management</span></li>
                        <li class="d-flex align-items-center"><span class="uil uil-check-circle text-success me-2"></span><span class="text-700 fw-semi-bold">Order Data</span></li>
                        <li class="d-flex align-items-center"><span class="uil uil-check-circle text-success me-2"></span><span class="text-700 fw-semi-bold">Users Records</span></li>
                      </ul>
                    </div>
                    <div class="position-relative z-index--1 mb-6 d-none d-md-block text-center">
					<img class="auth-title-box-img d-dark-none" src="{{ asset('img/solar-login.png') }}" alt="" />
					<img class="auth-title-box-img d-light-none" src="{{ asset('assets/img/bg/green-solar.png') }}" alt="" /></div>
                  </div>
                  <div class="col mx-auto">
                    <div class="auth-form-box">
                      <div class="text-center mb-7"><a class="d-flex flex-center text-decoration-none mb-4" href="">
                          <div class="d-flex align-items-center fw-bolder fs-5 d-inline-block"><img src="{{ asset('img/favicon.png') }}" alt="phoenix" width="58" />
                          </div>
                        </a>
                        <h3 class="text-1000">Password Reset</h3>
                        <p class="text-700">Reset new password</p>
                      </div>
                    		
                <form class="mt-5" method="POST" action="{{ route('password.store') }}">
				 @csrf
                  <input class="form-control mb-2" id="password" type="password" name="password" placeholder="Type new password" />
                  <input class="form-control mb-4" id="confirmPassword" type="password" name="password_confirmation" placeholder="Cofirm new password" />
				  <input type="hidden" name="email" value="{{old('email', $request->email)}}">
				  <input type="hidden" name="token" value="{{ $request->route('token') }}">
                  <button class="btn btn-primary w-100" type="submit">Set Password</button>
                </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script>
        var navbarTopStyle = window.config.config.phoenixNavbarTopStyle;
        var navbarTop = document.querySelector('.navbar-top');
        if (navbarTopStyle === 'darker') {
          navbarTop.classList.add('navbar-darker');
        }

        var navbarVerticalStyle = window.config.config.phoenixNavbarVerticalStyle;
        var navbarVertical = document.querySelector('.navbar-vertical');
        if (navbarVertical && navbarVerticalStyle === 'darker') {
          navbarVertical.classList.add('navbar-darker');
        }
      </script>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->


        <script src="{{ asset('vendors/popper/popper.min.js') }}"></script>
        <script src="{{ asset('vendors/bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ asset('vendors/anchorjs/anchor.min.js') }}"></script>
        <script src="{{ asset('vendors/is/is.min.js') }}"></script>
        <script src="{{ asset('vendors/fontawesome/all.min.js') }}"></script>
        <script src="{{ asset('vendors/lodash/lodash.min.js') }}"></script>
        <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
        <script src="{{ asset('vendors/list.js/list.min.js') }}"></script>
        <script src="{{ asset('vendors/feather-icons/feather.min.js') }}"></script>
        <script src="{{ asset('vendors/dayjs/dayjs.min.js') }}"></script>
        <script src="{{ asset('assets/js/phoenix.js') }}"></script>

    </body>

</html>    