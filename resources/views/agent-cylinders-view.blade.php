@extends('master-dashboard')
@section('title', 'Agent View Cylinder')
@section('menu')
    {{menu('agent-dashboard', 'parts/agent-left-menu-dashboard')}}
@endsection
@section('full-menu')
    {{menu('agent-dashboard', 'parts/top-menu-dashboard')}}
@endsection
@section('breadcrumb')
    <li class="active">View Cylinder</li>
@endsection
@section('main')

    <div class="dashboard-content">

        <div class="row">

            <!-- Listings -->
            <div class="col-lg-12 col-sm-12">
                <div class="dashboard-list-box dash-list margin-top-0">

                    <div class="row">
                        @if($cylinder->count())
                            <div class="col-md-6"><!-- list start -->
                                <div class="list-box-listing">
                                    <div class="list-box-listing-img">
                                        <a href="javascript:void(0)"><img src="{{$cylinder->image_url()}}" alt=""></a>
                                    </div>
                                </div>
                            </div><!-- list end -->
                            <div class="col-md-6"><!-- list start -->
                                <div class="list-box-listing">
                                    <div class="list-box-listing-content">
                                        <div class="inner" style="padding-top: 15px">
                                            <div><span class="font600">Cylinder name: </span> {{$cylinder->name}}<br/>
                                                <span class="font600">Cylinder Size: </span> {{$cylinder->size}}<br/>
                                                <span class="font600">Cylinder Price: </span> {{$cylinder->price}}<br/>
                                                <span class="font600">Available Cylinders: </span> {{$cylinder->available}}<hr/>
                                                <hr/>
                                                <span class="font600">Last Consumer: </span> {{$consumers->last()->name}}<br/>
                                                <span class="font600">Last Booking Time: </span> {{$consumers->last()->transactions->where('cylinder_id', $cylinder->id)->last()->created_at}}<br/>
                                                <span class="font600">Last Booking Status: </span> {{$consumers->last()->transactions->where('cylinder_id', $cylinder->id)->last()->status}}<br/>
                                                <span class="font600">Total booking: </span> {{$cylinder->transactions()->count()}}
                                                <hr/>
                                                <a style="float: right" href="{{url('/dashboard/agent/cylinders')}}" class="button"><i class="sl sl-icon-reload"></i> Back to Cylinders</a>
                                                <br/>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div><!-- list end -->
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h1>Consumers who booked this cylinder</h1>
                        </div>
                        @foreach($consumers as $consumer)
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
                        @endforeach
                        <div class="col-sm-12"><!-- list start -->
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
        </div>

@endsection
