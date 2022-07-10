<?php

namespace App\Repositories;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Support\Facades\DB;

class EloquentSeriesRepository implements SeriesRepository
{

    public function add(mixed $request): Series 
    {
        return DB::transaction(function() use ($request) {
            //DB::beginTransaction();
            $serie = Series::create($request);
            $request = (object) $request;
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
            //DB::commit();
            
            return $serie;
        });
    }

    public static function watched(mixed $request) : void
    {
        DB::transaction(function () use ($request) {
            DB::table('episodes')->whereIn('id', $request->episodes)->update(['watched' => true]);
            DB::table('episodes')->whereNotIn('id', $request->episodes)->update(['watched' => false]);
        });
    }
}