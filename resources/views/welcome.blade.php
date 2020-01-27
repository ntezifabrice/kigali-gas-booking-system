@extends('master')
@section('title', 'Home')
@section('main')
    <!-- start Main Wrapper -->
    <div class="main-wrapper scrollspy-container">

        <!-- start hero-header -->
        <div class="hero img-bg-01">
            <div class="container">

                <div class="wrap-content">

                    <h1 class="okkk">Welcome to <span>Kigali Gas Booking</span> System</h1>
                    <p>Book your gas bottle and stay home, we will reach you in 5 minutes</p>

                    <form action="{{url('/cylinders')}}" id="searching_form">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="text" placeholder="eg: SP Gas" class="form-control flexdatalist" data-data="{{url('/search')}}" data-search-in='["name","size", "agent_name", "agent_address", "price"]' data-visible-properties='["name","price","agent_address"]' data-group-by="agent_name" data-selection-required="true" data-focus-first-result="true" data-min-length="1" data-value-property="url" data-text-property="{name}, {agent_address}" data-search-contain="false" id="searching">
                            <button class="btn"><i class="icon-arrow-right"></i></button>
                        </div>
                    </form>

                    <div class="top-search">
                        <span class="font700">Top Searches : </span>
                        @foreach($cylinders->unique('size')->unique('user.id')->take(3) as $search)
                        <a href="{{url('/booking/'.$search->id)}}">{{$search->size.' '.$search->user->name}}</a>
                        @endforeach
                    </div>
                </div><!--  end wrap content -->

            </div>
            <div class="overlay"></div>
        </div>
        <!-- end hero-header -->

        <!-- start popular tour -->
        <section class="popular post-hero clearfix">
            <div class="container">

                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                        <div class="section-title"><!-- start section title -->
                            <h2>Mostly Booked Gas Cylinders</h2>
                            <p>Consumers love these gas cylinders for its cheap pricing</p>
                        </div><!-- end section title -->
                    </div>
                </div>

                <div class="experiences-e">
                    @php
                    $colors=['green','blue','red'];
                    $color=0;
                    @endphp
                    @foreach($cylinders as $cylinder)
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
                            <p style="padding-left: 15px;color:red">(Only {{$cylinder->available}} remaining)</p>
                        </div>
                    </div><!-- end experiences-e item -->
                    @endforeach

                </div><!-- end experiences-e -->

                <div class="destination-all col-sm-12">
                    <a href="{{url('/cylinders')}}">See All Gas Cylinders</a>
                </div><!-- end button -->

            </div>
        </section>
        <!-- end popular tour -->

        <!-- start our services -->
        <section class="post-hero" style="padding-top: 15px">

            <div class="container">

                <div class="section-title"><!-- start section title -->
                    <h2>Safety Tips For Gas Bottle</h2>
                    <p>“Your life is important, keep it safe”</p>
                </div><!-- end section title -->

                <div class="row">

                    <div class="col-xs-12 col-sm-4">
                        <div class="horizontal-featured-icon-sm clearfix">
                            <div class="icon"><i class="fa fa-close"></i></div>
                            <div class="content">
                                <h3>Do not place a gas cylinder in closed areas.</h3>
                            </div>
                        </div>
                    </div><!-- end services item -->

                    <div class="col-xs-12 col-sm-4">
                        <div class="horizontal-featured-icon-sm clearfix">
                            <div class="icon"> <i class="fa fa-exchange"></i></div>
                            <div class="content">
                                <h3>Close the regulator once you finish cooking</h3>
                            </div>
                        </div>
                    </div><!-- end services item -->

                    <div class="col-xs-12 col-sm-4">
                        <div class="horizontal-featured-icon-sm clearfix">
                            <div class="icon"> <i class="fa fa-bolt"></i></div>
                            <div class="content">
                                <h3>Always install a gas pipeline above ground level</h3>
                            </div>
                        </div>
                    </div><!-- end services item -->

                    <div class="col-xs-12 col-sm-4">
                        <div class="horizontal-featured-icon-sm clearfix">
                            <div class="icon"> <i class="fa fa-arrow-up"></i></div>
                            <div class="content">
                                <h3>Keep the cylinder vertical during usage and storage</h3>
                            </div>
                        </div>
                    </div><!-- end services item -->

                    <div class="col-xs-12 col-sm-4">
                        <div class="horizontal-featured-icon-sm clearfix">
                            <div class="icon"> <i class="fa fa-ban"></i></div>
                            <div class="content">
                                <h3>Do not use any flammable objects near or over the burner</h3>
                            </div>
                        </div>
                    </div><!-- end services item -->

                    <div class="col-xs-12 col-sm-4">
                        <div class="horizontal-featured-icon-sm clearfix">
                            <div class="icon"> <i class="fa fa-arrow-down"></i></div>
                            <div class="content">
                                <h3>Never store Gas Bottle in basement or elevated platforms</h3>
                            </div>
                        </div>
                    </div><!-- end services item -->

                </div>

            </div>
        </section>
        <!-- end our services -->

        <!-- start popular tour -->
        <section class="popular post-hero clearfix">
            <div class="container">

                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                        <div class="section-title"><!-- start section title -->
                            <h2>Popular Gas Agents We Work With</h2>
                            <p>These agents are popular in Kigali and all over the country</p>
                        </div><!-- end section title -->
                    </div>
                </div>

                <div class="experiences-e">
                    @php($color=0)
                    @foreach($agents as $agent)
                        @if($color==3)@php($color=0)@endif
                        <div class="col-sm-3" style="outline: 1px solid rgba(0,0,0,0.2)">
                            <div class="top-destination-item">
                                <a href="{{url('/agents/'.$agent->id)}}">
                                    <div class="image">
                                        <img src="{{$agent->image_url()}}" alt="images" />
                                        <h4 class="{{$colors[$color++]}}">View cylinders</h4>
                                    </div>
                                </a>
                            </div>
                            <div class="top-details">
                                <div class="top-content">
                                    <div class="col-sm-12">
                                        <span><b>Name:</b> {{$agent->name}}</span><br/>
                                        <span><b>Phone:</b> {{$agent->mobile_no}}</span><br/>
                                        <span><b>Address:</b> {{$agent->address}}</span>
                                    </div>
                                    <hr/>
                                </div>
                                <p style="padding-left: 15px;"><a href="{{url('/agents/'.$agent->id)}}"> <b>( Has {{$agent->cylinders->count()}} cylinder types )</b></a></p>
                            </div>
                        </div><!-- end experiences-e item -->
                    @endforeach

                </div><!-- end experiences-e -->

                <div class="destination-all col-sm-12">
                    <a href="{{url('/agents')}}">See All Gas Agents</a>
                </div><!-- end button -->

            </div>
        </section>
        <!-- end popular tour -->

    </div>
    <!-- end Main Wrapper -->
@endsection
