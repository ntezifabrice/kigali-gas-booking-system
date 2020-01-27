@extends('master-dashboard')
@section('title', 'Agent Booking')
@section('menu')
    {{menu('agent-dashboard', 'parts/agent-left-menu-dashboard')}}
@endsection
@section('full-menu')
    {{menu('agent-dashboard', 'parts/top-menu-dashboard')}}
@endsection
@section('breadcrumb')
    <li class="active">@if(request()->get('status')) {{ucfirst(request()->get('status'))}} @else All @endif Booking</li>
@endsection
@section('main')
    <div class="dashboard-content">

        <div class="row">

            <!-- Listings -->
            <div class="col-lg-12 col-sm-12">
                <div class="dashboard-list-box dash-list margin-top-0">

                    <div class="row">
                        @forelse($transactions as $transaction)
                            <div class="col-sm-4"><!-- list start -->
                                <div class="list-box-listing">
                                    <div class="list-box-listing-img">
                                        <a href="{{url('/dashboard/agent/booking/'.$transaction->id)}}"><img src="{{$transaction->cylinder->image_url()}}" alt=""></a>
                                    </div>
                                    <div class="list-box-listing-content">
                                        <div class="inner">
                                            <a href="{{url('/dashboard/agent/booking/'.$transaction->id)}}"><h3>{{$transaction->cylinder->name}}</h3></a>
                                            <span>{{$transaction->cylinder->price}}</span>
                                            <p><span class="font600">Consumer: </span> {{$transaction->user->name}}<br/>
                                                <span class="font600">Cylinder: </span> {{$transaction->cylinder->size}}<br/>
                                                <span class="font600">Status: </span> {{$transaction->status}}<br/>
                                            </p>
                                        </div>
                                        <a href="{{url('/dashboard/agent/booking/'.$transaction->id)}}" class="button gray"><i class="sl sl-icon-eye"></i> View</a>
                                    </div>
                                </div>
                            </div><!-- list end -->
                        @empty
                            <div class="col-sm-12"><!-- list start -->
                                <div class="list-box-listing">
                                    <div class="list-box-listing-content">
                                        <div class="inner" style="padding-top: 20px">
                                            <a href="{{url('/dashboard/agent/booking')}}"><h3>No data available, Click to view all</h3></a>
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
                                            <li><a href="{{$transactions->previousPageUrl()}}"><i class="sl sl-icon-arrow-left"></i></a></li>
                                            @foreach(range(1, $transactions->lastPage()) as $page_num)
                                                <li><a class="{{$transactions->currentPage()==$page_num?'current-page':''}}" href="{{$transactions->url($page_num)}}">{{$page_num}}</a></li>
                                            @endforeach
                                            <li><a href="{{$transactions->nextPageUrl()}}"><i class="sl sl-icon-arrow-right"></i></a></li>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- Pagination / End -->
                    </div>
                </div>
            </div>
        </div>

@endsection
