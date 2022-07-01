<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;

class SeasonsController extends Controller
{
    public function index(Series $series) 
    {
        /*
            Uma forma de deixar mais rapido seria receber somente o id (int) no parametro e fazer
            $seasons = Season::query()
                        ->with('episodes')
                        ->where('series_id', $series)
                        ->get();
        */
        $seasons = $series->seasons()->with('episodes')->get();
        return view('seasons.index')
            ->with('seasons', $seasons)
            ->with('series', $series);
    }
}
