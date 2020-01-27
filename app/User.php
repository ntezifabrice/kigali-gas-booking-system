<?php

namespace App;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Notifications\Notifiable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'avatar', 'address', 'mobile_no'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $with = ['transactions','cylinders'];
    public function transactions()
    {
        return $this->hasMany('App\Transaction', 'user_id','id');
    }
    public function cylinders()
    {
        return $this->hasMany('App\Cylinder', 'user_id','id');
    }
    public function image_url()
    {
        return url(!empty($this->avatar) ? 'storage/'.$this->avatar : 'storage/users/default.png');
    }
    public function transactionsForAgent()
    {
        return $this->transactionsForAgentFunction()->get();
    }
    public function transactionsForAgentFunction()
    {
        return Transaction::whereHas('cylinder', function ($query){
            $query->whereIn('id', $this->cylinders->pluck('id'));
        });
    }
}
