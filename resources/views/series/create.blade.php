<x-layout title="Nova Série">

    <form action=" {{ route('series.store') }} " method="post" enctype="multipart/form-data">
    @csrf

    <div class="row mb-3">
        <div class="col-8">
            <label for="name" class="form-label">Nome:</label>
            <input type="text"
                autofocus 
                id="name" 
                name="name" 
                class="form-control"
                @isset($nome)
                    value="{{ old('name') }}"
                @endisset
            >
        </div>
        <div class="col-2">
            <label for="seasonsQtd" class="form-label">N° Temporadas:</label>
            <input type="text" 
                id="seasonsQtd" 
                name="seasonsQtd" 
                class="form-control"
                @isset($nome)
                    value="{{ old('seasonsQtd') }}"
                @endisset
            >
        </div>
        <div class="col-2">
            <label for="episodesPerSeason" class="form-label">Eps / Temporada:</label>
            <input type="text" 
                id="episodesPerSeason" 
                name="episodesPerSeason" 
                class="form-control"
                @isset($nome)
                    value="{{ old('episodesPerSeason') }}"
                @endisset
            >
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <label for="cover" class="form-label">Capa</label>
            <input type="file" 
                    id="cover" 
                    name="cover" 
                    class="form-control"
                    accept="image/gif, image/jpeg, image/png">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Adicionar</button>
</form>
</x-layout>