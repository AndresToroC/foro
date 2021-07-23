<x-app-layout>
    <x-slot name="header">
        <div class="page-title">Foro: {{ $post->name }}</div>
    </x-slot>

    <x-slot name="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-status bg-blue"></div>
                    <div class="card-body">
                        <p>Autor: {{ $post->user->name }}</p>
                        {!! html_entity_decode($post->content) !!}
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between">
                                    <p>Fecha: {{ $post->created_at }}</p>
                                    <div>
                                        <i class="fas fa-thumbs-up" style="color: blue"></i> 12
                                        <i class="fas fa-thumbs-down" style="color: red"></i> 8
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Comentarios --}}
                @if (count($post->comments))
                    <hr>
                    <b>{{ count($post->comments) }} comentarios</b>
                    <div class="mt-4"></div>
                @endif
                @forelse ($post->comments as $comment)
                    <div class="card">
                        <div class="card-status bg-blue"></div>
                        <div class="card-body">
                            <p>Autor: {{ $comment->user->name }}</p>
                            {!! html_entity_decode($comment->comment) !!}
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between">
                                        <p>Fecha: {{ $comment->created_at }}</p>
                                        <div>
                                            <i class="fas fa-thumbs-up" style="color: blue"></i> 12
                                            <i class="fas fa-thumbs-down" style="color: red"></i> 8
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    
                @endforelse

                {{-- Form respuestas --}}
                <hr>
                <div class="card">
                    <div class="card-header">
                        <div class="card-status bg-warning"></div>
                        <b>Agregar un comentario</b>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('posts.comments.store', $post->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <x-text-area label="Comentario *" name="comment" value=""></x-text-area>
                            <button type="submit" class="btn btn-success btn-sm">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="scripts">
        <script>
             $(document).ready(function() {
                $('#comment').summernote({
                    lang: 'es-ES',
                    placeholder: 'Agregar comentario',
                    tabsize: 2,
                    height: 150,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['fontname', ['fontname']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['help']],
                    ]
                });
            });
        </script>
    </x-slot>
</x-app-layout>