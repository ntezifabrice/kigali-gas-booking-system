@extends('master')
@section('title', 'Agent cylinders')
@section('main')
    <!-- start Main Wrapper -->
    <div class="main-wrapper scrollspy-container">

        <!-- start hero-header -->
        <div class="hero img-bg-01 in-banner">
            <div class="container">

                <div class="wrap-content">

                    <h1>Agent's <span> Cylinders</span></h1>
                    <p>&nbsp;</p>
                </div>

                <div class="breadcrumb">
                    <div class="container">
                        <ol>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li class="active">Agent's Cylinders</li>
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

                    <div class="col-xs-12 col-sm-12 col-md-7">

                        <div class="content-wrapper">

                            <div class="details-top"><!-- start title -->
                                <h2>{{$agent->name}}</h2>
                            </div><!-- end title -->

                            <div class="detail-content-sticky-nav">

                                <div class="featured-icon-simple-wrapper">

                                    <div class="row">

                                        <div class="col-sm-5 col-xs-5">
                                            <div class="featured-icon-simple-item">
                                                <div class=" icon text-primary">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                                <strong>Since {{$agent->created_at->format('F Y')}}</strong>
                                            </div>
                                        </div>

                                        <div class="col-sm-7 col-xs-7">
                                            <div class="featured-icon-simple-item">
                                                <div class="icon text-primary">
                                                    <i class="fa fa-cube"></i>
                                                </div>
                                                <strong>{{$agent->cylinders->count()}} Cylinder{{$agent->cylinders->count()>1?'s':''}} Available</strong>
                                            </div>
                                        </div>

                                    </div>

                                </div><!-- end featured-icon-simple-wrapper -->
                            </div><!-- end detail-content-sticky-nav -->
                            <div class="detail-content-sticky-nav">

                                <h3 class="font-lg">Terms & Conditions to book from {{$agent->name}}</h3>

                                <div id="MainMenu">
                                    <div class="list-group panel">
                                        <a href="#demo1" class="list-group-item list-group-item-success itenerary_tab" data-toggle="collapse" data-parent="#MainMenu">
                                            <div class="pull-left"><h5>Step<span>01</span></h5></div>
                                            <div class="t-heading">
                                                <h4 class="font-lg">You placed the order [With empty bottle at home]</h4>
                                                <p>After placing the order, you will pay by using the payment method you have chosen.</p>
                                            </div>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <div class="collapse" id="demo1">
                                            <p>Book a cylinder and choose your payment method, if you don't pay, you will never get a cylinder.</p>
                                        </div>

                                        <a href="#demo2" class="list-group-item list-group-item-success itenerary_tab" data-toggle="collapse" data-parent="#MainMenu">
                                            <div class="pull-left"><h5>Step<span>02</span></h5></div>
                                            <div class="t-heading">
                                                <h4 class="font-lg">We mark the order as Active as We receive your payment</h4>
                                                <p>When we received your payment, we mark your order as Active.</p>
                                            </div>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <div class="collapse" id="demo2">
                                            <p>As soon as we received your payment, we will mark the transaction as Active</p>
                                        </div>

                                        <a href="#demo3" class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu">
                                            <div class="pull-left"><h5>Step<span>03</span></h5></div>
                                            <div class="t-heading">
                                                <h4 class="font-lg">We deliver your gas to your home and take your empty bottle</h4>
                                                <p>Our distributors will reach your house and bring your gas.</p>
                                            </div>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <div class="collapse" id="demo3">
                                            <p>When your booking is marked as Active, wait for us to reach your home with your cylinder.</p>
                                        </div>

                                        <a href="#demo4" class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu">
                                            <div class="pull-left"><h5>Step<span>04</span></h5></div>
                                            <div class="t-heading">
                                                <h4 class="font-lg">You mark the booking as Finished</h4>
                                                <p>As well as you receive your gas cylinder, you will mark the booking as finished</p>
                                            </div>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <div class="collapse" id="demo4">
                                            <p>Remember to mark the booking as Finished when you receive your cylinder.</p>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end detail-content-sticky-nav -->

                        </div><!-- end content wrapper -->
                    </div>

                    <div id="sidebar-sticky" class="col-xs-12 col-sm-12 col-md-5 sticky-mt-70 sticky-mb-0">
                        <aside class="sidebar-wrapper with-box-shadow">
                            <div class="col-sm-12">

                                <div class="slider sidefd">

                                    <div class="image-sidebar">
                                        <img src="{{$agent->image_url()}}" alt="image"/>
                                    </div>

                                </div>
                                <div class="col-sm-12">
                                        <div class="featured-list-in-box">

                                            <h4 class="uppercase spacing-1">Agent Info</h4>

                                            <ul class="clearfix">
                                                <li class="row">
                                                    <div class="col-xs-12 col-sm-4">
                                                        Address
                                                    </div>
                                                    <div class="col-xs-12 col-sm-8 text-primary text-left mt-xs space">
                                                        <i class="ti-location-pin mr-5"></i> {{$agent->address}}
                                                    </div>
                                                </li>
                                                <li class="row">
                                                    <div class="col-xs-12 col-sm-4">
                                                        Phone
                                                    </div>
                                                    <div class="col-xs-12 col-sm-8 text-primary text-left mt-xs space">
                                                        <i class="ti-mobile mr-5"></i> {{$agent->mobile_no}}
                                                    </div>
                                                </li>
                                                <li class="row">
                                                    <div class="col-xs-12 col-sm-4">
                                                        Email
                                                    </div>
                                                    <div class="col-xs-12 col-sm-8 text-primary text-left mt-xs space">
                                                        <i class="ti-email mr-5"></i> {{$agent->email}}
                                                    </div>
                                                </li>
                                                <li class="row">
                                                    <div class="col-xs-12 col-sm-4">
                                                        Name
                                                    </div>
                                                    <div class="col-xs-12 col-sm-8 text-primary text-left mt-xs space">
                                                        <i class="ti-user mr-5"></i> {{$agent->name}}
                                                    </div>
                                                </li>
                                            </ul>

                                        </div>


                                    </div>
                            </div>
                        </aside><!-- end sidebar-wrapper with-box-shadow -->
                    </div><!-- end sidebar-sticky -->
                    @if(in_array($agent->address,['Kicukiro','Nyarugenge','Gasabo']))
                    <div class="col-sm-12">
                        <div class="detail-content-sticky-nav">

                            <h3 class="font-lg">{{$agent->name}} is also located around {{$agent->address}}</h3>
                            <div>
                                @if($agent->address=='Kicukiro')
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15949.831986193245!2d30.085034882285793!3d-1.9709167255541395!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca62d5ccf73a5%3A0x85be08f36aff91dd!2sKicukiro%2C%20Kigali!5e0!3m2!1sen!2srw!4v1579096327707!5m2!1sen!2srw" height="350" frameborder="0" style="border:0;width:100%" allowfullscreen=""></iframe>
                                @elseif($agent->address=='Nyarugenge')
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15950.04607564468!2d30.051698466731484!3d-1.9484402985794766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca42f844c762b%3A0x6c80a66352d05b7d!2sNyarugenge%20District%20Office!5e0!3m2!1sen!2srw!4v1579096117389!5m2!1sen!2srw" height="350" frameborder="0" style="border:0;width:100%" allowfullscreen=""></iframe>
                                @elseif($agent->address=='Gasabo')
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127601.05729765224!2d30.010928558691237!3d-1.939328998586116!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca7d04b1a723b%3A0x24a1b4aac8562b10!2sGasabo%20District!5e0!3m2!1sen!2srw!4v1579095520970!5m2!1sen!2srw" height="350" frameborder="0" style="border:0;width:100%" allowfullscreen=""></iframe>
                                @endif
                            </div>
                        </div><!-- end detail-content-sticky-nav -->
                    </div>
                    @endif
                </div>
            </div>
            <section class="exp-deail-page">
                <div class="container">
                    <h2 class="font-lg">Agent's cylinders</h2>

                    <div class="slider responsive top-booked"><!-- start top booked -->
                        @php
                            $colors=['green','blue','red'];
                            $color=0;
                        @endphp
                        @foreach($agent->cylinders as $cylinder)
                            @if($color==3)@php($color=0)@endif
                            <div class="col-sm-3" style="outline: 1px solid rgba(0,0,0,0.2)">
                                <div class="top-destination-item">
                                    <a href="{{url('/cylinders/'.$cylinder->id)}}">
                                        <div class="image">
                                            <img src="{{$cylinder->image_url()}}" alt="images" />
                                            <h4 class="{{$colors[$color++]}}">Book now</h4>
                                        </div>
                                    </a>
                                </div>

                                <div class="top-details">
                                    <div class="top-content">
                                        <div class="col-sm-12">
                                            <a href="{{url('/cylinders/'.$cylinder->id)}}">{{$cylinder->name}}</a><br/>
                                            <span><b>Price:</b> {{$cylinder->price}}</span><br/>
                                            <span><b>Size:</b> {{$cylinder->size}}</span><br/>
                                            <span><b>Agent:</b> {{$cylinder->user->name}}</span>
                                        </div>
                                    </div>
                                    <p style="padding-left: 15px;"><a href="{{url('/cylinders/'.$cylinder->id)}}"> <b>( {{$cylinder->available}} cylinders available )</b></a></p>
                                </div>
                            </div><!-- end experiences-e item -->
                        @endforeach
                    </div><!-- end top booked -->
                </div>
            </section><!-- end exp-detail-page -->
        </section><!-- end main content -->

    </div>
    <!-- end Main Wrapper -->
@endsection
