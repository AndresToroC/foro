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
                        <b>Lista de Categorias</b>
                        <div class="card-options">
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-success btn-sm">Nueva categoría <i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <form action="{{ route('admin.categories.index') }}" method="get">
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
                        {{ $categories->appends(['search' => $search])->render() }}
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="scripts">
        <script>
            function delete_categories(id) {
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
                        document.getElementById('form-delete-'+id).submit();
                    }
                })

            }
        </script>
    </x-slot>
</x-app-layout>