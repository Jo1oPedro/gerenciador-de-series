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
        $mensagem = $request->session()->get('mensagem.sucesso');
        $request->session()->forget('mensagem.sucesso');
        return view('series.index', compact('series'))
            ->with('mensagem', $mensagem);

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

    public function destroy(Serie $series, Request $request) {
        Serie::destroy($series->id);
        //>session()->put('mensagem.sucesso', 'Série removida com sucesso');
        $request->session()->put('mensagem.sucesso', 'Série removida com sucesso');
        return to_route('series.index');
    }
}
