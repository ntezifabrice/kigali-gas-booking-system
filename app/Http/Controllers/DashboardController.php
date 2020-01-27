<?php

namespace App\Http\Controllers;

use App\Rules\MatchOldPassword;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{

    public function checkUser(&$user=null, $redirect_user='/dashboard/agent', $redirect_admin='/admin', $redirect_guest='/'){
        if((($user = Auth::user()) && ($user->hasRole('admin')))){
            return ($redirect_admin);
        }elseif(!$user){
            return ($redirect_guest);
        }elseif ($user->hasRole('agent')){
            return ($redirect_user);
        }
        return false;
    }
    public function index(){
        if($return = $this->checkUser($user)){
            return redirect($return);
        }
        return view('dashboard', compact('user'));
    }
    public function profile(){
        if($return = $this->checkUser($user, '/dashboard/agent/profile', '/admin/profile')){
            return redirect($return);
        }
        return view('profile', compact('user'));
    }
    public function postProfile(Request $request)
    {
        if($return = $this->checkUser($user, '/dashboard/agent/profile', '/admin/profile')){
            return redirect($return);
        }
        if($request->has('avatar')){
            $image = $request->avatar->store('public/users/'.date('FY'));
            if($user->avatar){
                Storage::delete('public/'.$user->avatar);
            }
            $user->avatar = substr($image,7);
        }
        $user->mobile_no = $request->mobile_no;
        $user->address = $request->address;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect('/dashboard/profile');
    }
    public function password(){
        if($return = $this->checkUser($user, '/dashboard/agent/password', '/admin/profile')){
            return redirect($return);
        }
        return view('password', compact('user'));
    }
    public function postPassword(Request $request)
    {
        if($return = $this->checkUser($user, '/dashboard/agent/password', '/admin/profile')){
            return redirect($return);
        }
        $request->validate([
            'password' => ['required', new MatchOldPassword()],
            'new_password' => ['required'],
            'new_password_confirmation' => ['same:new_password'],
        ]);
        User::find($user->id)->update(['password'=> Hash::make($request->new_password)]);
        return redirect('/dashboard/agent/password');
    }
    public function booking(){
        if($return = $this->checkUser($user, '/dashboard/agent/booking', '/admin')){
            return redirect($return);
        }
        $transactions=Transaction::with('user', 'cylinder')->whereHas('user', function ($query) use ($user) {
            $query->where('id', $user->id);
        });
        if(Input::get('status')){
            $transactions = $transactions->where('status', ucfirst(Input::get('status')));
        }
        $transactions = $transactions->orderBy('created_at', 'DESC')->paginate(12);

        return view('booking-dashboard', compact('transactions', 'user'));
    }
    public function singleBooking(Request $request){
        if($return = $this->checkUser($user, '/dashboard/agent/cylinders', '/admin', '/cylinders')){
            return redirect($return);
        }
        $transaction=Transaction::with('user', 'cylinder')->whereHas('user', function ($query) use ($user) {
            $query->where('id', $user->id);
        })->find($request->id);

        return view('booking-single-dashboard', compact('transaction', 'user'));
    }
    public function postSingleBooking(Request $request){
        if($return = $this->checkUser($user, '/dashboard/agent/cylinders', '/admin', '/cylinders')){
            return redirect($return);
        }
        $request->validate([
            'status' => ['required', Rule::in(['Pending', 'Finished', 'Cancelled'])]
        ]);
        $transaction=Transaction::find($request->id);
        $transaction->status=$request->status;
        $transaction->save();
        return redirect()->back();

    }
}
