<?php

namespace App\Http\Controllers;

use App\Events\SeriesCreated as EventsSeriesCreated;
use App\Events\SeriesDeleted;
use App\Http\Middleware\Autenticador;
use App\Http\Requests\SeriesFormRequest;
use App\Jobs\DeleteCover;
use App\Mail\SeriesCreated;
use App\Models\Series;
use App\Models\User;
use App\Repositories\SeriesRepository;
use DateTime;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SeriesController extends Controller
{

    public function __construct(private SeriesRepository $repository) 
    {
        $this->middleware(Autenticador::class)->except('index');
    }

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
        $coverPath = 'series_cover/defaultUser.jpg';
        if($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('series_cover', 'public');
        }
        /*
            $request->validate([
                'name' => 'required|min:3',

            ]);
            A forma mais adequada de se fazer isso é utilizando um form request
        */
        $newSerieId = 1;
        if(count(Series::all()) > 0) {
            $newSerieId = Series::latest()->first()->id + 1;
        }
        //$serie = $this->repository->add($request->all());
        $seriesCreatedEvent = new EventsSeriesCreated(
            $request->name,//$serie->name,
            $newSerieId,//$serie->id,
            $request->seasonsQtd,
            $request->episodesPerSeason, 
            $coverPath,  
        );
        
        /*EventsSeriesCreated::dispatch(
            $serie->name,
            $serie->id,
            $request->seasonQtd,
            $request->episodePerSeason,   
        );*/

        event($seriesCreatedEvent);
        //Mail::to(User::all())->send($email);
        //Mail::to($request->user());
        //session(['mensagem.sucesso' => "Serie $request->name adicionada com sucesso"]); // dessa forma ele não faz o flash, logo a mensagem continuaria sendo exibida na index
        //$request->session()->flash('mensagem.sucesso', "Série '$serie->name' adicionada com sucesso");
        
        //return redirect('/series');
        //return redirect(route('series.index'));
        //return redirect()->route('series.index');
        
        // A partir da versão 9 do laravel a versão abaixo surgiu
        // cria uma resposta de redirecionamento para a rota com o nome no parametro

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '$request->name' adicionada com sucesso");
    }

    public function destroy(Series $series, Request $request) 
    {
        $series->delete();
        $serieDeleted = new SeriesDeleted(
            $series->cover,
        );
        if($series->cover != 'series_cover/defaultUser.jpg') {
            //event($serieDeleted);
            DeleteCover::dispatch($series->cover);
        }
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
