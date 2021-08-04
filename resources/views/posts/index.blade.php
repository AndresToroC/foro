<x-app-layout>
    <x-slot name="header">
        <h1 class="page-title">Foros</h1>
    </x-slot>

    <x-slot name="content">
        <div class="row">
            <div class="col-md-12">
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
                                    Publicado el: {{ $post->created_at }} <br>
                                    Autor: {{ $post->user->name }}
                                </div>
                                <div class="col-md-3 text-right">
                                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-sm">
                                        <i class="fas fa-eye" style="color: blue"></i>
                                        <div class="mt-1 text-muted text-h5">Ver más</div>
                                    </a>
                                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-sm">
                                        <i class="fas fa-star" style="color: yellow"></i>
                                        <div class="mt-1 text-muted text-h5">Favoritos</div>
                                    </a>
                                </div>
                            </div>
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

    <x-slot name="scripts"></x-slot>
</x-app-layout>