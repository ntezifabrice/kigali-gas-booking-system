<?php

namespace App\Http\Controllers;

use App\Mail\NotifyAgentIfCylinderBooked;
use App\Mail\NotifyConsumerIfBookingAccepted;
use App\Transaction;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;
use App\Cylinder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function create($cylinder_id)
    {
        $cylinder=Cylinder::where('id', $cylinder_id)->where('available', '>', 0)->with('user')->first();
        if(!$cylinder){
            return redirect('/cylinders');
        }
        if(!($user = Auth::user()) || !($user->hasRole('consumer')))
        {
            Auth::logout();
            $user = (object) [
                'name' => '',
                'email' => '',
                'mobile_no' => '',
                'address' => '',
                'address_2' => '',
                'payments' => '',
                'transaction_number' => '',
                'sector' => '',
                'street' => '',
                'house' => ''
            ];
        }else{
            if($transaction=Transaction::where('user_id',$user->id)->orderBy('created_at', 'desc')->first()){
                $user['address_2']=$transaction->address_2;
                $user['payments']=$transaction->payments;
                $user['transaction_number']=$transaction->transaction_number;
                $user['sector']=$transaction->sector;
                $user['street']=$transaction->street;
                $user['house']=$transaction->house;
            }
        }
        return view('booking', compact('cylinder', 'user'));
    }
    public function store(Request $request)
    {
        $consumer_paid=false;
        $user = Auth::user();
        $cylinder=Cylinder::find($request->cylinder_id);
        $user->mobile_no = $request->mobile_no;
        $user->address = $request->address;
        $transaction = new Transaction([
            'cylinder_id' => $request->cylinder_id,
            'address_2' => $request->address_2,
            'sector' => $request->sector,
            'street' => $request->street,
            'house' => $request->house,
            'payments' => $request->payments,
            'transaction_number' => $request->transaction_number
        ]);
        if($request->has('paypal_payer_id')){
            if($request->paypal_payer_id){
                $transaction->status = 'Active';
                $transaction->save();
                $consumer_paid=true;
            }
        }elseif ($request->has('stripeToken')){
        $stripe = Stripe::make('sk_test_qfMi1k89CgM1s8eDtkOTLyRK002M1MfVTW');
        $stripe = $stripe->charges()->create([
            'source' => $request->get('stripeToken'),
            'currency' => 'RWF',
            'amount' => intval($cylinder->price)
        ]);
        if($stripe['status']=="succeeded"){
            $transaction->status = 'Active';
            $transaction->save();
            $consumer_paid=true;
        }
    }
        $user->save();
        $user->transactions()->save($transaction);
        $cylinder=Cylinder::find($request->cylinder_id);
        $cylinder->available = ((int) $cylinder->available) - 1;
        $cylinder->save();
        $transaction=Transaction::where('user_id',$user->id)->with('user')->orderBy('created_at', 'desc')->first();
        if($consumer_paid){
            Mail::to($cylinder->user)->queue(new NotifyAgentIfCylinderBooked($transaction));
            Mail::to($transaction->user)->queue(new NotifyConsumerIfBookingAccepted($transaction));
        }
        return redirect()->route('confirmation', $transaction->id);
    }
    public function confirmation($transaction_id)
    {
        if($return = (new DashboardController())->checkUser($user, '/dashboard/agent', '/admin', '/')){
            return redirect($return);
        }
        $transaction=Transaction::with('user', 'cylinder.user')->find($transaction_id);
        return view('confirmation', compact('transaction'));
    }
}
