@extends('master-dashboard')
@section('title', 'Booking dashboard')
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
                                        <a href="{{url('/booking/'.$transaction->cylinder->id)}}"><img src="{{$transaction->cylinder->image_url()}}" alt=""></a>
                                    </div>
                                </div>
                            </div><!-- list end -->
                            <div class="col-md-6"><!-- list start -->
                                <div class="list-box-listing">
                                    <div class="list-box-listing-content">
                                        <div class="inner" style="padding-top: 15px">
                                            <a href="{{url('/booking/'.$transaction->cylinder->id)}}"><h3>{{$transaction->cylinder->name}}</h3></a>
                                            <span>{{$transaction->cylinder->price}}</span>
                                            <div><hr/><span class="font600">Agent name: </span> {{$transaction->cylinder->user->name}}<br/>
                                                <span class="font600">Agent Email: </span> {{$transaction->cylinder->user->email}}<br/>
                                                <span class="font600">Agent Phone: </span> {{$transaction->cylinder->user->mobile_no}}<br/>
                                                <span class="font600">Billing Address: </span> Kigali, {{$transaction->user->address}}
                                                <hr/>
                                                <span class="font600">Cylinder size: </span> {{$transaction->cylinder->size}}<br/>
                                                <span class="font600">Booking Time: </span> {{$transaction->created_at}}<br/>
                                                <span class="font600">Payment method: </span> {{$transaction->payments}}<hr/>
                                                <span class="font600">Booking Status: </span> {{$transaction->status}}<hr/>
                                            </div>
                                        </div>
                                        <form method="post" action="{{url('/dashboard/booking/'.$transaction->id)}}">
                                            {{csrf_field()}}
                                        @if($transaction->status=='Pending')
                                            <input type="hidden" name="status" value="Cancelled">
                                            <button type="submit" class="button red" style="background: red"><i class="sl sl-icon-close"></i> Mark as Cancelled</button>
                                        @endif
                                        @if($transaction->status=='Cancelled')
                                            <input type="hidden" name="status" value="Pending">
                                            <button type="submit" class="button blue" style="background: orange"><i class="sl sl-icon-close"></i> Mark as Pending</button>
                                        @endif
                                        @if($transaction->status=='Active')
                                            <input type="hidden" name="status" value="Finished">
                                            <button type="submit" class="button green" style="background: green"><i class="sl sl-icon-check"></i> Mark as Finished</button>
                                            @endif
                                            <a style="float: right" href="{{url('/booking/'.$transaction->cylinder->id)}}" class="button"><i class="sl sl-icon-basket"></i> Book it again</a>
                                        </form>
                                    </div>
                                </div>
                            </div><!-- list end -->
                        @else
                            <div class="col-sm-12"><!-- list start -->
                                <div class="list-box-listing">
                                    <div class="list-box-listing-content">
                                        <div class="inner" style="padding-top: 20px">
                                            <a href="{{url('/dashboard/booking')}}"><h3>No data available, Click to view all</h3></a>
                                        </div>
                                    </div>
                                </div><!-- list end -->
                        @endif

                            </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
