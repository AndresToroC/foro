<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helper\Dashboard;

class DashboardController extends Controller
{
    public function index() {
        $dashboard = new Dashboard;

        $data = $dashboard->data();
        $postsCategories = $dashboard->postsCategories();
        $postsPublished = $dashboard->postsPublished();
        
        return view('admin.dashboard', compact('data', 'postsCategories'));
    }
}
