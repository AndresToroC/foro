<x-app-layout>
    <x-slot name="header">
        <h2 class="page-title">Categorias</h2>
    </x-slot>

    <x-slot name="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>Lista de Categorias</b>
                        <div class="card-options">
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-success btn-sm">Nueva categoría <i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Categoría</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.categories.tags.index', $category->id) }}" class="btn btn-info btn-sm">
                                                Etiquetas <i class="fas fa-list"></i>
                                            </a>
                                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary btn-sm">
                                                Editar <i class="fas fa-edit"></i>
                                            </a>
                                            <a onclick="delete_categories({{ $category->id }})" class="btn btn-danger btn-sm" style="color: #fff">
                                                Eliminar <i class="fas fa-trash"></i>
                                            </a>
                                        </td>

                                        <form id="form-delete-{{ $category->id }}" action="{{ route('admin.categories.destroy', $category->id) }}"
                                            method="POST" style="display: none;">
                                           @csrf
                                           @method('DELETE')
                                       </form>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">No se encontron registros</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="scripts">
        <script>
            function delete_categories(id) {
                event.preventDefault();
                
                document.getElementById('form-delete-'+id).submit();
            }
        </script>
    </x-slot>
</x-app-layout>