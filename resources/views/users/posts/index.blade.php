<x-app-layout>
    <x-slot name="header">
        <h1 class="page-title">Foros Publicados</h1>
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
                        <form action="{{ route('user.posts.index', $user->id) }}" method="post">
                            <div class="row">
                                <div class="col-md-4">
                                    <x-input-text name="post" label="Foro"></x-input-text>
                                </div>
                                <div class="col-md-4">
                                    <x-select label="Categoría" name="category_id" :options=$categories placeholder="Seleccione una categoría"></x-select>
                                </div>
                                <div class="col-md-4">
                                    <x-select label="Etiqueta" name="tag_id" :options=$tags placeholder="Seleccione una Etiqueta"></x-select>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date">Fecha de publicación</label>
                                        <input type="date" name="date" id="date" class="form-control">
                                    </div>
                                </div> --}}
                            </div>
                            <button type="submit" class="btn btn-success btn-sm">Buscar <i class="fas fa-search"></i></button>
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
                                    <p>{{ substr($post->content, 0, 255) }} {{ (strlen($post->content) > 255) ? '...' : '' }}</p>
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
        </script>
    </x-slot>
</x-app-layout>