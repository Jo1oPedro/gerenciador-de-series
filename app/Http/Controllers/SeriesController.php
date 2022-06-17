<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $request->get('id');
        $series = [
            'Punisher',
            'Lost',
            'Grey\'s Anatomy'
        ];

        return view('series.index', compact('series'));
        /*
        return view('listar-series', [
            'series' => $series,
        ]);
        */
    }
}
