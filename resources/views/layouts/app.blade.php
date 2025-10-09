<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
   <title>{{isset($title)?'Lácteos y más- '.$title:'Lácteos y más'}}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('img/favicon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('img/favicon.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('img/favicon.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/favicon.png')}}">
    <link rel="manifest" href="{{asset('assets/img/favicons/manifest.json')}}">
    <meta name="msapplication-TileImage" content="{{asset('img/favicon.png')}}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{asset('vendors/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('vendors/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/js/config.js')}}"></script>
	<link rel="stylesheet" type="text/css" href="{{asset('izitoast/css/iziToast.min.css') }}">
    <script>
      window.config.set({
        phoenixNavbarTopShape: 'slim'
      });
    </script>


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="{{asset('vendors/simplebar/simplebar.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="{{asset('assets/css/theme-rtl.min.css')}}" type="text/css" rel="stylesheet" id="style-rtl">
    <link href="{{asset('assets/css/theme.min.css')}}" type="text/css" rel="stylesheet" id="style-default">
    <link href="{{asset('assets/css/user-rtl.min.css')}}" type="text/css" rel="stylesheet" id="user-style-rtl">
    <link href="{{asset('assets/css/user.min.css')}}" type="text/css" rel="stylesheet" id="user-style-default">
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
    <link href="{{asset('vendors/leaflet/leaflet.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/leaflet.markercluster/MarkerCluster.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/leaflet.markercluster/MarkerCluster.Default.css')}}" rel="stylesheet">
 
  @stack('styles')
  
  <!-- Estilos personalizados para Lácteos y más -->
  <style>
  /* Mejoras visuales para el sidebar */
  .nav-link-text {
    font-weight: 500;
    transition: all 0.2s ease-in-out;
  }
  
  .navbar-vertical .nav-link:hover .nav-link-text {
    color: #0d6efd !important;
    transform: translateX(3px);
  }
  
  /* Mejorar apariencia de badges */
  .badge {
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.5px;
  }
  
  /* Animación suave para dropdowns */
  .dropdown-menu {
    animation: fadeInDown 0.3s ease-out;
  }
  
  @keyframes fadeInDown {
    from {
      opacity: 0;
      transform: translateY(-10px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  /* Mejorar notificaciones */
  .notification-card.unread {
    border-left: 4px solid #0d6efd;
    background: rgba(13, 110, 253, 0.05);
  }
  
  /* Footer mejorado */
  .footer {
    border-top: 1px solid rgba(13, 110, 253, 0.1);
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
  }
  
  /* Logo hover effect */
  .navbar-brand:hover img {
    transform: scale(1.05);
    transition: transform 0.3s ease;
  }
  
  /* Theme toggle mejorado */
  .theme-control-toggle {
    border-radius: 20px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
  }
  
  /* Scrollbar personalizado para notificaciones */
  .scrollbar-overlay::-webkit-scrollbar {
    width: 6px;
  }
  
  .scrollbar-overlay::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
  }
  
  .scrollbar-overlay::-webkit-scrollbar-thumb {
    background: #0d6efd;
    border-radius: 10px;
  }
  
  .scrollbar-overlay::-webkit-scrollbar-thumb:hover {
    background: #0b5ed7;
  }
  
  /* Mejorar cards en general */
  .card {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
  }
  
  .card:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    transform: translateY(-1px);
  }
  </style>
</head>

<body class="nav-slim">

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
	
    @include('layouts.sidebar')
     
    @include('layouts.navigation')
 
    <div class="content" @if(request()->is('proposalsnew')) kanban-deals-content @endif @if(request()->is('myboards')) kanban-boards-content @endif @if(request()->is('mytasks')) kanban-content @endif>
        @yield('section')
    <footer class="footer position-absolute">
          <div class="row g-0 justify-content-between align-items-center h-100">
            <div class="col-12 col-sm-auto text-center">
              <p class="mb-0 mt-2 mt-sm-0 text-900">Todos los derechos reservados<span class="d-none d-sm-inline-block"></span><span class="d-none d-sm-inline-block mx-1">|</span>
              <br class="d-sm-none" />2025 &copy;<a class="mx-1" href="#" class="text-decoration-none fw-semibold">🥛 Lácteos y más</a></p>
            </div>
           
          </div>
        </footer>
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
 
 
    <script src="{{asset('vendors/popper/popper.min.js')}}"></script>
    <script src="{{asset('vendors/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{asset('vendors/anchorjs/anchor.min.js')}}"></script>
    <script src="{{asset('vendors/is/is.min.js')}}"></script>
    <script src="{{asset('vendors/fontawesome/all.min.js')}}"></script>
    <script src="{{asset('vendors/lodash/lodash.min.js')}}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{asset('vendors/list.js/list.min.js')}}"></script>
    <script src="{{asset('vendors/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('vendors/dayjs/dayjs.min.js')}}"></script>
    <script src="{{asset('assets/js/phoenix.js')}}"></script>
    <script src="{{asset('vendors/leaflet/leaflet.js')}}"></script>
    <script src="{{asset('vendors/leaflet.markercluster/leaflet.markercluster.js')}}"></script>
    <script src="{{asset('vendors/leaflet.tilelayer.colorfilter/leaflet-tilelayer-colorfilter.min.js')}}"></script>
    <script src="{{asset('assets/js/ecommerce-dashboard.js')}}"></script>
	<script src="{{asset('vendors/echarts/echarts.min.js')}}"></script>
	<script src="{{asset('assets/js/echarts-example.js')}}"></script>
	<script src="{{asset('izitoast/js/iziToast.min.js')}}" type="text/javascript"></script>
	@if (session('success'))

    <script>
        iziToast.success({
            title: 'Success!',
            message: '{{ session("success") }}',
            position: 'topCenter'
        });
    </script>

    @endif
    @if (session('destroy'))

    <script>
        iziToast.warning({
            title: 'Error!',
            message: '{{ session("destroy") }}',
            position: 'topCenter'
        });
    </script>

    @endif
    @if(count($errors) > 0)
    @foreach($errors->all() as $error)
    <script>
        iziToast.error({
            title: 'Error!',
            message: '{{ $error }}',
            position: 'topRight'
        });
    </script>
    @endforeach
    @endif
  @stack('scripts')
  </body>

</html>