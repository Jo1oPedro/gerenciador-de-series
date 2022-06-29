<x-layout title="Editar série '{{ $series->name }}'">
    <x-series.form 
        :action="route('series.update', $series->id)" 
        :nome="$series->name" 
        :update="true" 
    />
</x-layout>