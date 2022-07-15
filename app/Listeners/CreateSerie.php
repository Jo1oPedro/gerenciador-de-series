<?php

namespace App\Listeners;

use App\Events\SeriesCreated;
use App\Repositories\SeriesRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateSerie
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(private SeriesRepository $seriesRepository)
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SeriesCreated  $event
     * @return void
     */
    public function handle(SeriesCreated $event)
    {
        $elementsOfTheSerie = [
            'name' => $event->seriesName,
            'id' => $event->seriesId,
            'seasonsQtd' => $event->seriesSeasonsQtd,
            'episodesPerSeason' => $event->seriesEpisodesPerSeason,
        ];
        $this->seriesRepository->add($elementsOfTheSerie);
    }
}
