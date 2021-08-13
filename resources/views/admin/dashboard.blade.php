<x-app-layout>
    <x-slot name="header">
        <h1 class="pag-title">Dashboard</h1>
    </x-slot>

    <x-slot name="content">
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Foros Visibles</div>
                        </div>
                        <div class="h1 mb-3">{{ $data['postsVisibles'] }}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Foros no Visibles</div>
                        </div>
                        <div class="h1 mb-3">{{ $data['postsNotVisibles'] }}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Usuarios</div>
                        </div>
                        <div class="h1 mb-3">{{ $data['users'] }}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Total categorias</div>
                        </div>
                        <div class="h1 mb-3">{{ $data['categories'] }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-5 col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Foros en Categorias</h3>
                        <div id="categories-group-pie"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-7 col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Foros en Categorias</h3>
                        <div id="posts-published"></div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="scripts">
        <script>
            // Grafica de cantidad de foros por categoría
            var postsCategories = @JSON($postsCategories);

            var chart = new ApexCharts(document.querySelector("#categories-group-pie"), postsCategories);
            chart.render();

            // Foros publicados por fecha y estado
            var postsPublished = @JSON($postsPublished);

            var chart = new ApexCharts(document.querySelector("#posts-published"), postsPublished);
            chart.render();
        </script>
    </x-slot>
</x-app-layout>