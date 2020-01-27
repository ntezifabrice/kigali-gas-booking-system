<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Cylinder extends Model
{
    protected $fillable = ['name','size','price','available','image','user_id'];

    public function getPriceAttribute($price) {
        return floatval($price).' RWF';
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function image_url()
    {
        return url(!empty($this->image) ? (file_exists('storage/'.$this->image) ?'storage/'.$this->image : $this->image) : 'storage/cylinders/default.png');
    }
    public function transactions()
    {
        return $this->transactionsFunction()->get();
    }
    public function transactionsFunction()
    {
        return Transaction::where('cylinder_id', $this->id);
    }

    public function price_usd($multiplyBy = 1)
    {
        $will_update_currency = false;
        $currency=Currency::first();

        if (!$currency){
            $will_update_currency = true;
            $currency=Currency::create(['exchange' => 900]);
        }
        if(!$will_update_currency){
            $date = new \DateTime($currency->updated_at);
            $date->modify('+6 hours');
            $date_to_update = $date->format('Y-m-d H:i:s');
            $current_date=(new \DateTime())->format('Y-m-d H:i:s');
            if ($current_date >= $date_to_update){
                $will_update_currency = true;
            }
        }

        if($will_update_currency){
            try {
                $url="https://openexchangerates.org/api/latest.json?app_id=04224383496f41e0bf7fde40f3e44164&base=USD";
                $json = $this->url_get_contents( $url );
                $data = json_decode( $json, true );
                $usd_to_rwf = $data['rates']['RWF'];
                if($usd_to_rwf){
                    $currency->exchange = $usd_to_rwf;
                    $currency->save();
                    $currency = Currency::find($currency->id);
                }
            }catch (\Exception $exception) {
            }
        }
        return number_format(intval($this->price) / floatval($currency->exchange), 2, '.', ',') * $multiplyBy;
    }
    function url_get_contents ($url) {
        if (function_exists('curl_exec')){
            $conn = curl_init($url);
            curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($conn, CURLOPT_FRESH_CONNECT,  true);
            curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
            $url_get_contents_data = (curl_exec($conn));
            curl_close($conn);
        }elseif(function_exists('file_get_contents')){
            $url_get_contents_data = file_get_contents($url);
        }elseif(function_exists('fopen') && function_exists('stream_get_contents')){
            $handle = fopen ($url, "r");
            $url_get_contents_data = stream_get_contents($handle);
        }else{
            $url_get_contents_data = false;
        }
        return $url_get_contents_data;
    }

}
