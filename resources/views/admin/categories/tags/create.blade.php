<x-app-layout>
    <x-slot name="header">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-pretitle">Categoría: {{ $category->name }}</div>
                <h2 class="page-title">Etiquetas</h2>
            </div>
        </div>
    </x-slot>

    <x-slot name="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-status bg-blue"></div>
                        <b>Nueva etiqueta</b>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.categories.tags.store', $category->id) }}" method="post">
                            @csrf
                            <x-input-text label="Nombre *" name="name" required autofocus></x-input-text>
                            <button type="submit" class="btn btn-success btn-sm">Crear</button>
                            <a href="{{ route('admin.categories.tags.index', $category->id) }}" class="btn btn-dark btn-sm">Regresar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="scripts"></x-slot>
</x-app-layout>