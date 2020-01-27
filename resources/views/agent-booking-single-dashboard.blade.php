@extends('master-dashboard')
@section('title', 'Agent Booking')
@section('menu')
    {{menu('agent-dashboard', 'parts/agent-left-menu-dashboard')}}
@endsection
@section('full-menu')
    {{menu('agent-dashboard', 'parts/top-menu-dashboard')}}
@endsection
@section('breadcrumb')
    <li class="active">Booking</li>
@endsection
@section('main')
    <div class="dashboard-content">

        <div class="row">

            <!-- Listings -->
            <div class="col-lg-12 col-sm-12">
                <div class="dashboard-list-box dash-list margin-top-0">

                    <div class="row">
                        @if($transaction->count())
                            <div class="col-md-6"><!-- list start -->
                                <div class="list-box-listing">
                                    <div class="list-box-listing-img">
                                        <a href="javascript:void(0)"><img src="{{$transaction->cylinder->image_url()}}" alt=""></a>
                                    </div>
                                </div>
                            </div><!-- list end -->
                            <div class="col-md-6"><!-- list start -->
                                <div class="list-box-listing">
                                    <div class="list-box-listing-content">
                                        <div class="inner" style="padding-top: 15px">
                                            <a href="javascript:void(0)"><h3>{{$transaction->cylinder->name}}</h3></a>
                                            <span>{{$transaction->cylinder->price}}</span>
                                            <div><hr/><span class="font600">Consumer name: </span> {{$transaction->user->name}}<br/>
                                                <span class="font600">Consumer Email: </span> {{$transaction->user->email}}<br/>
                                                <span class="font600">Consumer Phone: </span> {{$transaction->user->mobile_no}}<br/>
                                                <span class="font600">Consumer Address: </span> Kigali, {{$transaction->user->address}}<br/>
                                                <span class="font600">Billing Address: </span> {{$transaction->address_2}}
                                                <hr/>
                                                <span class="font600">Cylinder size: </span> {{$transaction->cylinder->size}}<br/>
                                                <span class="font600">Booking Time: </span> {{$transaction->created_at}}<br/>
                                                <span class="font600">Payment method: </span> {{$transaction->payments}}<br/>
                                                <span class="font600">Transaction Number: </span> {{$transaction->transaction_number}}<br/>
                                                <span class="font600">Booking Status: </span> {{$transaction->status}}<hr/>
                                            </div>
                                        </div>
                                        <form method="post" action="{{url('/dashboard/agent/booking/'.$transaction->id)}}">
                                            {{csrf_field()}}
                                            @if($transaction->status=='Pending')
                                                <input type="hidden" name="status" value="Active">
                                                <button type="submit" class="button green" style="background: green"><i class="sl sl-icon-check"></i> Mark as Active</button>
                                            @endif
                                            <a style="float: right" href="{{url('/dashboard/agent/consumers/'.$transaction->user->id)}}" class="button"><i class="sl sl-icon-eye"></i> View Consumer</a>
                                        </form>
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
                </div>
            </div>
        </div>

@endsection
