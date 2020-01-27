@extends('master')
@section('title', 'Cylinders')
@section('main')
    <!-- start Main Wrapper -->
    <div class="main-wrapper scrollspy-container">

        <!-- start hero-header -->
        <div class="hero img-bg-01 in-banner">
            <div class="container">

                <div class="wrap-content">

                    <h1>All <span>Cylinders</span></h1>
                    <p>&nbsp;</p>
                </div>

                <div class="breadcrumb">
                    <div class="container">
                        <ol>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li class="active">Cylinders</li>
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
                                <p style="padding-left: 15px;"><a href="{{url('/cylinders/'.$cylinder->id)}}"> <b>( {{$cylinder->available}} cylinders available )</b></a></p>
                            </div>
                        </div><!-- end experiences-e item -->
                    @endforeach
                </div><!-- end experiences-e -->

                <div class="pager-wrappper clearfix">
                    <div class="pager-innner">
                        <div class="clearfix">
                            Showing {{$cylinders->count()}} cylinder{{$cylinders->count()>1?'s':''}} from {{$cylinders->total()}} cylinder{{$cylinders->total()>1?'s':''}} (Page #{{$cylinders->currentPage()}})
                        </div>
                        <div class="clearfix">
                            <nav class="pager-center">
                                <ul class="pagination">
                                    <li>
                                        <a href="{{$cylinders->previousPageUrl()}}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    @foreach(range(1, $cylinders->lastPage()) as $page_num)
                                        <li class="{{$cylinders->currentPage()==$page_num?'active':''}}"><a href="{{$cylinders->url($page_num)}}">{{$page_num}}</a></li>
                                    @endforeach
                                    <li>
                                        <a href="{{$cylinders->nextPageUrl()}}" aria-label="Next">
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
