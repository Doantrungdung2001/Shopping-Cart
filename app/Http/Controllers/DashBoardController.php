<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Collection;

class DashBoardController extends Controller
{
    public function Index(){
        $data = DB::table('cart')
        ->select(DB::raw('DATE_FORMAT(created_at, \'%m-%Y\') as format'), DB::raw('count(id_product) as countProduct'))
        ->groupBy('format')
        ->orderByRaw('format ASC')
        ->pluck('countProduct', 'format')->all();
        $data1 = DB::table('cart')
        ->select(DB::raw('DATE_FORMAT(created_at, \'%m-%Y\') as format'), DB::raw('count(id_product) as countProduct'))
        ->where('status', '=', 'TRUE')
        ->groupBy('format')
        ->orderByRaw('format ASC')
        ->pluck('countProduct', 'format')->all();
        $data2 = DB::table('cart')
        ->select(DB::raw('DATE_FORMAT(created_at, \'%m-%Y\') as format'), DB::raw('count(id_product) as countProduct'))
        ->where('status', '=', 'FALSE')
        ->groupBy('format')
        ->orderByRaw('format ASC')
        ->pluck('countProduct', 'format')->all();
        for ($i=0; $i<=count($data); $i++) {
            $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        }
        $totalCount = DB::table('cart')
        ->select(DB::raw('count(id_product) as countProduct'))
        ->get();
         $countTrue = DB::table('cart')
        ->select(DB::raw('count(id_product) as countProduct'))
        ->where('status', '=', 'TRUE')
        ->get();
         $countFalse = DB::table('cart')
        ->select(DB::raw('count(id_product) as countProduct'))
        ->where('status', '=', 'FALSE')
        ->get();
        //Prepare the data for returning with the view
        $chart = new Chart;
        $chart->labels = (array_keys($data));
        $chart->dataset = (array_values($data));
        $chart->dataset1 = (array_values($data1));
        $chart->dataset2 = (array_values($data2));
        $chart->colours = $colours;
        return view('dashboard',compact('chart', 'totalCount', 'countTrue', 'countFalse'));
    }
}
