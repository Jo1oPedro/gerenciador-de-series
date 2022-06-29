<form action=" {{$action}} " method="post">
    @csrf
    @isset($nome)
        @method('PUT')
    @endisset
    <div class="mb-3">
        <label for="name" class="form-label">Nome:</label>
        <input type="text" 
            id="name" 
            name="name" 
            class="form-control"
            @isset($nome)
                value="{{ $nome }}"
            @endisset
        >
    </div>

    <button type="submit" class="btn btn-primary">Adicionar</button>
</form>