<?php

namespace App\Helper;

use Illuminate\Support\Facades\DB;

class Dashboard {

    // Data
    public function data() {
        $postsVisibles = DB::table('posts')->whereIsVisible(1)->count();
        $postsNotVisibles = DB::table('posts')->whereIsVisible(0)->count();
        $users = DB::table('users')->count();
        $categories = DB::table('categories')->count();
        
        return [
            'postsVisibles' => $postsVisibles, 
            'postsNotVisibles' => $postsNotVisibles, 
            'users' => $users, 
            'categories' => $categories
        ];
    }

    // Devuelve la cantidad de foros que tiene una categoría
    public function postsCategories() {
        $categories = DB::table('categories')
            ->leftJoin('posts', 'categories.id', '=', 'posts.category_id')
            ->select('categories.name', DB::raw('COUNT(posts.id) AS total'))
            ->groupBy('categories.id', 'categories.name')
            ->get();
            
        $series = [];
        $labels = [];
        foreach ($categories as $key => $category) {
            $series[] = $category->total;
            $labels[] = $category->name;
        }

        $options = [
            'series' => $series,
            'chart' => [
                // 'width' => 380,
                'type' => 'pie'
            ],
            'labels' => $labels,
            'responsive' => [
                [
                    'breakpoint' => 480,
                    'options' => [
                        // 'chart' => [
                            // 'width' => 200
                        // ],
                        'legend' => [
                            'position' => 'bottom'
                        ]
                    ]
                ]
            ]
        ];
        
        return $options;
    }

    // Foros publicados por fecha y estado
    public function postsPublished() {
        $posts = DB::table('posts')
            ->select(DB::raw('COUNT(posts.id) AS total, DATE(created_at) AS date'), 'is_visible')
            ->groupBy(DB::raw('DATE(created_at), is_visible'))
            ->get();

        // $series = [];
        // foreach ($posts as $key => $post) {
        //     $series[]
        // }

        $options = [
            'series' => [],
            'chart' => [
                'type' => 'bar'
            ],
            'plotOptions' => [
                'bar' => [
                    'horizontal' => false,
                    'columnWidth' => '55%',
                    'endingShape' => 'rounded'
                ]
            ],
            'dataLabels' => [
                'enabled' => false
            ],
            'stroke' => [
                'show' => true,
                'width' => 2,
                'colors' => ['transparent']
            ],
            'xaxis' => [
                'categories' => []
            ],
            'yaxis' => [
                'title' => [
                    'text' => 'prueba'
                ]
            ],
            'fill' => [
                'opacity' => 1
            ]
        ];
      
    }
}