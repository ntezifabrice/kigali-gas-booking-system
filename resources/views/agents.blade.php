@extends('master')
@section('title', 'Agents')
@section('main')
    <!-- start Main Wrapper -->
    <div class="main-wrapper scrollspy-container">

        <!-- start hero-header -->
        <div class="hero img-bg-01 in-banner">
            <div class="container">

                <div class="wrap-content">

                    <h1>All <span>Agents</span></h1>
                    <p>&nbsp;</p>
                </div>

                <div class="breadcrumb">
                    <div class="container">
                        <ol>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li class="active">Agents</li>
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

                <div class="experiences-e">

                    @php
                        $colors=['green','blue','red'];
                        $color=0;
                    @endphp
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

                <div class="pager-wrappper clearfix">
                    <div class="pager-innner">
                        <div class="clearfix">
                            Showing {{$agents->count()}} agent{{$agents->count()>1?'s':''}} from {{$agents->total()}} agent{{$agents->total()>1?'s':''}} (Page #{{$agents->currentPage()}})
                        </div>
                        <div class="clearfix">
                            <nav class="pager-center">
                                <ul class="pagination">
                                    <li>
                                        <a href="{{$agents->previousPageUrl()}}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    @foreach(range(1, $agents->lastPage()) as $page_num)
                                        <li class="{{$agents->currentPage()==$page_num?'active':''}}"><a href="{{$agents->url($page_num)}}">{{$page_num}}</a></li>
                                    @endforeach
                                    <li>
                                        <a href="{{$agents->nextPageUrl()}}" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div><!-- end pagination -->

            </div>

        </section><!-- end main-content -->

    </div>
    <!-- end Main Wrapper -->
@endsection
