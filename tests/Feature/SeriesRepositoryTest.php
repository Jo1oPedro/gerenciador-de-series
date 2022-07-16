<?php

namespace Tests\Feature;

use App\Http\Requests\SeriesFormRequest;
use App\Repositories\SeriesRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SeriesRepositoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_when_a_series_is_created_its_seasons_and_episodes_must_also_be_created()
    {
        // Arrange: prepara o ambiente de teste

        /** @var SeriesRepository $repository */
        $repository = $this->app->make(SeriesRepository::class);
        $request = [
            'name' => 'Nome da série',
            'seasonsQtd' => 1,
            'episodesPerSeason' => 1,
        ];

        // Act: executa o que quer testar
        
        $repository->add($request);

        // Assert: verifica se o que foi executado tem o resultado esperado
        
        $this->assertDatabaseHas('series', ['name' => $request['name'] ]);
        $this->assertDatabaseHas('seasons', ['number' => 1]);
        $this->assertDatabaseHas('episodes', ['number' => 1]);
    }
}
