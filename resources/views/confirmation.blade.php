@extends('master')
@section('title', 'Confirmation')
@section('main')

    <!-- start Main Wrapper -->
    <div class="main-wrapper category pay-confirm">

        <!-- start hero-header -->
        <div class="hero img-bg-01 in-banner">
            <div class="container">

                <div class="wrap-content">
                    <h1>Cylinder Booking done</h1>
                </div>

                <div class="breadcrumb">
                    <div class="container">
                        <ol>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><a href="{{url('/cylinders')}}">Booking</a></li>
                            <li class="active">Confirmation</li>
                        </ol>
                    </div>
                </div>

            </div>
            <div class="overlay"></div>
        </div>
        <!-- end hero-header -->

        <div class="confirmation-wrapper">

            <div class="container">

                <div class="row">

                    <div class="col-xs-12 col-md-10 col-md-offset-1">

                        <div class="confirmation-inner">

                            <div class="promo-box">
                                <div class="icon">
                                    <i class="ti-check"></i>
                                </div>
                                <h4>Congratulation! Your booking was done. Enjoy cooking.</h4>
                            </div><!-- end promo box -->

                            <div class="pay-content">

                                <h4 class="section-title">Booking Information</h4>
                                <p>This page confirms that <b>{{$transaction->cylinder->user->name}}</b> has received your booking request, please wait to receive your cylinder</p>
                                <div class="row">
                                    <div class="col-sm-4"><img src="{{$transaction->cylinder->image_url()}}" alt=""></div>
                                    <div class="col-sm-8">
                                        <h3 class="section-title">{{$transaction->cylinder->name}}</h3>
                                        <ul class="book-sum-list">
                                            <li><span class="font600">Agent name: </span>{{$transaction->cylinder->user->name}}</li>
                                            <li><span class="font600">Agent Email: </span>{{$transaction->cylinder->user->email}}</li>
                                            <li><span class="font600">Agent Phone: </span>{{$transaction->cylinder->user->mobile_no}}</li>
                                            <li><span class="font600">Your Name: </span>{{$transaction->user->name}}</li>
                                            <li><span class="font600">Your Email: </span>{{$transaction->user->email}}</li>
                                            <li><span class="font600">Your Phone Number: </span>{{$transaction->user->mobile_no}}</li>
                                            <li><span class="font600">Cylinder size: </span>{{$transaction->cylinder->size}}</li>
                                            <li><span class="font600">Billing Address: </span>Kigali, {{$transaction->user->address}}</li>
                                            <li><span class="font600">Booking Time:: </span> {{$transaction->created_at}}</li>
                                            <li><span class="font600">Booking Status: </span>{{$transaction->status}}</li>
                                            <li><span class="font600">Payment method: </span>{{$transaction->payments}}</li>
                                            <li><span class="font600">Booking Amount: </span>{{$transaction->cylinder->price}}</li>
                                        </ul>
                                        <a class="btn btn-primary" style="margin-top: 20px" href="{{url('/dashboard')}}">Go to dashboard</a>
                                    </div>
                                </div>
                            </div><!-- end pay content -->
                        </div><!-- end confirmation-inner -->

                    </div>

                </div>

            </div>
        </div><!-- end confirmation wrapper -->

    </div>
    <!-- end Main Wrapper -->

@endsection
