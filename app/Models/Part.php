<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $table = "aiPPPart";
    protected $fillable = ['PartNumber','Description','Count'];

    public function car()
    {
        return $this->belongsTo('App\Models\Car', 'PartNumber', 'PartNumber');
    }

   
}
