<x-layout title="Temporadas de {!! $series->name !!}">
    <div class="d-flex justify-center">
        <img src="{{ asset('storage/' . $series->cover) }}" 
            style="height:400px"
            alt="Capa da série" 
            class="img-fluid">
    </div>
    <ul class="list-group">
        @foreach($seasons as $season)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                @auth
                    <a href="{{ route('episodes.index', $season->id) }}">
                @endauth
                    Temporada: {{ $season->number }}
                @auth
                    </a>
                    <span class="badge bg-secondary">
                        {{ $season->numberOfWatchedEpisodes() }} / {{ $season->episodes->count() }}
                    </span>
                @endauth
            </li>
        @endforeach
    </ul>
</x-layout>