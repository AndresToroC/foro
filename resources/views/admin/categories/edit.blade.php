<x-app-layout>
    <x-slot name="header">
        Categorias
    </x-slot>

    <x-slot name="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Editar categoría
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Nombre *</label>
                                <input type="text" name="name" id="name" value="{{ $category->name }}" class="form-control" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea name="description" id="description" cols="30" rows="5" class="form-control">{{ $category->description }}</textarea>
                            </div>
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