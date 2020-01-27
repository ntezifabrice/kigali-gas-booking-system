<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title Of Site -->
    <title>{{ setting('site.title') }} - @yield('title')</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="fabrice">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Fav Icons -->
    <link rel="shortcut icon" href="<?php echo asset('assets/images/ico/favicon.png'); ?>">

    <!-- CSS Plugins -->
    <link rel="stylesheet" type="text/css" href="<?php echo asset('assets/bootstrap/css/bootstrap.min.css'); ?>" media="screen">
    <link href="<?php echo asset('assets/css/main.css'); ?>" rel="stylesheet">
    <link href="<?php echo asset('assets/css/plugin.css'); ?>" rel="stylesheet">

    <link href="<?php echo asset('assets/css/dashboard.css'); ?>" rel="stylesheet">
    <link href="<?php echo asset('assets/css/icons.css'); ?>" rel="stylesheet">

    <!-- CSS Custom -->
    <link href="<?php echo asset('assets/css/style.css'); ?>" rel="stylesheet">

    <!-- CSS Custom -->
    <link href="<?php echo asset('assets/css/your-style.css'); ?>" rel="stylesheet">

</head>

<body class="home transparent-header">

<!-- start Container Wrapper -->
<div id="container-wrapper">

    <!-- Header Container
    ================================================== -->
    <header id="header-container" class="fixed fullwidth dashboard">

        <!-- Header -->
        <div id="header" class="not-sticky">
            <div class="container">

                <!-- Left Side Content -->
                <div class="left-side">

                    <!-- Logo -->
                    <div id="logo">
                        <a href="{{url('/dashboard')}}" class="dashboard-logo"><img src="<?php echo asset('assets/images/logo1.png'); ?>" alt=""></a>
                    </div>

                    <!-- Mobile Navigation -->
                    <div class="menu-responsive">
                        <i class="fa fa-reorder menu-trigger"></i>
                    </div>

                    <!-- Main Navigation -->
                    <nav id="navigation" class="style-1 pull-right">
                        @section('full-menu')
                        {{menu('dashboard', 'parts/top-menu-dashboard')}}
                        @show
                    </nav>
                    <div class="clearfix"></div>
                    <!-- Main Navigation / End -->

                </div>
                <!-- Left Side Content / End -->

            </div>
        </div>
        <!-- Header / End -->
    </header>

    <div class="clearfix"></div>
    <!-- Header Container / End -->

    <div class="breadcrumb-wrapper dash-bread">

        <div class="container">

            <div class="row">

                <div class="col-xs-12 col-sm-8">
                    <ol class="breadcrumb">
                        <li><a href="{{url('/')}}">Home</a></li>
                        @section('breadcrumb')<li class="active">Dashboard</li>@show
                    </ol>
                </div>

            </div>

        </div>
    </div>

    <!-- Dashboard -->
    <div id="dashboard">

        <!-- Navigation
        ================================================== -->

        <!-- Responsive Navigation Trigger -->
        <a href="#" class="dashboard-responsive-nav-trigger"><i class="fa fa-reorder"></i> Dashboard Navigation</a>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="dashboard-nav">
                        <div class="profile-sec">
                            <div class="dash-image"><img src="{{$user->image_url()}}" alt=""></div>
                            <div class="dash-content">
                                <h3>{{$user->name}}</h3>
                                <span>{{ucfirst($user->role->name)}}</span>
                            </div>
                        </div>
                        <div class="dashboard-nav-inner">
                            @section('menu')
                            {{menu('dashboard', 'parts/left-menu-dashboard')}}
                            @show
                        </div>
                    </div>
                </div>
                <!-- Navigation / End -->


                <div class="col-sm-9">
                    <!-- Content
                    ================================================== -->
                    @yield('main')
                    <!-- Content / End -->
                </div>

            </div>

        </div>

        <!-- Copyrights -->
        <div class="copyrights">© {{date('Y')}} - {{ setting('site.title') }}</div>
        <!-- Log out form -->
        <form method="POST" id="logoutForm" action="/logout">{{csrf_field()}}</form>
    </div>
    <!-- Dashboard / End -->
</div>
<!-- end Container Wrapper -->


<!-- Core JS -->
<script src="<?php echo asset('assets/js/jquery-3.2.1.min.js'); ?>"></script>
<!-- Result Page JS -->
<script src="<?php echo asset('assets/js/jpanelmenu.min.js'); ?>"></script>
<script src="<?php echo asset('assets/js/counterup.min.js'); ?>"></script>
<script src="<?php echo asset('assets/js/core-plugins.js'); ?>"></script>
<script src="<?php echo asset('assets/js/canvasjs.min.js'); ?>"></script>
<script src="<?php echo asset('assets/js/chartjs/Chart.min.js'); ?>"></script>
<script src="<?php echo asset('assets/js/chartjs/utils.js'); ?>"></script>
<script>
    $(document).ready(function () {
        let logoutModal=$('#logoutModal');
        if(logoutModal.length){
            let logoutForm = $('#logoutForm');
            logoutModal.click(function () {
                logoutForm.submit();
            });
            let logoutModal2=$('#logoutModal2');
            if(logoutModal2.length){
                logoutModal2.click(function () {
                    logoutForm.submit();
                });
            }
        }
    });
</script>
@yield('custom-js')
<script src="<?php echo asset('assets/js/dashboard-custom.js'); ?>"></script>
</body>

</html>
