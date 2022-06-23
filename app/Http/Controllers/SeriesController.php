<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $request->get('id');
        $series = Serie::query()->orderBy('name')->get();
        return view('series.index', compact('series'));

    }

    public function create() 
    {
        return view('series.create');
    }

    public function store(Request $request) 
    {
        Serie::create($request->all());
        //return redirect('/series');
        //return redirect(route('series.index'));
        //return redirect()->route('series.index');
        
        // A partir da versão 9 do laravel a versão abaixo surgiu
        // cria uma resposta de redirecionamento para a rota com o nome no parametro
        return to_route('series.index');
    }

    public function destroy(Serie $series) {
        Serie::destroy($series->id);
        return to_route('series.index');
    }
}
