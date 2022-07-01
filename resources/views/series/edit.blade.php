<x-layout title="Editar série '{!! $series->name !!}'">
    <form action="{{ route('series.update', $series->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Nome:</label>
        <input type="text" 
            id="name" 
            name="name" 
            class="form-control"
            value="{{ $series->name }}"
        >
    </div>

    <button type="submit" class="btn btn-primary">Adicionar</button>
</form>
</x-layout>