<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Flat;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class CarPartController extends Controller
{

   public function Make() {
       $makes = Flat::selectRaw('upper(VehicleMake) as VehicleMake,count(VehicleMake) as countMake')
           ->groupBy('VehicleMake')
           ->orderBy('VehicleMake','ASC')
           ->get();
       return response([
           'status'=> 200,
           'messages'=> 'Get data success',
           'makes'=> $makes
       ]);
   }

    public function Model(Request $req) {
        $makes = $req->input('makes');
        $models = Flat::selectRaw('upper(VehicleModel) as VehicleModel,count(VehicleModel) as countModel')
            ->where('VehicleMake',$makes)
            ->where('VehicleModel', '<>','')
            ->where('VehicleModel', '<>','.')
            ->groupBy('VehicleModel')
            ->orderBy('countModel','DESC')
            ->skip(0)
            ->take(2000)
            ->get();
        return response([
            'status'=> 200,
            'messages'=> 'Get data Model success',
            'models'=> $models
        ]);

    }

    public function Series (Request $req) {
        $makes = $req->input('makes');
        $models = $req->input('models');
        $series = Flat::selectRaw('upper(VehicleSeries) as VehicleSeries, count(VehicleSeries) as countSeries')
            ->where([['VehicleMake',$makes],['VehicleModel',$models],['VehicleSeries','<>',""],['VehicleSeries','<>',
                '.'],['VehicleSeries','<>','**'],['VehicleSeries','<>','-']])
            ->groupBy('VehicleSeries')
            ->orderBy('countSeries','DESC')
            ->get();
        return response([
            'status'=> 200,
            'messages'=> 'Get data Series success',
            'series'=> $series
        ]);

    }

    public function Badges (Request $req) {
        $makes = $req->input('makes');
        $models = $req->input('models');
        $series = $req->input('series');
        $badges = Flat::selectRaw('upper(VehicleBadge) as VehicleBadge, count(VehicleBadge) as countBadge')
            ->where([['VehicleMake',$makes],['VehicleModel',$models],['VehicleSeries',$series]])
            ->where([['VehicleBadge','<>',""],['VehicleBadge','<>','.']])
            ->groupBy('VehicleBadge')
            ->orderBy('countBadge','DESC')
            ->get();
        return response([
            'status'=> 200,
            'messages'=> 'Get Badge success',
            'badges'=> $badges
        ]);
    }

    public function NumberPrice(Request $req) {
        $makes = $req->input('makes');
        $models = $req->input('models');
        $series = $req->input('series');
        $badges = $req->input('badges');
        $numberprice = Flat::where(function($query) use ($makes, $models, $series, $badges) {
            if($makes) {
                $query->where('VehicleMake', $makes);
            }
             if($models) {
                $query->where('VehicleModel', $models);
            }
             if($series) {
                $query->where('VehicleSeries', $series);
            }
             if($badges) {
                $query->where('VehicleBadge', $badges);
             }
        })
            ->where('Price','<>',"")
            ->where('CommentTest','<>','')
            ->orderBy('CommentTest','ASC')
            ->skip(0)
            ->take(2000)
            ->get();
        return response([
            'status'=> 200,
            'messages'=>'Get data success',
            'results'=> $numberprice
        ]);
    }
    
    public function Search(Request $req) {
        $search = Flat::where('PartNumber','LIKE',"%{$req->get('keyword')}%")
            ->where('Price','<>',"")
            ->orderBy('CommentTest','ASC')
            ->skip(0)
            ->take(50)
            ->get();
        return response([
            'status'=> 200,
            'messages'=> 'Get data success',
            'search'=> $search
        ]);
    }
    public function ShowPart(Request $req){
        $makes = $req->input('makes');
        $models = $req->input('models');
        $series = $req->input('series');
        $badges = $req->input('badges');
        $showPart = Flat::where(function($query) use ($makes, $models, $series, $badges) {
            if($makes) {
                $query->where('VehicleMake', $makes);
            }
            if($models) {
                $query->where('VehicleModel', $models);
            }
            if($series) {
                $query->where('VehicleSeries', $series);
            }
            if($badges) {
                $query->where('VehicleBadge', $badges);
            }
        })
            ->where('Price','<>',"")
            ->where('CommentTest','<>','')
            ->orderBy('CommentTest','ASC')
            ->skip(0)
            ->take(100)
            ->get();
        return response([
            'status'=> 200,
            'messages'=>'Get data success',
            'results'=> $showPart
        ]);
    }
}
