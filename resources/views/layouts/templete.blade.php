@inject('viewRoles','App\Roles')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="icon" href="{{ asset('images/inei.png') }}">
<title>Comprobantes - @yield('title','')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta conMPVirtualtent="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.cs') }}s">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/jvectormap/jquery-jvectormap.css') }}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css') }}">


  <link rel="stylesheet" type="text/css" href="{{ asset('css/toastr.min.css') }}">

<!-- jQuery 3 -->
<script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap  -->
<script src="{{ asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('adminlte/bower_components/chart.js/Chart.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('adminlte/dist/js/pages/dashboard2.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>


<script src="{{ asset('js/toastr.min.js') }}"></script>


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style type="text/css">
  input[type="text"],input[type="email"],input[type="number"],input[type="date"] {
    border-radius: 5px;
}

</style>

<script>
  toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
</script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">



    <!-- Logo -->
    <a href="{{ route('home') }}" class="logo" id="logito">

      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><i class="fa fa-bar-chart"></i></span>

      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        <i class="fa fa-bar-chart"></i> INEI
      </span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              @if(Auth::user()->foto=='usuario.png')
              <img src="{{ asset('images/usuario.png') }}" width="30">
              @else
              <?php  $fp=Auth::user()->foto; ?>
              <img src='{{ asset("images/users/$fp") }}' class="user-image" alt="Usuario">
              @endif
              <span class="hidden-xs">
                {{ Auth::user()->Nombres }} <i class="fa fa-chevron-down"></i>
              </span>
            </a>

          <?php $txtRoles=''; ?>
          @foreach($viewRoles::where('id',Auth::user()->Rol)->get() as $rol)
          <?php $txtRoles=$rol->Descripcion; ?>
          @endforeach

            <ul class="dropdown-menu" style="border-width: 1px;border-style: solid;border-color: gray;">
              <!-- User image -->
              <li class="user-header">

              @if(Auth::user()->foto=='usuario.png')
              <img src="{{ asset('images/usuario.png') }}" width="30">
              @else
              <?php  $fp=Auth::user()->foto; ?>
              <img src='{{ asset("images/users/$fp") }}' class="img-circle" alt="Usuario">
              @endif

                <p>
                  <span style="font-size: 12pt;">{{ Auth::user()->Nombres }}</span>
                  <small> <i>{{ $txtRoles }}</i> </small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ route('cambiar.clave') }}" class="btn btn-default btn-flat"> <i class="fa fa-cogs"></i> Cambiar Clave</a> 
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> <i class="fa fa-remove"></i>  Cerrar Sesion</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        

        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
  

              @if(Auth::user()->foto=='usuario.png')
              <img src="{{ asset('images/usuario.png') }}" width="30">
              @else
              <?php  $fp=Auth::user()->foto; ?>
              <img src='{{ asset("images/users/$fp") }}' class="img-circle" alt="Usuario">
              @endif

        </div>
      <?php $txtRol=''; ?>
      @foreach($viewRoles::where('id',Auth::user()->Rol)->get() as $rol)
      <?php $txtRol=$rol->Descripcion; ?>
      @endforeach

        <div class="pull-left info">
          <p>{{ $txtRol }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Buscar...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php $ruta=Route::currentRouteName(); ?>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Opciones</li>
        
        <li @if($ruta=='home') class="active" @endif>
          <a href="{{ route('home') }}"><i class="fa fa-home"></i> <span>Inicio</span></a>
        </li>
        
        @if(Auth::user()->Rol==1)
        <li @if($ruta=='usuarios.index' || $ruta=='usuarios.edit') class="active" @endif>
          <a href="{{ route('usuarios.index') }}" >
            <i class="fa fa-user"></i> <span>Usuarios</span>
          </a>
        </li>

        <li @if($ruta=='proyectos.index') class="active" @endif>
          <a href="{{ route('proyectos.index') }}">
            <i class="fa fa-folder"></i> <span>Proyectos</span>
          </a>
        </li>
        @endif 
        <li @if($ruta=='comprobantes.index') class="active" @endif>
          <a href="{{ route('comprobantes.index') }}">
            <i class="fa fa-file"></i> <span>Comprobantes</span>
          </a>
        </li>

        <li @if($ruta=='c_internos.index') class="active" @endif>
          <a href="{{ route('c_internos.index') }}">
            <i class="fa fa-file"></i> <span>Comprobantes Internos</span>
          </a>
        </li>

    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color: #FFFFFF;">
    <!-- Content Header (Page header) -->



    <section class="content-header">
    
    @yield('cabecera')

    </section>

    <!-- Main content -->
    <section class="content" >
  
    @yield('contenido')

      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    Copyright &copy; {{ date('Y') }} -
      <a href="#"> 
        <span style="font-size: 11pt;color: #007EFF
"><strong> Repositorio Virtual </strong></span> .
    </a>   Todos los derechos reservados.
  </footer>



  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">

        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->


      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->


</body>
</html>
