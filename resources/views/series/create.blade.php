<x-layout title="Nova Série">

    <x-series.form :action="route('series.store')" :nome="old('name')" :update="false" />
    <!--<form action="/series" method="post">-->
    <!--
    <form action="{{ route('series.store')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome: </label>
            <input type="text" id="nome" name="name" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>
    -->
</x-layout>