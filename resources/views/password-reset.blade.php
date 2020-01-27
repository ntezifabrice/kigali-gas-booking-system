@extends('master')

@section('main')

    <!-- start Main Wrapper -->
    <div class="main-wrapper scrollspy-container">

        <!-- start hero-header -->
        <div class="hero img-bg-01 in-banner">
            <div class="container">

                <div class="wrap-content">

                    <h1><span>Password</span> Reset</h1>
                    <p>&nbsp;</p>
                </div>

                <div class="breadcrumb">
                    <div class="container">
                        <ol>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li class="active">Reset Password</li>
                        </ol>
                    </div>
                </div>

            </div>
            <div class="dot-overlay"></div>
            <div class="overlay"></div>
        </div>
        <!-- end hero-header -->

        <section class="main-content">

            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <!-- start Sign-in Modal -->
                        <div class="login-box-wrapper" data-width="550">
                            <form method="POST" action="/password/reset">
                                {{csrf_field()}}
                                <input type="hidden" name="token" value="{{ $token }}">
                                <input type="hidden" name="email" value="{{ $email }}">

                                <div class="modal-header">
                                    <h2 class="text-center">Reset your password</h2>
                                </div>

                                <div class="modal-body">
                                    <div class="row gap-20">

                                        <div class="col-sm-12 col-md-12">

                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input class="form-control" required name="password" placeholder="" type="password">
                                            </div>

                                        </div>

                                        <div class="col-sm-12 col-md-12">

                                            <div class="form-group">
                                                <label>Confirm New Password</label>
                                                <input name="password_confirmation" class="form-control" placeholder="" type="password">
                                            </div>

                                        </div>

                                        <div class="col-sm-12 col-md-12">
                                            <div class="login-box-box-action">
                                                Have account? <a data-toggle="modal" href="#loginModal">Login</a>
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
                                    <button type="submit" class="btn btn-primary">Reset password</button>
                                </div>
                            </form>
                        </div>
                        <!-- end Sign-in Modal -->
                    </div>
                </div>

            </div>

        </section><!-- end main-content -->

    </div>
    <!-- end Main Wrapper -->

@endsection
