<!doctype html>
<html lang="en">

<!-- Mirrored from cyclonethemes.com/demo/html/cyclone-tour/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Jan 2020 18:31:35 GMT -->
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

    <!-- CSS Custom -->
    <link href="<?php echo asset('assets/css/style.css'); ?>" rel="stylesheet">

    <!-- Add your style -->
    <link href="<?php echo asset('assets/css/your-style.css'); ?>" rel="stylesheet">

</head>

<body class="home transparent-header">

<!-- start Container Wrapper -->
<div class="container-wrapper">
@section('header')
    <!-- start Header -->
    <header id="header">
        <div id="sp-top-bar">
            <div class="container">
                <div class="row">
                    <div id="sp-top2" class="col-sm-9 col-md-9">
                        <div class="sp-column social-one">
                            <ul class="sp-contact-info">
                                <li class="sp-contact-phone"><i class="fa fa-phone"></i>&nbsp; Phone: &nbsp;<a href="tel:+250785672383">0785672383</a></li>
                                <li class="sp-contact-email"><i class="fa fa-envelope-o"></i>&nbsp; Email:&nbsp; <a href="mailto:contact@kigaligasbookingsystem.com">contact@kigaligasbookingsystem.com</a></li>
                                <li class="sp-contact-time"><i class="fa fa-clock-o"></i>&nbsp; Working Time: &nbsp;<a>Mon-fri: 6 AM - 10 PM</a></li>
                            </ul>
                        </div>
                    </div>
                    <div id="sp-top1" class="col-sm-3 col-md-3">
                        <div class="nav-mini-wrapper pull-right">
                            <ul class="nav-mini">
                                @guest
                                    <li><a data-toggle="modal" href="#registerModal"><i class="fa fa-user-plus" data-toggle="tooltip" data-placement="bottom" title="Register"></i>Register</a></li>
                                    <li><a data-toggle="modal" href="#loginModal"><i class="fa fa-user" data-toggle="tooltip" data-placement="bottom" title="login"></i>Log In</a></li>
                                @else
                                    <li><a href="/dashboard"><i class="fa fa-dashboard" data-toggle="tooltip" data-placement="bottom" title="Dashboard"></i>Dashboard</a></li>
                                    <li class="bg-danger"><a href="javascript:void(0)" id="logoutModal"><i class="fa fa-power-off" data-toggle="tooltip" data-placement="bottom" title="Log out"></i>Log Out</a></li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- start Navbar (Header) -->
        <nav class="navbar navbar-default navbar-fixed-top navbar-sticky-function navbar-arrow">

            <div class="container">

                <div class="logo pull-left">
                    <a href="{{url('/')}}"><img src="<?php echo asset('assets/images/logo.png'); ?>" alt=""></a>
                </div>

                <div id="navbar" class="navbar-nav-wrapper pull-right">

                        {{menu('main', 'parts/top-menu')}}

                </div><!--/.nav-collapse -->

            </div>

            <div id="slicknav-mobile"></div>
        </nav>
        <!-- end Navbar (Header) -->
    </header>
    <!-- end Header -->
@show
    @yield('main')
