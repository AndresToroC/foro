<x-app-layout>
    <x-slot name="header">
        <div class="page-pretitle">Categoría: {{ $category->name }}</div>
        <h2 class="page-title">Etiquetas</h2>
    </x-slot>

    <x-slot name="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>Editar etiqueta</b>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.categories.tags.update', [$category->id, $tag->id]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Nombre *</label>
                                <input type="text" name="name" id="name" value="{{ $tag->name }}" class="form-control">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                            <a href="{{ route('admin.categories.tags.index', $category->id) }}" class="btn btn-dark btn-sm">Regresar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="scripts"></x-slot>
</x-app-layout>