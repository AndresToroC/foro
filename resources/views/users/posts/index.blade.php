<x-app-layout>
    <x-slot name="header">
        <h1 class="page-title">Mis Foros</h1>
        <div class="page-options d-flex">
            <div class="input-icon ml-2">
                <a href="{{ route('user.posts.create', $user->id) }}" class="btn btn-success btn-sm">Nuevo foro <i class="fas fa-plus"></i></a>
            </div>
        </div>
    </x-slot>

    <x-slot name="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-status bg-blue"></div>
                        <b>Buscar</b>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.posts.index', $user->id) }}" method="get" id="form_search_post">
                            <div class="row">
                                <div class="col-md-4">
                                    <x-input-text name="post" label="Foro" placeholder="Foro" :value=$post_filter></x-input-text>
                                </div>
                                <div class="col-md-4">
                                    <x-select label="Categoría" name="category_id" :options=$categories placeholder="Seleccione una categoría" :value=$categoryId_filter></x-select>
                                </div>
                                <div class="col-md-4">
                                    <x-select label="Etiqueta" name="tag_id" placeholder="Seleccione una Etiqueta" :value=$tagId_filter></x-select>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date">Fecha de publicación</label>
                                        <input type="date" name="date" id="date" class="form-control">
                                    </div>
                                </div> --}}
                            </div>
                            <button type="submit" class="btn btn-success btn-sm">Buscar <i class="fas fa-search"></i></button>
                            <button id="clear_form_search_post" class="btn btn-dark btn-sm">Limpiar</button>
                        </form>
                    </div>
                </div>

                @forelse ($posts as $post)
                    <div class="card">
                        <div class="card-header">
                            <div class="card-status {{ ($post->is_visible) ? 'bg-blue' : 'bg-gray' }}"></div>
                            <b>{{ $post->name }}</b>
                            <div class="card-options">
                                Categoría: {{ $post->category->name }}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-9">
                                    {{-- <p>{{ substr($post->content, 0, 255) }} {{ (strlen($post->content) > 255) ? '...' : '' }}</p> --}}
                                    {{ ($post->description) ? $post->description : 'No se encontro una descripción' }}
                                </div>
                                <div class="col-md-3 text-right">
                                    <a href="{{ route('user.posts.edit', [$user->id, $post->id]) }}" class="btn btn-primary btn-sm">Editar <i class="fas fa-edit"></i></a>
                                    <a onclick="delete_form_post({{ $post->id }})" class="btn btn-danger btn-sm" style="color: #fff">
                                        Eliminar <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                            <form action="{{ route('user.posts.destroy', [$user->id, $post->id]) }}" method="post"
                                id="delete-post-{{ $post->id }}" style="display: none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="card">
                        <div class="card-body">
                            <div class="card-status bg-danger"></div>
                            No se encontraron foros
                        </div>
                    </div>
                @endforelse
                {{ $posts->appends([])->render() }}
            </div>
        </div>
    </x-slot>

    <x-slot name="scripts">
        <script>
            function delete_form_post(id) {
                event.preventDefault();
                
                Swal.fire({
                    title: '¿Estás seguro de eliminar este registro?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-post-'+id).submit();
                    }
                })
            }

            // Si ahi una categoria seleccionada se cargan las etiquetas
            window.addEventListener('load', (event) => {
                let categoryId = @JSON($categoryId_filter);
                let tagId_filter = @JSON($tagId_filter);
                        
                if (categoryId) {
                    $('#tag_id').empty();
                    $('#tag_id').append('<option disabled selected>Seleccione una Etiqueta</option>');
                    $.get('../../../api/category/'+ categoryId +'/tags', function(data) {
                        $.each(data['tags'], function(key, tag) {
                            if (tagId_filter == tag.id) {
                                $('#tag_id').append('<option value="'+ tag.id +'" selected>'+ tag.name +'</option>');
                            } else {
                                $('#tag_id').append('<option value="'+ tag.id +'">'+ tag.name +'</option>');
                            }
                        });
                    });
                }
            })

            // Cargando etiquetas segun la categoria
            $('#category_id').on('change', function(e) {
                let category_id = e.target.value;

                $('#tag_id').empty();
                $('#tag_id').append('<option disabled selected>Seleccione una Etiqueta</option>');
                $.get('../../api/category/'+ category_id +'/tags', function(data) {
                    $.each(data['tags'], function(key, tag) {
                        $('#tag_id').append('<option value="'+ tag.id +'">'+ tag.name +'</option>');
                    });
                });
            })

            // Limpiar formulario de busqueda
            $('#clear_form_search_post').on('click', function(e) {
                event.preventDefault();
                
                $('#post').val('');
                $('#category_id').empty();
                $('#tag_id').empty();

                document.getElementById('form_search_post').submit();
            })
        </script>
    </x-slot>
</x-app-layout>