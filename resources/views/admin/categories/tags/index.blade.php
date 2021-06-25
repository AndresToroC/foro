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
                        <b>Lista de etiquetas</b>
                        <div class="card-options">
                            <a href="{{ route('admin.categories.tags.create', $category->id) }}" class="btn btn-success btn-sm">Nueva etiqueta <i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <form action="{{ route('admin.categories.tags.index', $category->id) }}" method="get">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <input type="search" name="search" id="search" value="{{ $search }}" class="form-control" placeholder="Buscar categoría">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Etiqueta</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tags as $tag)
                                    <tr>
                                        <td>{{ $tag->name }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.categories.tags.edit', [$category->id, $tag->id]) }}" class="btn btn-primary btn-sm">
                                                Editar <i class="fas fa-edit"></i>
                                            </a>
                                            <a onclick="tag_delete_form({{ $tag->id }})" class="btn btn-danger btn-sm" style="color: #fff">
                                                Eliminar <i class="fas fa-trash"></i>
                                            </a>
                                        </td>

                                        <form action="{{ route('admin.categories.tags.destroy', [$category->id, $tag->id]) }}" method="post"
                                            id="tag-delete-form-{{ $tag->id }}" style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">No se encontraton registros</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $tags->appends(['search' => $search])->render() }}
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-dark btn-sm">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="scripts">
        <script>
            function tag_delete_form(id) {
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
                        document.getElementById('tag-delete-form-'+id).submit();
                    }
                })
            }
        </script>
    </x-slot>
</x-app-layout>