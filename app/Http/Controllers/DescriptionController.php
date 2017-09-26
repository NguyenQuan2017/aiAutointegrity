<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Part;
use Illuminate\Http\Request;

use App\Http\Requests;

class DescriptionController extends Controller
{
    public function getDescription() {
        $des = Part::select('Description')
            ->groupBy('Description')
            ->skip(0)
            ->take(5)
            ->get();
        return response([
            'status'=> 200,
            'messages'=> 'Get Description Success',
            'des'=> $des
        ]);
    }
}
