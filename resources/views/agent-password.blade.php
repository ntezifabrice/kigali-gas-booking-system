@extends('master-dashboard')
@section('title', 'Change Password')
@section('breadcrumb')<li class="active">Change Password</li>@endsection
@section('menu')
    {{menu('agent-dashboard', 'parts/agent-left-menu-dashboard')}}
@endsection
@section('full-menu')
    {{menu('agent-dashboard', 'parts/top-menu-dashboard')}}
@endsection
@section('main')

    <div class="dashboard-content">
        <div class="row">
            <!-- Change Password -->
            <div class="col-lg-8 col-lg-offset-2 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    <div class="dashboard-list-box-static">
                        <form method="post" action="{{url('/dashboard/agent/password')}}">
                        {{csrf_field()}}
                        <!-- Change Password -->
                            <div class="my-profile">
                                <label class="margin-top-0">Current Password</label>
                                <input name="password" required type="password">

                                <label>New Password</label>
                                <input name="new_password" required type="password">

                                <label>Confirm New Password</label>
                                <input name="new_password_confirmation" required type="password">

                                <button type="submit" class="button margin-top-15">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
