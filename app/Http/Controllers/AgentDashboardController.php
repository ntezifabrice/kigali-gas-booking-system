<?php

namespace App\Http\Controllers;

use App\Cylinder;
use App\Mail\NotifyConsumerIfBookingAccepted;
use App\Rules\MatchOldPassword;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AgentDashboardController extends Controller
{
    public function checkUser(&$user=null, $redirect_user='/dashboard', $redirect_admin='/admin', $redirect_guest='/'){
        if((($user = Auth::user()) && ($user->hasRole('admin')))){
            return ($redirect_admin);
        }elseif(!$user){
            return ($redirect_guest);
        }elseif ($user->hasRole('consumer')){
            return ($redirect_user);
        }
        return false;
    }
    public function index(){
        if($return = $this->checkUser($user)){
            return redirect($return);
        }
        return view('agent-dashboard', compact('user'));
    }
    public function profile(){
        if($return = $this->checkUser($user, '/dashboard/profile', '/admin/profile')){
            return redirect($return);
        }
        return view('agent-profile', compact('user'));
    }
    public function postProfile(Request $request)
    {
        if($return = $this->checkUser($user, '/dashboard/profile', '/admin/profile')){
            return redirect($return);
        }
        if($request->has('avatar')){
            $image = $request->avatar->store('public/users/'.date('FY'));
            if($user->avatar && !strpos($user->avatar, 'default')){
                Storage::delete('public/'.$user->avatar);
            }
            $user->avatar = substr($image,7);
        }
        $user->mobile_no = $request->mobile_no;
        $user->address = $request->address;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect('/dashboard/agent/profile');
    }
    public function password(){
        if($return = $this->checkUser($user, '/dashboard/password', '/admin/profile')){
            return redirect($return);
        }
        return view('agent-password', compact('user'));
    }
    public function postPassword(Request $request)
    {
        if($return = $this->checkUser($user, '/dashboard/password', '/admin/profile')){
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
        if($return = $this->checkUser($user, '/dashboard/booking', '/admin', '/cylinders')){
            return redirect($return);
        }
        $transactions = $user->transactionsForAgentFunction();
        if(Input::get('status')){
            $transactions = $transactions->where('status', ucfirst(Input::get('status')));
        }
        $transactions = $transactions->orderBy('created_at', 'DESC')->paginate(12);

        return view('agent-booking-dashboard', compact('transactions', 'user'));
    }
    public function singleBooking(Request $request){
        if($return = $this->checkUser($user, '/dashboard/booking', '/admin', '/cylinders')){
            return redirect($return);
        }
        $transaction = $user->transactionsForAgentFunction()->orderBy('created_at', 'DESC')->find($request->id);

        return view('agent-booking-single-dashboard', compact('transaction', 'user'));
    }
    public function postSingleBooking(Request $request){
        if($return = $this->checkUser($user, '/dashboard/booking', '/admin', '/cylinders')){
            return redirect($return);
        }
        $request->validate([
            'status' => ['required', Rule::in(['Active'])]
        ]);
        $transaction=Transaction::find($request->id);
        $transaction->status=$request->status;
        $transaction->save();
        Mail::to($transaction->user)->queue(new NotifyConsumerIfBookingAccepted($transaction));
        return redirect()->back();
    }
    public function consumers(){
        if($return = $this->checkUser($user, '/dashboard/profile', '/admin', '/agents')){
            return redirect($return);
        }
        $transactions = $user->transactionsForAgentFunction()->orderBy('created_at', 'DESC')->get();
        $consumers = User::whereIn('id', $transactions->pluck('user_id'))->orderBy('created_at', 'DESC')->paginate(12);

        return view('agent-consumers-dashboard', compact('transactions', 'user', 'consumers'));
    }
    public function singleConsumer(Request $request){
        if($return = $this->checkUser($user, '/dashboard/profile', '/admin/profile', '/agents')){
            return redirect($return);
        }
        $transactions = $user->transactionsForAgentFunction()->orderBy('created_at', 'DESC')->get();
        $consumer = User::whereIn('id', $transactions->pluck('user_id'))->find($request->id);
        $consumer_transactions=$consumer->transactions()->orderBy('created_at', 'DESC')->paginate(12);

        return view('agent-consumers-single-dashboard', compact('transactions', 'user', 'consumer', 'consumer_transactions'));
    }
    public function cylinders(){
        if($return = $this->checkUser($user, '/dashboard/booking', '/admin', '/cylinders')){
            return redirect($return);
        }
        $cylinders = $user->cylinders()->orderBy('created_at', 'DESC')->paginate(12);
        return view('agent-cylinders-dashboard', compact('cylinders', 'user'));
    }
    public function addCylinder(){
        if($return = $this->checkUser($user, '/dashboard/booking', '/admin', '/cylinders')){
            return redirect($return);
        }
        return view('agent-cylinders-create', compact('user'));
    }
    public function postAddCylinder(Request $request){
        if($return = $this->checkUser($user, '/dashboard/booking', '/admin', '/cylinders')){
            return redirect($return);
        }
        $request->validate([
            'name' => ['required', 'string', 'unique:cylinders'],
            'size' => ['required', 'string', 'exists:cylinder_types,name'],
            'price' => ['required', 'string', 'max:255'],
            'available' => ['required', 'integer'],
            'image' => ['required', 'image'],
        ]);
        $image = $request->image->store('public/cylinders/'.date('FY'));
        Cylinder::create([
            'name' => $request->name,
            'size' => $request->size,
            'price' => $request->price,
            'available' => $request->available,
            'image' => substr($image,7),
            'user_id' => $user->id
        ]);
        return redirect('/dashboard/agent/cylinders');
    }
    public function singleCylinder(Request $request){
        if($return = $this->checkUser($user, '/dashboard/booking', '/admin', '/cylinders')){
            return redirect($return);
        }
        $cylinder = $user->cylinders()->find($request->id);
        if(!$cylinder->transactions()->count()){
            return redirect('/dashboard/agent/cylinders/'.$request->id.'/edit');
        }
        $consumers=User::whereIn('id', $cylinder->transactions()->unique('user_id')->pluck('user_id'))->orderBy('created_at', 'DESC')->paginate(12);

        return view('agent-cylinders-view', compact('user', 'cylinder', 'consumers'));
    }
    public function editSingleCylinder(Request $request){
        if($return = $this->checkUser($user, '/dashboard/booking', '/admin', '/cylinders')){
            return redirect($return);
        }
        $cylinder = $user->cylinders()->find($request->id);
        if($cylinder->transactions()->count()){
            return redirect('/dashboard/agent/cylinders/'.$request->id);
        }
        return view('agent-cylinders-edit', compact('user', 'cylinder'));
    }
    public function postSingleCylinder(Request $request){
        if($return = $this->checkUser($user, '/dashboard/booking', '/admin', '/cylinders')){
            return redirect($return);
        }
        $cylinder = $user->cylinders()->find($request->id);
        $request->validate([
            'name' => ['required', 'string', Rule::unique('cylinders')->ignore($cylinder->name, 'name')],
            'size' => ['required', 'string', 'exists:cylinder_types,name'],
            'price' => ['required', 'string', 'max:255'],
            'available' => ['required', 'integer'],
            'image' => ['sometimes', 'required', 'image'],
        ]);
        if($request->has('image')){
            $image = $request->image->store('public/cylinders/'.date('FY'));
            if($cylinder->image){
                Storage::delete('public/'.$cylinder->image);
            }
            $cylinder->image = substr($image,7);
        }
        $cylinder->name = $request->name;
        $cylinder->size = $request->size;
        $cylinder->price = $request->price;
        $cylinder->available = $request->available;
        $cylinder->save();
        return redirect('/dashboard/agent/cylinders');
    }
    public function deleteSingleCylinder(Request $request){
        if($return = $this->checkUser($user, '/dashboard/booking', '/admin', '/cylinders')){
            return redirect($return);
        }
        $cylinder = $user->cylinders()->find($request->id);
        if(!$cylinder->transactions()->count()) {
            if ($cylinder->image) {
                Storage::delete('public/' . $cylinder->image);
            }
            $cylinder->delete();
        }
        return redirect('/dashboard/agent/cylinders');
    }
}
