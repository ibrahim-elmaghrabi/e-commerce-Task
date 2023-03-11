<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations;

    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('name', 'description', 'price', 'store_id');

    public $translatable =  ['name', 'description'];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order');
    }

}