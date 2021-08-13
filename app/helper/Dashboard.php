<?php

namespace App\Helper;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            ->select(DB::raw('COUNT(posts.id) AS total, DATE_FORMAT(DATE(created_at), "%M") AS date'), 'is_visible')
            ->groupBy(DB::raw('date, is_visible'))
            ->orderBy(DB::raw('created_at'))
            ->get();
            
        $categories = [];
        $dataVisibles = [];
        $dataNotVisibles = [];
        foreach ($posts as $key => $post) {
            if (!in_array($post->date, $categories)) {
                $categories[] = $post->date;
            }

            if ($post->is_visible) {
                $dataVisibles[] = $post->total;
            } else {
                $dataNotVisibles[] = $post->total;
            }
        }
        
        $options = [
            'series' => [
                [
                    'name' => 'Visibles',
                    'data' => $dataVisibles
                ],
                [
                    'name' => 'No Visibles',
                    'data' => $dataNotVisibles
                ]
            ],
            'chart' => [
                'type' => 'bar',
                'toolbar' => [
                    'tools' => [
                        'download' => false
                    ]
                ]
            ],
            'plotOptions' => [
                'bar' => [
                    'horizontal' => false,
                    'columnWidth' => '25%',
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
                'categories' => $categories
            ],
            'yaxis' => [
                'title' => [
                    'text' => 'Foros publicados'
                ]
            ],
            'fill' => [
                'opacity' => 1
            ]
        ];
      
        return $options;
    }
}