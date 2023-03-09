<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('name', 'description', 'price', 'store_id');

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order');
    }

}