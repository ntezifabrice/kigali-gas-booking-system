@extends('master-dashboard')
@section('title', 'Agent Consumers')
@section('menu')
    {{menu('agent-dashboard', 'parts/agent-left-menu-dashboard')}}
@endsection
@section('full-menu')
    {{menu('agent-dashboard', 'parts/top-menu-dashboard')}}
@endsection
@section('breadcrumb')
    <li class="active">Consumers</li>
@endsection
@section('main')
    <div class="dashboard-content">

        <div class="row">

            <!-- Listings -->
            <div class="col-lg-12 col-sm-12">
                <div class="dashboard-list-box dash-list margin-top-0">

                    <div class="row">
                        @forelse($consumers as $consumer)
                            <div class="col-sm-4"><!-- list start -->
                                <div class="list-box-listing">
                                    <div class="list-box-listing-img">
                                        <a href="{{url('/dashboard/agent/consumers/'.$consumer->id)}}"><img src="{{$consumer->image_url()}}" alt=""></a>
                                    </div>
                                    <div class="list-box-listing-content">
                                        <div class="inner">
                                            <p><span class="font600">Name: </span> {{$consumer->name}}<br/>
                                                <span class="font600">Phone: </span> {{$consumer->mobile_no}}<br/>
                                                <span class="font600">Address: </span> Kigali, {{$consumer->address}}
                                            </p>
                                            <a href="{{url('/dashboard/agent/consumers/'.$consumer->id)}}" class="button gray"><i class="sl sl-icon-eye"></i> View Consumer</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- list end -->
                        @empty
                            <div class="col-sm-12"><!-- list start -->
                                <div class="list-box-listing">
                                    <div class="list-box-listing-content">
                                        <div class="inner" style="padding-top: 20px">
                                            <a href="{{url('/dashboard/agent/consumers')}}"><h3>No data available</h3></a>
                                        </div>
                                    </div>
                                </div><!-- list end -->
                            </div>
                        @endforelse
                            <!-- Pagination -->
                                <div class="clearfix"></div>
                                <div class="col-sm-12 pagination-container">
                                    <nav class="pagination">
                                        <ul>
                                            <li><a href="{{$consumers->previousPageUrl()}}"><i class="sl sl-icon-arrow-left"></i></a></li>
                                            @foreach(range(1, $consumers->lastPage()) as $page_num)
                                                <li><a class="{{$consumers->currentPage()==$page_num?'current-page':''}}" href="{{$consumers->url($page_num)}}">{{$page_num}}</a></li>
                                            @endforeach
                                            <li><a href="{{$consumers->nextPageUrl()}}"><i class="sl sl-icon-arrow-right"></i></a></li>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- Pagination / End -->
                    </div>
                </div>
            </div>
        </div>

@endsection
