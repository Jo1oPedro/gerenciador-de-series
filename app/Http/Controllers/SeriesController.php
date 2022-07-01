<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class SeriesController extends Controller
{
    public function index()
    {
        /*
            $series = Serie::query()->orderBy('name')->get();
            Já foi utilizado um metodo booted na model de Series para fazer com que as series retornadas
            a partir do builder sejam sempre ordenadas de forma alfabetica
        */
        /*
            $series = Serie::with(['temporadas'])->get();
            Adicionando uma propriedade de with com valor 'temporadas' na model de Serie,
            não é mais necessario utilizado with aqui;
        */
        $series = Series::all();
        $mensagem = session('mensagem.sucesso'); // caso fosse necessario adicionar algum valor na session, poderia ser feito session(['mensagem.sucesso' => 'Série removida com sucesso']);
        return view('series.index', compact('series'))
            ->with('mensagem', $mensagem);
    }

    public function create() 
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request) 
    {
        /*
            $request->validate([
                'name' => 'required|min:3',

            ]);
            A forma mais adequada de se fazer isso é utilizando um form request
        */
        $serie = Series::create($request->all());
        $seasons = [];
        for($i = 1; $i <= $request->seasonsQtd; $i++) {
            $seasons [] = [
                'series_id' => $serie->id,
                'number' => $i,
            ];
        }
        Season::insert($seasons);
        $episodes = [];
        foreach($serie->seasons as $season) {
            for($j = 1; $j <= $request->episodesPerSeason; $j++) {
                $episodes [] = [
                    'season_id' => $season->id,
                    'number' => $j,
                ];
            }
        }
        Episode::insert($episodes);
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

    public function destroy(Series $series, Request $request) 
    {
        $series->delete();
        //$request->session()->flash('mensagem.sucesso', "Série '$series->name' removida com sucesso"); // com o metodo flash não é necessario utilizar o forget no index pois ele já realiza isso
        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '$series->name' removida com sucesso");
    }

    public function edit(Series $series) 
    {
        /*
            //dd($series->temporadas);
            Se acessar como uma propriedade o laravel acessa como uma coleção e já pega as temporadas
        */
        /*
            //$series->temporadas()->whereId(1)->get();
            Se acessar através do método, você tem um relacionamento, logo um querybuild que da a possibilidade de filtrar isso pra depois pegar a coleção
        */
        
        return view('series.edit', compact('series'));
        /*
            dessa forma também é valido
            return view('series.edit')->with('series', $series);
        */    
    }

    public function update(Series $series, SeriesFormRequest $request) 
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
