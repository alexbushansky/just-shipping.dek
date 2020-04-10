<!doctype html>
<html lang="{{ str_replace('_', '-', devApp()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')-{{config('devApp.name')}}</title>

    <!-- Styles -->
    <link href="{{asset('adminpanel/vendors/@coreui/icons/css/free.min.css')}}">
    <link href="{{asset('adminpanel/vendors/@coreui/icons/css/brand.min.css')}}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('adminpanel/assets/favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('adminpanel/assets/favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('adminpanel/assets/favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('adminpanel/assets/favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('adminpanel/assets/favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('adminpanel/assets/favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('adminpanel/assets/favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('adminpanel/assets/favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('adminpanel/assets/favicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('adminpanel/assets/favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('adminpanel/assets/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('adminpanel/assets/favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('adminpanel/assets/favicon/favicon-16x16.png')}}">
    <link href="{{asset('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">



    <link href="{{asset('adminpanel/css/style.css')}}" rel="stylesheet">
{{--<link href="{{asset('adminpanel/vendors/@coreui/chartjs/css/coreui-chartjs.css')}}" rel="stylesheet">--}}


    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>




    @yield('styles')
</head>
<body class="c-devApp">
      <!--
      Sidebar
     !-->


   @include('admin.left-menu')

      <!--EndSidebar-->

      <!--Wrapper-->

      <div class="c-wrapper c-fixed-components">


          <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
              <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
                  <svg class="c-icon c-icon-lg">
                      <use xlink:href="{{asset('adminpanel/vendors/@coreui/icons/svg/free.svg#cil-menu')}}"></use>
                  </svg>
              </button>
              <a class="c-header-brand d-lg-none" href="#">
                  <svg width="118" height="46" alt="CoreUI Logo">
                      <use xlink:href="assets/brand/coreui.svg#full"></use>
                  </svg></a>
              <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
                  <svg class="c-icon c-icon-lg">
                      <use xlink:href="{{asset('adminpanel/vendors/@coreui/icons/svg/free.svg#cil-menu')}}"></use>
                  </svg>
              </button>

              <!--Top Menu-->

              <ul class="c-header-nav d-md-down-none">
                  <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Dashboard</a></li>
                  <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Users</a></li>
                  <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Settings</a></li>
              </ul>


              <!--EndTopMenu-->


              <ul class="c-header-nav ml-auto mr-4">

              </ul>

              <!--SubHeader-->
              <div class="c-subheader px-3">
                  <!-- Breadcrumb-->
                  <ol class="breadcrumb border-0 m-0">
                      <li class="breadcrumb-item">Home</li>
                      <li class="breadcrumb-item"><a href="#">Admin</a></li>
                      <li class="breadcrumb-item active">Dashboard</li>
                      <!-- Breadcrumb Menu-->
                  </ol>
              </div>



          </header>


          <!--Content-->
          <div class="c-body">
              <main class="c-main">
                  <div class="container-fluid">
                      @if (session('status'))

                          <div class="alert @if(session('alert'))alert-{{session('alert')}} @else alert-success @endif alert-dismissible fade show" role="alert">
                              {{ session('status') }}
                              <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                              </button>
                          </div>
                      @endif

                      @if ($errors->any())
                          <div class="alert alert-danger  alert-dismissible fade show" role="alert">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                              <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                              </button>
                          </div>
                      @endif
                      <div class="fade-in">
                          <div class="row">

                              @yield('content')

                          </div>
                      </div>
                  </div>
              </main>
          </div>
          <!--EndContent-->

      </div>


          <script src="{{asset('adminpanel/vendors/@coreui/coreui/js/coreui.bundle.min.js')}}"></script>
          <!--[if IE]><!-->
          <script src="{{asset('adminpanel/vendors/@coreui/icons/js/svgxuse.min.js')}}"></script>
          <!--<![endif]-->
          <!-- Plugins and scripts required by this view-->
          <script src="{{asset('adminpanel/vendors/@coreui/utils/js/coreui-utils.js')}}"></script>
          <!--<script src="{{asset('adminpanel/js/main.js')}}"></script>-->






</body>
</html>

