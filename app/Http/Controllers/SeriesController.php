<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index()
    {
        $series = Serie::query()->orderBy('name')->get();
        $mensagem = session('mensagem.sucesso'); // caso fosse necessario adicionar algum valor na session, poderia ser feito session(['mensagem.sucesso' => 'Série removida com sucesso']);
        return view('series.index', compact('series'))
            ->with('mensagem', $mensagem);
    }

    public function create() 
    {
        return view('series.create');
    }

    public function store(Request $request) 
    {
        $serie = Serie::create($request->all());
        
        //session(['mensagem.sucesso' => "Serie $request->name adicionada com sucesso"]); // dessa forma ele não faz o flash, logo a mensagem continuaria sendo exibida na index
        //$request->session()->flash('mensagem.sucesso', "Série '$serie->name' adicionada com sucesso");
        
        //return redirect('/series');
        //return redirect(route('series.index'));
        //return redirect()->route('series.index');
        
        // A partir da versão 9 do laravel a versão abaixo surgiu
        // cria uma resposta de redirecionamento para a rota com o nome no parametro
        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '$serie->name' adicionada com sucesso");
    }

    public function destroy(Serie $series, Request $request) 
    {
        $series->delete();
        //$request->session()->flash('mensagem.sucesso', "Série '$series->name' removida com sucesso"); // com o metodo flash não é necessario utilizar o forget no index pois ele já realiza isso
        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '$series->name' removida com sucesso");
    }

    public function edit(Serie $series) 
    {
        return view('series.edit', compact('series'));
        /*
            dessa forma também é valido
            return view('series.edit')->with('series', $series);
        */    
    }

    public function update(Serie $series, Request $request) 
    {
        $series->update(['name' => $request->name]);
        /*
            $series->fill($request->all());
            $series->save();
            também funciona e só atualizaria oq está no atributo de fillable dessa model,
            porém ele não faz o save, logo é necessario fazer o save após, diferente do update
        */
        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '$series->name' atualizada com sucesso");
    }
}
