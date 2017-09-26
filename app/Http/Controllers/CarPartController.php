<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Part;
use App\Models\Price;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class CarPartController extends Controller
{

   public function Make() {
       $makes = Car::selectRaw('upper(Make) as Make,count(Make) as countMake')
           ->groupBy('Make')
           ->orderBy('countMake','DESC')
           ->get();
       return response([
           'status'=> 200,
           'messages'=> 'Get data success',
           'makes'=> $makes
       ]);
   }

    public function Model(Request $req) {
        $makes = $req->input('makes');
        $models = Car::selectRaw('upper(Model) as Model,count(Model) as countModel')
            ->where('Make',$makes)
            ->groupBy('Model')
            ->orderBy('countModel','DESC')
            ->skip(0)
            ->take(500)
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
        $series = Car::selectRaw('upper(Series) as Series, count(Series) as countSeries')
            ->where([['Make',$makes],['Model',$models],['Series','<>',""],['Series','<>','.']])
            ->groupBy('Series')
            ->orderBy('countSeries','DESC')
            ->skip(0)
            ->take(500)
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
        $badges = Car::selectRaw('upper(Badge) as Badge, count(Badge) as countBadge')
            ->where([['Make',$makes],['Model',$models],['Series',$series],['Badge','<>',""],['Badge','<>','.'],['Badge','<>','-']])
            ->groupBy('Badge')
            ->orderBy('countBadge','DESC')
            ->skip(0)
            ->take(500)
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
        $partnumber = Car::select('PartNumber')
//            ->where([['Make',$makes],['Model',$models],['Series',$series],['Badge',$badges]])
            ->where(function($query) use ($makes, $models, $series, $badges) {
                if($makes) {
                    $query->where('Make',$makes);
                }
                if($models) {
                    $query->where('Model',$models);
                }
                if($series) {
                    $query->where('Series',$series);
                }
                if($badges) {
                    $query->where('Badge',$badges);
                }
            })
            ->skip(0)
            ->take(500)
            ->get()
            ->pluck('PartNumber');
        $numberprice = Car::select('Description','Price','aiPPCar.PartNumber')
            ->join('aiPPPrice','aiPPCar.PartNumber','=','aiPPPrice.PartNumber')
            ->join('aiPPPart','aiPPCar.PartNumber','=','aiPPPart.PartNumber')
            ->whereIn('aiPPCar.PartNumber',$partnumber)
            ->where('Price','<>',"")
            ->groupBy('Description','Price','aiPPCar.PartNumber')
            ->orderBy('Description','ASC')
            ->skip(0)
            ->take(50)
            ->get();
        return response([
            'status'=> 200,
            'messages'=>'Get data success',
            'results'=> $numberprice
        ]);
    }
    
    public function Search(Request $req) {
        $search = Car::with('parts')
            ->join('aiPPPrice','aiPPPrice.PartNumber','=','aiPPCar.PartNumber')
            ->where('aiPPCar.PartNumber','LIKE',"%{$req->get('keyword')}%")
            ->where('Price','<>',"")
            ->skip(0)
            ->take(50)
            ->get();
        return response([
            'status'=> 200,
            'messages'=> 'Get data success',
            'search'=> $search
        ]);
    }
}