@section('footer')
    <!-- start Footer Wrapper -->
    <div class="footer-wrapper scrollspy-footer">

        <footer class="bottom-footer">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <p class="copy-right">&#169; 2019-{{date('Y')}} - <a href="{{url('/')}}">{{ setting('site.title') }}</a></p>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-4">

                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <ul class="bottom-footer-menu">
                            <?php
                            $best_agents = \App\User::whereHas('role', function ($query){
                                $query->whereName('agent');
                            })->whereHas('cylinders', function ($query){
                                $query->where('available', '>', 0)->orderBy('available', 'DESC');
                            })->take(4)->get();
                            ?>
                            @foreach($best_agents as $search)
                                    <li><a href="{{url('/agents/'.$search->id)}}">{{$search->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </footer><!-- end bottom footer -->
    </div>
    <!-- end Footer Wrapper -->
@show
</div>
<!-- end Container Wrapper -->
@section('foot')
<!-- start Back To Top -->
<div id="back-to-top">
    <a href="#"><i class="ion-ios-arrow-up"></i></a>
</div>
<!-- end Back To Top -->

<!-- start Sign-in Modal -->
<div id="loginModal" class="modal fade login-box-wrapper" tabindex="-1" data-width="550" data-backdrop="static" data-keyboard="false" data-replace="true">
    <form method="POST" action="http://localhost:8000/login">
        {{csrf_field()}}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-center">Sign-in into your account</h4>
    </div>

    <div class="modal-body">
        <div class="row gap-20">

            <div class="col-sm-12 col-md-12">

                <div class="form-group">
                    <label>Username</label>
                    <input class="form-control" name="email" placeholder="Min 4 and Max 10 characters" type="text">
                </div>

            </div>

            <div class="col-sm-12 col-md-12">

                <div class="form-group">
                    <label>Password</label>
                    <input name="password" class="form-control" placeholder="Min 4 and Max 10 characters" type="password">
                </div>

            </div>

            <div class="col-sm-6 col-md-6">
                <div class="checkbox-block">
                    <input id="remember_me_checkbox" name="remember" class="checkbox" value="1" type="checkbox">
                    <label class="" for="remember_me_checkbox">Remember me</label>
                </div>
            </div>

            <div class="col-sm-6 col-md-6">
                <div class="login-box-link-action">
                    <a data-toggle="modal" href="#forgotPasswordModal" class="block line18 mt-1">Forgot password?</a>
                </div>
            </div>

            <div class="col-sm-12 col-md-12">
                <div class="login-box-box-action">
                    No account? <a data-toggle="modal" href="#registerModal">Register</a>
                </div>
            </div>

        </div>
    </div>

    <div class="modal-footer text-center">
        <button type="submit" class="btn btn-primary">Log-in</button>
        <button type="button" data-dismiss="modal" class="btn btn-primary btn-border">Close</button>
    </div>
    </form>
</div>
<!-- end Sign-in Modal -->

<!-- start Register Modal -->
<div id="registerModal" class="modal fade login-box-wrapper" tabindex="-1" data-backdrop="static" data-keyboard="false" data-replace="true">
<form method="POST" action="{{url('/register')}}" autocomplete="off">
    {{csrf_field()}}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-center">Create your account for free</h4>
    </div>

    <div class="modal-body">

        <div class="row gap-20">

            <div class="col-sm-12 col-md-12">

                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" value="" required name="name" placeholder="Your name" type="text">
                </div>

            </div>

            <div class="col-sm-12 col-md-12">

                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" value="" name="email" placeholder="Your email address" type="email">
                </div>

            </div>
            <div class="col-sm-12 col-md-12">

                <div class="form-group">
                    <label>Telephone</label>
                    <input class="form-control" value="" name="mobile_no" placeholder="Your phone" type="tel">
                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">
                    <label>Address</label>
                    <select class="form-control" name="address" required>
                        <option value="">Choose your address</option>
                        <option value="Kicukiro">Kicukiro</option>
                        <option value="Nyarugenge">Nyarugenge</option>
                        <option value="Gasabo">Gasabo</option>
                    </select>
                </div>

            </div>
            <div class="col-md-6">

                <div class="form-group">
                    <label>Register as</label>
                    <select class="form-control" name="role_id" required>
                        <option value="">Choose your role</option>
                        <option value="3">Gas Agent</option>
                        <option value="2">Consumer</option>
                    </select>
                </div>

            </div>

            <div class="col-sm-12 col-md-12">

                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" value="" name="password" placeholder="********" type="password">
                </div>

            </div>

        </div>

    </div>

    <div class="modal-footer text-center">
        <button type="submit" class="btn btn-primary">Register</button>
        <button type="button" data-dismiss="modal" class="btn btn-primary btn-border">Close</button>
    </div>
</form>
</div>
<!-- end Register Modal -->

<!-- start Forget Password Modal -->
<div id="forgotPasswordModal" class="modal fade login-box-wrapper" tabindex="-1" data-backdrop="static" data-keyboard="false" data-replace="true">
<form method="POST" action="/password/email">
    {{csrf_field()}}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-center">Restore your forgotten password</h4>
    </div>

    <div class="modal-body">
        <div class="row gap-20">

            <div class="col-sm-12 col-md-12">
                <p class="mb-20">Let us know the email you used during sign up, we will send you a verification link to create your new password.</p>
            </div>

            <div class="col-sm-12 col-md-12">

                <div class="form-group">
                    <label>Email Address</label>

                    <input class="form-control" name="email" placeholder="Enter your email address" type="text">
                </div>

            </div>

            <div class="col-sm-12 col-md-12">
                <div class="login-box-box-action">
                    Return to <a data-toggle="modal" href="#loginModal">Log-in</a>
                </div>
            </div>

        </div>
    </div>

    <div class="modal-footer text-center">
        <button type="submit" class="btn btn-primary">Restore</button>
        <button type="button" data-dismiss="modal" class="btn btn-primary btn-border">Close</button>
    </div>
</form>
</div>
<!-- end Forget Password Modal -->
<!-- Log out form -->
<form method="POST" id="logoutForm" action="/logout">
    {{csrf_field()}}
</form>
@show
<!-- Core JS -->
<script src="<?php echo asset('assets/js/jquery-3.2.1.min.js'); ?>"></script>
<script src="<?php echo asset('assets/js/core-plugins.js'); ?>"></script>
<script src="<?php echo asset('assets/js/customs.js'); ?>"></script>
<script>
    $(document).ready(function () {
        let logoutModal=$('#logoutModal');
        if(logoutModal.length){
            logoutModal.click(function () {
                $('#logoutForm').submit();
            });
        }
        let paymentDiv=$('#payment-div');
        if(paymentDiv.length){
            $('#payment-div > form :input').prop("disabled", true);
        }
        let searchButton=$('#searching');
        if(searchButton.length){
            let searchForm=$('#searching_form');
            searchForm.on('submit', function (event) {
                event.preventDefault();
                window.location = searchButton.val();
            });
        }
    });
</script>
@yield('custom-js')

<!-- Only in Home Page -->
<script src="<?php echo asset('assets/js/jquery.flexdatalist.js'); ?>"></script>

</body>


<!-- Mirrored from cyclonethemes.com/demo/html/cyclone-tour/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Jan 2020 18:34:28 GMT -->
</html>
