@extends('master-dashboard')
@section('title', 'Agent Consumer')
@section('menu')
    {{menu('agent-dashboard', 'parts/agent-left-menu-dashboard')}}
@endsection
@section('full-menu')
    {{menu('agent-dashboard', 'parts/top-menu-dashboard')}}
@endsection
@section('breadcrumb')
    <li class="active">Consumer</li>
@endsection
@section('main')
    <div class="dashboard-content">

        <div class="row">

            <!-- Listings -->
            <div class="col-lg-12 col-sm-12">
                <div class="dashboard-list-box dash-list margin-top-0">

                    <div class="row">
                        @if($consumer->count())
                            <div class="col-md-6"><!-- list start -->
                                <div class="list-box-listing">
                                    <div class="list-box-listing-img">
                                        <a href="javascript:void(0)"><img src="{{$consumer->image_url()}}" alt=""></a>
                                    </div>
                                </div>
                            </div><!-- list end -->
                            <div class="col-md-6"><!-- list start -->
                                <div class="list-box-listing">
                                    <div class="list-box-listing-content">
                                        <div class="inner" style="padding-top: 15px">
                                            <div><span class="font600">Consumer name: </span> {{$consumer->name}}<br/>
                                                <span class="font600">Consumer Email: </span> {{$consumer->email}}<br/>
                                                <span class="font600">Consumer Phone: </span> {{$consumer->mobile_no}}<br/>
                                                <span class="font600">Consumer Address: </span> Kigali, {{$consumer->address}}<hr/>
                                                <span class="font600">Billing Address: </span> {{$consumer->transactions->last()->address_2}}<br/>
                                                <span class="font600">Sector: </span> {{$consumer->transactions->last()->sector}}<br/>
                                                <span class="font600">House number: </span> {{$consumer->transactions->last()->house}}<br/>
                                                <span class="font600">Street number: </span> {{$consumer->transactions->last()->street}}
                                                <hr/>
                                                <span class="font600">Last Cylinder: </span> {{$consumer->transactions()->orderBy('id','DESC')->first()->cylinder->name}}<br/>
                                                <span class="font600">Last Booking Time: </span> {{$consumer->transactions()->orderBy('id','DESC')->first()->created_at}}<br/>
                                                <span class="font600">Last Booking Status: </span> {{$consumer->transactions()->orderBy('id','DESC')->first()->status}}<br/>
                                                <span class="font600">Total booking: </span> {{$consumer->transactions()->whereIn('id', $transactions->pluck('id'))->get()->count()}}
                                                <hr/>
                                                <a style="float: right" href="{{url('/dashboard/agent/consumers')}}" class="button"><i class="sl sl-icon-reload"></i> Back to Consumers</a>
                                                <br/>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div><!-- list end -->
                        @else
                            <div class="col-sm-12"><!-- list start -->
                                <div class="list-box-listing">
                                    <div class="list-box-listing-content">
                                        <div class="inner" style="padding-top: 20px">
                                            <a href="{{url('/dashboard/agent/booking')}}"><h3>No data available, Click to view all</h3></a>
                                        </div>
                                    </div>
                                </div><!-- list end -->

                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h1>Consumer's booking from us</h1>
                        </div>
                        @foreach($consumer_transactions as $transaction)
                            <div class="col-sm-4"><!-- list start -->
                                <div class="list-box-listing">
                                    <div class="list-box-listing-img">
                                        <a href="{{url('/dashboard/agent/booking/'.$transaction->id)}}"><img src="{{$transaction->cylinder->image_url()}}" alt=""></a>
                                    </div>
                                    <div class="list-box-listing-content">
                                        <div class="inner">
                                            <a href="{{url('/dashboard/agent/booking/'.$transaction->id)}}"><h3>{{$transaction->cylinder->name}}</h3></a>
                                            <span>{{$transaction->cylinder->price}}</span>
                                            <p><span class="font600">Time: </span> {{$transaction->created_at}}<br/>
                                                <span class="font600">Cylinder: </span> {{$transaction->cylinder->size}}<br/>
                                                <span class="font600">Status: </span> {{$transaction->status}}<br/>
                                            </p>
                                        </div>
                                        <a href="{{url('/dashboard/agent/booking/'.$transaction->id)}}" class="button gray"><i class="sl sl-icon-eye"></i> View</a>
                                    </div>
                                </div>
                            </div><!-- list end -->
                        @endforeach
                            <div class="col-sm-12"><!-- list start -->
                                <!-- Pagination -->
                                <div class="clearfix"></div>
                                <div class="col-sm-12 pagination-container">
                                    <nav class="pagination">
                                        <ul>
                                            <li><a href="{{$consumer_transactions->previousPageUrl()}}"><i class="sl sl-icon-arrow-left"></i></a></li>
                                            @foreach(range(1, $consumer_transactions->lastPage()) as $page_num)
                                                <li><a class="{{$consumer_transactions->currentPage()==$page_num?'current-page':''}}" href="{{$consumer_transactions->url($page_num)}}">{{$page_num}}</a></li>
                                            @endforeach
                                            <li><a href="{{$consumer_transactions->nextPageUrl()}}"><i class="sl sl-icon-arrow-right"></i></a></li>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- Pagination / End -->
                            </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
