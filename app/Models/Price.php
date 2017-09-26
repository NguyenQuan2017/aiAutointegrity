<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = "aiPPPrice";
    protected $fillable = ['PartNumber','Price'];

    public function car() {
        return $this->belongsTo('App\Models\Car','PartNumber','PartNumber');
    }
}
