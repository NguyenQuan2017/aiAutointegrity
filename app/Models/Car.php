<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = "aiPPCar";
    protected $fillable = ['Make','Model','Badge','Serires','PartNumber'];

    public function parts() {
        return $this->hasMany('App\Models\Part','PartNumber','PartNumber');
    }

    public function price() {
        return $this->hasOne('App\Models\Price','PartNumber','PartNumber');
    }
}
