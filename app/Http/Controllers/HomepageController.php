<?php

namespace App\Http\Controllers;

use App\Cylinder;
use App\PasswordReset;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomepageController extends Controller
{
    public function index()
    {
        $cylinders=Cylinder::where('available', '>', 0)->orderBy('created_at', 'DESC')->take(8)->get();

        $agents = User::whereHas('role', function ($query){
            $query->whereName('agent');
        })->whereHas('cylinders', function ($query){
            $query->where('available', '>', 0);
        })->orderBy('created_at', 'DESC')->take(8)->get();

        return view('welcome', compact('cylinders', 'agents'));
    }
    public function cylinders(){
        $cylinders=Cylinder::where('available', '>', 0)->orderBy('created_at', 'DESC')->paginate(8);

        return view('cylinders', compact('cylinders'));
    }
    public function agents(){
        $agents = User::whereHas('role', function ($query){
            $query->whereName('agent');
        })->whereHas('cylinders', function ($query){
            $query->where('available', '>', 0);
        })->orderBy('created_at', 'DESC')->paginate(8);

        return view('agents', compact('agents'));
    }
    public function singleAgent(Request $request){
        $agent = User::whereHas('role', function ($query){
            $query->whereName('agent');
        })->whereHas('cylinders', function ($query){
            $query->where('available', '>', 0);
        })->orderBy('created_at', 'DESC')->find($request->id);

        if(!$agent){
            return redirect('/');
        }

        return view('agent', compact('agent'));
    }
    public function resetPassword(Request $request){
        $token=$request->token;
        $email=$request->email;
        if($email && $token && (!Auth::user()) ){
            $user = PasswordReset::where('email', $request->email)->orderBy('created_at', 'DESC')->first();
            if($user && Hash::check($token, $user->token)){
                $date = new \DateTime($user->updated_at);
                $date->modify('+2 hours');
                $date_to_reset = $date->format('Y-m-d H:i:s');
                $current_date=(new \DateTime())->format('Y-m-d H:i:s');
                if($current_date <= $date_to_reset){
                    return view('password-reset', compact('token', 'email'));
                }
            }
        }
        return redirect('/');
    }
    public function postResetPassword(Request $request){
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'string', 'exists:password_resets,email', 'exists:users,email'],
            'password' => ['required'],
            'password_confirmation' => ['same:password'],
        ]);
        if(!Auth::user() ){
            $guest = PasswordReset::where('email', $request->email)->orderBy('created_at', 'DESC')->first();
            if($guest && Hash::check($request->token, $guest->token)){
                $date = new \DateTime($guest->updated_at);
                $date->modify('+2 hours');
                $date_to_reset = $date->format('Y-m-d H:i:s');
                $current_date=(new \DateTime())->format('Y-m-d H:i:s');
                if($current_date <= $date_to_reset){
                    $user = User::where('email', $request->email)->first();
                    if($user){
                        $user->password = Hash::make($request->password);
                        $user->save();
                        $user->refresh();
                        PasswordReset::where('email', $request->email)->delete();
                        Auth::guard()->login($user, true);
                        return redirect('/dashboard');
                    }
                }
            }
        }
        return redirect('/');
    }
    public function searchFormData(){
        $cylinders=Cylinder::where('available', '>', 0)->with('user')->orderBy('created_at', 'DESC')->get();
        $search_results = [];
        foreach ($cylinders as $cylinder){
            $search_results[] = (object) array(
                'name' => $cylinder->name,
                'size' => $cylinder->size,
                'price' => $cylinder->price,
                'available' => $cylinder->available,
                'agent_name' => $cylinder->user->name,
                'agent_email' => $cylinder->user->email,
                'agent_address' => $cylinder->user->address,
                'agent_phone' => $cylinder->user->mobile_no,
                'url' => url('booking/' . $cylinder->id)
            );
        }
            print_r(json_encode($search_results));
    }
}
