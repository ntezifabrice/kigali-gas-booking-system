@extends('master-dashboard')
@section('title', 'Agent Cylinders')
@section('menu')
    {{menu('agent-dashboard', 'parts/agent-left-menu-dashboard')}}
@endsection
@section('full-menu')
    {{menu('agent-dashboard', 'parts/top-menu-dashboard')}}
@endsection
@section('breadcrumb')
    <li class="active">Cylinders</li>
@endsection
@section('main')
    <div class="dashboard-content">

        <div class="row">

            <!-- Listings -->
            <div class="col-lg-12 col-sm-12">
                <div class="dashboard-list-box dash-list margin-top-0">

                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <a href="{{url('/dashboard/agent/cylinders/add')}}" class="button blue" style="margin-bottom: 1em;font-size: 20px;padding:15px;background: green"><i class="sl sl-icon-plus"></i> Add New Cylinder</a>
                        </div>
                        @forelse($cylinders as $cylinder)
                            <div class="col-sm-4"><!-- list start -->
                                <div class="list-box-listing">
                                    <div class="list-box-listing-img">
                                        <a href="{{url('/dashboard/agent/cylinders/'.$cylinder->id)}}"><img src="{{$cylinder->image_url()}}" alt=""></a>
                                    </div>
                                    <div class="list-box-listing-content">
                                        <div class="inner">
                                            <p><span class="font600">Name: </span> {{$cylinder->name}}<br/>
                                                <span class="font600">Price: </span> {{$cylinder->price}}<br/>
                                                <span class="font600">Size: </span> {{$cylinder->size}}<br/>
                                                <span class="font600">Booking count: </span> {{$cylinder->transactions()->count()}}<br/>
                                                <span class="font600">Available: </span> {{$cylinder->available}}
                                            </p>
                                            @if($cylinder->transactions()->count())
                                                <a href="{{url('/dashboard/agent/cylinders/'.$cylinder->id)}}" class="button blue"><i class="sl sl-icon-eye"></i> View</a>
                                            @else
                                            <form method="POST" action="{{url('/dashboard/agent/cylinders/'.$cylinder->id)}}">
                                                <a href="{{url('/dashboard/agent/cylinders/'.$cylinder->id.'/edit')}}" class="button blue"><i class="sl sl-icon-pencil"></i> Edit</a>
                                                {{csrf_field()}}
                                                @method('DELETE')
                                                <button class="button red pull-right" style="background: red"><i class="sl sl-icon-close"></i> Delete</button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div><!-- list end -->
                        @empty
                        <div class="col-sm-12"><!-- list start -->
                            <div class="list-box-listing">
                                <div class="list-box-listing-content">
                                    <div class="inner" style="padding-top: 20px">
                                        <a href="{{url('/dashboard/agent/Cylinders')}}"><h3>No cylinders available</h3></a>
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
                                        <li><a href="{{$cylinders->previousPageUrl()}}"><i class="sl sl-icon-arrow-left"></i></a></li>
                                        @foreach(range(1, $cylinders->lastPage()) as $page_num)
                                            <li><a class="{{$cylinders->currentPage()==$page_num?'current-page':''}}" href="{{$cylinders->url($page_num)}}">{{$page_num}}</a></li>
                                        @endforeach
                                        <li><a href="{{$cylinders->nextPageUrl()}}"><i class="sl sl-icon-arrow-right"></i></a></li>
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
