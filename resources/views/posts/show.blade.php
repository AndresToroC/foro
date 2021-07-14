<x-app-layout>
    <x-slot name="header">
        <div class="page-title">Foro: {{ $post->name }}</div>
    </x-slot>

    <x-slot name="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Foro: {{ $post->name }}</div>
                    <div class="card-body">
                        Descripción: 
                        <br>
                        {{ $post->description }}
                        <hr>
                        <br>
                        {{ $post->content }}
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="scripts">

    </x-slot>
</x-app-layout>