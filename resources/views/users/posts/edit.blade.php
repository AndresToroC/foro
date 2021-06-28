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
                        <b>Editar foro</b>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.posts.update', [$user->id, $post->id]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <x-input-text label="Nombre *" name="name" value="{{ $post->name }}"></x-input-text>
                            <x-text-area label="Contenido *" name="content" value="{{ $post->content }}"></x-text-area>
                            <div class="row">
                                <div class="col-md-6">
                                    <x-select label="Categoría" name="category_id" :options=$categories value="{{ $post->category_id }}"></x-select>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tag_ids">Etiquetas</label>
                                        <select name="tag_ids[]" id="tag_ids" class="form-control" multiple="multiple"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="is_visible" id="is_visible" value="1" 
                                    @if ($post->is_visible)
                                        checked
                                    @endif
                                >
                                <label for="is_visible">Visible / Oculto</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Actualziar</button>
                            <a href="{{ route('user.posts.index', $user->id) }}" class="btn btn-dark btn-sm">Regresar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="scripts">
        <script>
            let tags_selected = @JSON($post->post_tag);

            window.addEventListener('load', (event) => {
                let categoryId = @JSON($post->category_id);
                        
                $('#tag_ids').empty();
                $.get('../../../../api/category/'+ categoryId +'/tags', function(data) {
                    $.each(data['tags'], function(key, tag) {
                        let tag_selected = tags_selected.find(i => i.id === tag.id);

                        if (tag_selected) {
                            $('#tag_ids').append('<option value="'+ tag.id +'" selected>'+ tag.name +'</option>');
                        } else {
                            $('#tag_ids').append('<option value="'+ tag.id +'">'+ tag.name +'</option>');
                        }
                    });
                });
            });
            
            $('#category_id').on('change', function(e) {
                var category_id = e.target.value;

                $('#tag_ids').empty();
                $.get('../../../../api/category/'+ category_id +'/tags', function(data) {
                    $.each(data['tags'], function(key, tag) {
                        $('#tag_ids').append('<option value="'+ tag.id +'">'+ tag.name +'</option>')
                    });
                });
            });

            // Select2
            $(document).ready(function() {
                $('#tag_ids').select2({
                    placeholder: 'Seleccione una etiqueta'
                });
            });
        </script>
    </x-slot>
</x-app-layout>
