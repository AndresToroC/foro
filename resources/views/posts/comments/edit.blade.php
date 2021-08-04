<x-app-layout>
    <x-slot name="header">
        <div class="page-title">Editar comentatio del foro: {{ $post->name }}</div>
    </x-slot>

    <x-slot name="content">
        <div class="card">
            <div class="card-header">
                <div class="card-status bg-warning"></div>
                <b>Edita comentario</b>
            </div>
            <div class="card-body">
                <form action="{{ route('posts.comments.update', [$post->id, $comment->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <x-text-area label="Comentario *" name="comment" value="{!! html_entity_decode($comment->comment) !!}"></x-text-area>
                    <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-dark btn-sm">Regresar</a>
                </form>
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