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
            <div class="col-sm-4 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Foros en Categorias</h3>
                        <div id="categories-group-pie"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 col-lg-8">
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
            var options = {
          series: [{
          name: 'Net Profit',
          data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }, {
          name: 'Revenue',
          data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
        }, {
          name: 'Free Cash Flow',
          data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        yaxis: {
          title: {
            text: '$ (thousands)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "$ " + val + " thousands"
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#posts-published"), options);
        chart.render();
        </script>
    </x-slot>
</x-app-layout>