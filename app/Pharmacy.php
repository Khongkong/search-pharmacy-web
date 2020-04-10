<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    protected $fillable = ['name', 'phone', 'address', 'mask_child', 'mask_child', 'created_at', 'updated_at'];

    public function city()
    {
        return $this->belongsTo('App\City');
    }
}
