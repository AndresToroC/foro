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
                        <b>Lista de etiquetas</b>
                        <div class="card-options">
                            <a href="{{ route('admin.categories.tags.create', $category->id) }}" class="btn btn-success btn-sm">Nueva etiqueta <i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Etiqueta</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($category->tags as $tag)
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

                document.getElementById('tag-delete-form-'+id).submit();
            }
        </script>
    </x-slot>
</x-app-layout>