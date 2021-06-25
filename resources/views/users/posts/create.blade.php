<x-app-layout>
    <x-slot name="header">
        <div class="col">
            <div class="page-title">Foros Publicados</div>
        </div>
    </x-slot>

    <x-slot name="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-status bg-blue"></div>
                        <b>Nuevo foro</b>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.posts.store', $user->id) }}" method="post">
                            @csrf
                            <x-input-text label="Nombre *" name="name"></x-input-text>
                            <x-text-area label="Contenido *" name="content"></x-text-area>
                            <div class="row">
                                <div class="col-md-6">
                                    <x-select label="Categoría" name="category_id" :options=$categories placeholder="Seleccione una categoría"></x-select>
                                </div>
                                {{-- <div class="col-md-6">
                                    <x-select label="Etiqueta" name="tag_ids[]" :options=$tags placeholder="Seleccione una etiqueta"></x-select>
                                </div> --}}
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="is_visible" id="is_visible" value="1">
                                <label for="is_visible">Visible / Oculto</label>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm">Publicar</button>
                            <a href="{{ route('user.posts.index', $user->id) }}" class="btn btn-dark btn-sm">Regresar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="scripts"></x-slot>
</x-app-layout>
