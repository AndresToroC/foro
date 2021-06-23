<x-app-layout>
    <x-slot name="header">
        <h2 class="page-title">Categorias</h2>
    </x-slot>

    <x-slot name="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>Nueva categoría</b>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.categories.store') }}" method="POST">
                            @csrf
                            <x-input-text label="Nombre *" name="name" required autofocus></x-input-text>
                            <x-text-area label="Descripción" name="description"></x-text-area>
                            <button type="submit" class="btn btn-success btn-sm">Crear</button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-dark btn-sm">Regresar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="scripts">

    </x-slot>
</x-app-layout>