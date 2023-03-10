<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('user_id', 'store_id', 'shipping_cost', 'total');

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('price','quantity');
    }

}