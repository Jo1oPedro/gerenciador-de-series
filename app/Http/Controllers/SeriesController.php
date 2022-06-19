<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $request->get('id');
        //$series = DB::select('select name from series;');
        return view('series.index', compact('series'));
        /*
        return view('listar-series', [
            'series' => $series,
        ]);
        */
    }

    public function create() 
    {
        return view('series.create');
    }

    public function store(Request $request) 
    {
        $nomeSerie = $request->input('nome');
        //DB::insert('insert into series (name) values (?)', [$nomeSerie]);
        return redirect('/series');
    }
}
