<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    protected $table = "aiPPFlat";
    protected $fillable = ['VehicleMake','VehicleModel','VehicleSeries','VehicleBadge','PartNumber','CommentTest','Price','CountNumber'];
}
