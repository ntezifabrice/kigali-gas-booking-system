@extends('master-dashboard')
@section('title', 'Profile')
@section('breadcrumb')
    <li class="active"> My profile</li>
@endsection
@section('main')

    <div class="dashboard-content">

        <div class="row">
<form method="POST" action="{{url('/dashboard/profile')}}" enctype="multipart/form-data">
    {{csrf_field()}}
            <!-- Profile -->
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="dashboard-list-box">
                    <h4 class="gray">Profile Details</h4>
                    <div class="dashboard-list-box-static">

                        <!-- Avatar -->
                        <div class="edit-profile-photo">
                            <img src="{{$user->image_url()}}" alt="">
                            <div class="change-photo-btn">
                                <div class="photoUpload">
                                    <span><i class="fa fa-upload"></i> Upload Photo</span>
                                    <input name="avatar" type="file" class="upload" />
                                </div>
                            </div>
                        </div>

                        <!-- Details -->
                        <div class="my-profile">

                            <label>Phone Number *</label>
                            <input value="{{$user->mobile_no}}" name="mobile_no" required type="text">

                            <label>Email Address *</label>
                            <input name="email" value="{{$user->email}}" required type="email">
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
                            <label class="margin-top-0">Your Name</label>
                            <input required value="{{$user->name}}" name="name" type="text">
                            <label>Address</label>
                            <select required name="address">
                                <option value="">Select address</option>
                                <option {{$user->address=='Kicukiro'?'selected':''}} value="Kicukiro">Kicukiro</option>
                                <option {{$user->address=='Nyarugenge'?'selected':''}} value="Nyarugenge">Nyarugenge</option>
                                <option {{$user->address=='Gasabo'?'selected':''}} value="Gasabo">Gasabo</option>
                            </select>
                            <button class="button" type="submit">Save</button>
                            <a href="{{url('dashboard/password')}}" style="background: green" class="button pull-right"><i class="sl sl-icon-lock"></i> Edit password</a>
                        </div>

                    </div>
                </div>
            </div>
</form>
        </div>
    </div>

@endsection
