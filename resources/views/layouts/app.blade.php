<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title')
    </title>

    <link href="{{ asset('/css/theme2.css') }}" rel="stylesheet">
    <!-- Scripts -->
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/admin2.min.css') }}" rel="stylesheet">

    
</head>
<body>
    @guest
        <div id="app">
            <main class="py-4">
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
                    <div class="sidebar-brand-text mx-3"><img src="/Images/logo.png" alt="" style="border-radius: 5px" width="60" height="60"> </div> 
                </a><br>
                @yield('content_login')
            </main>
        </div>
    @else 
        <div id="wrapper">
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
                <div class="sidebar-brand-text mx-3"><img src="/Images/logo.png" alt="" style="border-radius: 5px" width="60" height="60"> </div> 
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/') }}">
                <i class="fas fa-fw "><img src="/Images/dashbord.png" alt="" width="20" height="20"></i>
                <span><b>Tableau de bord</b></span>
                </a>
            </li>
        
            <li class="nav-item active">
                <a class="nav-link collapsed" href="{{ route('patients.index') }}" >
                <i class="fas fa-fw "><img src="/Images/patient.png" alt="" width="20" height="20"></i>
                <span><b>Patients</b></span>{{-- Contacts --}}
                </a>
                <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrders" aria-expanded="true" aria-controls="collapseOrders">
                    <i class="fas fa-fw "><img src="/Images/articles.png" alt="" width="20" height="20"></i>
                    <span><b>Articles</b></span>{{--  Orders--}}
                </a>
                <div id="collapseOrders" class="collapse" aria-labelledby="headingOrders" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
        
                    <a class="collapse-item" href="{{route('articles.index')}}">Articles</a>
                    <a class="collapse-item" href="{{route('categories.index')}}">Categories</a>
                    <a class="collapse-item" href="{{route('commandes.index')}}">Commandes</a>{{--  Orders--}}
                    <a class="collapse-item" href="{{route('fournisseurs.index')}}">Fournisseurs</a>{{--  Proposals--}}   
        
                    </div>
                </div>
                </li>
            </li>
            <li class="nav-item active">
                <a class="nav-link collapsed" href="{{ route('stocks.index') }}" >
                <i class="fas fa-fw "><img src="/Images/stock.png" alt="" width="20" height="20"></i>
                <span>Stocks</span>{{--  Inventory--}}
                </a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            </ul>
            <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                
                <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                    </button>
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="/search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" id="search_inpt" name="searchdata" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                        </div>
                    </div>
                    </form>
                    <li class="nav-item dropdown no-arrow d-sm-none"> 
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                        <i class="fas fa-search fa-fw"></i>
                    </a> 
                    </li>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto"></ul>
                    <ul class="navbar-nav ml-auto">
                        @guest
                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @else 
                        @include('layouts.nav-bar')
                        @endguest
                            
                    </ul>
                    </div>
                </div>
                </nav>
        
                <div class="container-fluid mt-3" id="app">
                    
                    @yield('content')
                    
                </div>
            </div>
        
                <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                    <span>&copy;2020 OPTICIENNE by <a href="https://haitham-oumerzoug.com/"> H.Oumerzoug</a> </span>
                    </div>
                </div>
                </footer>
            </div>
            </div>
        </div>
      
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
      <style>
        .notifications {
          width: 300px;
          height: 100%;
          opacity: 1;
          top: 63px;
          right: 62px;
    
          position: absolute;
          border-radius: 5px 0px 5px 5px;
          background-color: #fff;
          box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
      }
      .notifications-item {
          display: flex;
          border-bottom: 1px solid #eee;
          padding: 6px 9px;
          margin-bottom: 0px;
          cursor: pointer
      }
    
      .notifications-item:hover {
          background-color: #eee
      }
      .notifications-item .text h4 {
          color: #777;
          font-size: 16px;
          margin-top: 3px
      }
    
      .notifications-item .text p {
          color: #aaa;
          font-size: 14px
      }
    
    </style>
    @endguest
    
    
  <!-- Bootstrap core JavaScript-->
  <script src="{{ mix('/js/app.js') }}" defer></script>
  <script src="{{ '/vendor/jquery/jquery.min.js' }}"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  <!-- Core plugin JavaScript-->
  <script src="{{ '/vendor/jquery-easing/jquery.easing.min.js' }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ '/js/sb-admin-2.min.js' }}"></script>

  <!-- Page level plugins -->
  <script src="{{ '/vendor/chart.js/Chart.min.js' }}"></script>
  <!-- jsdelivr cdn -->
  <script src="https://cdn.jsdelivr.net/npm/vee-validate@<3.0.0/dist/vee-validate.js"></script>

  <!-- unpkg -->
  <script src="https://unpkg.com/vee-validate@<3.0.0"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
</body>
</html>
