@extends('master-dashboard')
@section('title', 'Agent Cylinder')
@section('menu')
    {{menu('agent-dashboard', 'parts/agent-left-menu-dashboard')}}
@endsection
@section('full-menu')
    {{menu('agent-dashboard', 'parts/top-menu-dashboard')}}
@endsection
@section('breadcrumb')
    <li class="active">Add Cylinder</li>
@endsection
@section('main')

    <div class="dashboard-content">

        <div class="row">
            <form method="POST" action="{{url('/dashboard/agent/cylinders/add')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <!-- Profile -->
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="dashboard-list-box">
                        <h4 class="gray">Cylinder Details</h4>
                        <div class="dashboard-list-box-static">

                            <!-- Avatar -->
                            <div class="edit-profile-photo">
                                <img src="{{url('/storage/cylinders/default.png')}}" alt="">
                                <div class="change-photo-btn">
                                    <div class="photoUpload">
                                        <span><i class="fa fa-upload"></i> Choose Picture</span>
                                        <input required name="image" type="file" class="upload" />
                                    </div>
                                </div>
                            </div>

                            <!-- Details -->
                            <div class="my-profile">

                                <label>Name *</label>
                                <input value="" name="name" required type="text">

                                <label>Size *</label>
                                <select name="size" required>
                                    <option value="">Choose size</option>
                                    @foreach(\App\CylinderType::all() as $size)
                                        <option value="{{$size->name}}">{{$size->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Change Password -->
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="dashboard-list-box margin-top-0">
                        <h4 class="gray">Other Details</h4>
                        <div class="dashboard-list-box-static">
                            <!-- Change Password -->
                            <div class="my-profile">
                                <label class="margin-top-0">Price</label>
                                <input required value="" placeholder="ex: 500 RWF" name="price" type="text">

                                <label class="margin-top-0"># Available</label>
                                <input required value="0" name="available" type="number" min="1">
                                <button class="button" type="submit">Save Cylinder</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection
