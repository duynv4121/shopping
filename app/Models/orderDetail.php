<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderDetail extends Model
{
    protected $table = 'orderdetail';
    protected $fillable = [];
    public $timestamps = false;


    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'id');
    }
}
