<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class danhMuc extends Model
{
   protected $table = 'danh_muc';
   protected $primaryKey = 'id';
   protected $fillable = [];
   public $timestamps = true;


   public function children()
   {
       return $this->hasMany('App\Models\danhMuc', 'parent_id', 'id');
   }
}
