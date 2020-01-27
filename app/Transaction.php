<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = ['address_2','payments','transaction_number','sector','street','house','cylinder_id', 'user_id'];

    protected $appends = ['yearMonth'];

    public function getYearMonthAttribute() {
        return $this->created_at->format('Y-m');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function cylinder()
    {
        return $this->belongsTo('App\Cylinder');
    }
}
