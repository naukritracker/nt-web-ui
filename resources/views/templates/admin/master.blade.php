<!DOCTYPE html>
<html>
  <head>
    <title>@section('title') Naukri Tracker - Administrator@show</title>
    @section('meta')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{{ Session::token() }}}">
    @show

    @section('css')
    {!! Html::style('assets/css/bootstrap.min.css') !!}
    {!! Html::style('assets/css/font-awesome.min.css') !!}
    {!! Html::style('assets/css/animate.css') !!}
    {!! Html::style('assets/css/pnotify.custom.min.css') !!}
    {!! Html::style('assets/css/AdminLTE.min.css') !!}
    {!! Html::style('assets/css/_all-skins.min.css') !!}
    {!! Html::style('assets/css/main.css') !!}
    {!! Html::style('assets/css/adminmain.css') !!}
    @show

    @section('html5shiv')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @show
  </head>
  <body class="skin-blue fixed" data-spy="scroll" data-target="#scrollspy">
    <div class="wrapper">

      @section('header')
      <header class="main-header">
        <!-- Logo -->
        <!-- Logo -->
        <a href="../index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">LOGOMINI</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">Naukri Tracker</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li></li>
              <li><a href="{{URL::route('Logout')}}">Logout</a></li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <div class="sidebar" id="scrollspy">

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="nav sidebar-menu">
            <li class="header">TABLE OF CONTENTS</li>
            <li @if(Request::is('admin')) class="active" @endif><a class="menulink" href="{{URL::route('Dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            @if(Auth::user()->hasRole(['admin','su']))
              <li @if(Request::is('admin/user*')) class="active" @endif><a class="menulink" href="{{URL::route('Users')}}"><i class="fa fa-user"></i> Users</a></li>
            @endif

            @if(Auth::user()->hasRole(['admin','su','moderator']))
              <li @if(Request::is('admin/jobposting*')) class="active" @endif><a class="menulink" href="{{URL::route('JobPosting')}}"><i class="fa fa-industry"></i> Jobs</a></li>              
            @endif

            @if(Auth::user()->hasRole(['admin','su']))
              <li @if(Request::is('admin/visa*')) class="active" @endif><a class="menulink" href="{{URL::route('Visa')}}"><i class="fa fa-flag"></i> Visa</a></li>
              <li @if(Request::is('admin/banner*')) class="active" @endif><a class="menulink" href="{{URL::route('Banners')}}"><i class="fa fa-image"></i> Banners</a></li>
              <li @if(Request::is('admin/testimonial*')) class="active" @endif><a class="menulink" href="{{URL::route('Testimonials')}}"><i class="fa fa-quote-left"></i> Testimonials</a></li>
              <li @if(Request::is('admin/static*')) class="active" @endif><a class="menulink" href="{{URL::route('StaticPages')}}"><i class="fa fa-file-o"></i> Static Pages</a></li>
            @endif
          </ul>
        </div>
        <!-- /.sidebar -->
      </aside>
      @show

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <h1>
            @section('content-header')
            Naukri Tracker Dashboard
            @show
          </h1>
          <ol class="breadcrumb">
            @section('breadcrumb')
            <li><a href="{{URL::route('Dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            @show
          </ol>
        </div>

        <!-- Main content -->
        <div class="content body">
        @yield('content')
        </div><!-- /.content -->
      </div><!-- /.content-wrapper -->
      @section('footer')
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 0.0.1
        </div>
        <strong>Copyright &copy; 2015-2016 <a href="javascript:void(0)">Naukri Tracker</a>.</strong> All rights reserved.
      </footer>
      @show

    </div><!-- ./wrapper -->

    @section('js')
    {!! Html::script('assets/js/jquery-1.11.1.min.js') !!}
    {!! Html::script('assets/js/bootstrap.min.js') !!}
    {!! Html::script('assets/js/pnotify.custom.min.js') !!}
    {!! Html::script('assets/js/fastclick.min.js') !!}
    {!! Html::script('assets/js/adminapp.min.js') !!}
    {!! Html::script('assets/js/jquery.slimscroll.min.js') !!}
    <script type="text/javascript">
        token = $('meta[name="csrf-token"]').attr('content'); 
        animationend = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        pageloading = '<div class="clearfix"><div class="clearfix pad-t40pr pad-l50pr"><i class="fa fa-circle-o-notch fa-spin green"></i><i class="fa fa-circle-o-notch fa-spin red"></i><i class="fa fa-circle-o-notch fa-spin blue"></i></div></div>';
        pageloadingleft = '<div class="clearfix"><div class="clearfix pad-l50pr"><i class="fa fa-circle-o-notch fa-spin green"></i><i class="fa fa-circle-o-notch fa-spin red"></i><i class="fa fa-circle-o-notch fa-spin blue"></i></div></div>';
        reloadbutton = '<div class="clearfix"><div class="clearfix pad-t40pr pad-l50pr"><button class="btn btn-lg btn-danger" onclick="window.location=window.location;">Reload Page</button></div></div>';

    </script>
    @show

        @if (count($errors) > 0)
            @foreach($errors->all() as $error)
                <script type="text/javascript">
                   var defaulterrornot = new PNotify({
                        title: 'Error',
                        text: '{{$error}}',
                        type : 'error',
                    });

                    defaulterrornot.get().click(function() {
                        defaulterrornot.remove();
                    });
                </script>
            @endforeach
        @endif

        <!--Handle Success-->
        @if(isset($success))
            @if (count($success) > 0)
                @foreach($success as $success)
                    <script type="text/javascript">
                       new PNotify({
                            icon: 'fa fa-thumbs-o-up',
                            text: '{{$success}}',
                            type : 'success',
                        });
                    </script>
                @endforeach
            @endif
        @endif
        @if(null !== session('success'))
            @if (count(session('success')) > 0)
                @foreach(session('success') as $success)
                    <script type="text/javascript">
                       new PNotify({
                            icon: 'fa fa-thumbs-o-up',
                            text: '{{$success}}',
                            type : 'success',
                        });
                    </script>
                @endforeach
            @endif
        @endif
        <!--Handle Success Ends-->

        <!--Handle Warnings-->
        @if(isset($warnings))
            @if (count($warnings) > 0)
                @foreach($warnings as $warning)
                    <script type="text/javascript">
                       new PNotify({
                            icon: 'fa fa-flash',
                            text: '{{$warning}}',
                            type : 'warning',
                        });
                    </script>
                @endforeach
            @endif
        @endif
        @if(null !== session('warnings'))
            @if (count(session('warnings')) > 0)
                @foreach(session('warnings') as $warning)
                    <script type="text/javascript">
                       new PNotify({
                            icon: 'fa fa-flash',
                            text: '{{$warning}}',
                            type : 'warning',
                        });
                    </script>
                @endforeach
            @endif
        @endif
        <!--Handle Warnings Ends-->

        <!--Handle Info-->
        @if(isset($info))
            @if (count($info) > 0)
                @foreach($info as $inf)
                    <script type="text/javascript">
                       new PNotify({
                            icon: 'fa fa-tv',
                            text: '{{$inf}}',
                            type : 'info',
                        });
                    </script>
                @endforeach
            @endif
        @endif
        @if(null !== session('info'))
            @if (count(session('info')) > 0)
                @foreach(session('info') as $inf)
                    <script type="text/javascript">
                       new PNotify({
                            icon: 'fa fa-tv',
                            text: '{{$inf}}',
                            type : 'info',
                        });
                    </script>
                @endforeach
            @endif
        @endif
        <!--Handle Info Ends-->
  </body>
</html>
