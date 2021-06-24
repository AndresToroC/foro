<x-app-layout>
    <x-slot name="header">
        <h2 class="page-title">Categorias</h2>
    </x-slot>

    <x-slot name="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-status bg-blue"></div>
                        <b>Editar categoría</b>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <x-input-text label="Nombre *" name="name" value="{{ $category->name }}" required></x-input-text>
                            <x-text-area label="Descripción" name="description" value="{{ $category->description }}"></x-text-area>
                            <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
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