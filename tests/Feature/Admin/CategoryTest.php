<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\Paginator;

use Tests\TestCase;

use App\Models\Category;
use App\Models\User;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    // Listado de categorias
    public function test_categories_get() {
        $this->withoutExceptionHandling();
        
        $count = 10;
        $search = '';
        $user = User::factory()->create();
        Category::factory()->count($count)->create();
        
        $response = $this->actingAs($user)->get(route('admin.categories.index'));
        
        $categories = Category::searchAndPaginate();

        $response->assertOk();
        $response->assertViewIs('admin.categories.index');
        $response->viewData('categories');
        $this->assertInstanceOf(Paginator::class, $response->viewData('categories'));

        $this->assertDatabaseCount('categories', $count);
    }

    public function test_category_view_create() {
        $this->withoutExceptionHandling();
        
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.categories.create'));

        $response->assertOk();
        $response->assertViewIs('admin.categories.create');
    }

    public function test_category_save() {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $category = Category::factory()->make()->toArray();

        $response = $this->actingAs($user)->post(route('admin.categories.store'), $category);

        $response->assertStatus(302);

        $this->assertDatabaseCount('categories', 1);
    }

    // public function test_category_name_is_required() {
    //     $this->withoutExceptionHandling();

    //     $user = User::factory()->create();
    //     $category = Category::factory()->make([]);
        
    //     $response = $this->actingAs($user)->post(route('admin.categories.store'), $category->toArray());
    //         // ->assertStatus(422);
    //     $response->assertSessionHasErrors(['name' => 'Name is required']);
    // }

    // public function testShow() {
    //     $this->withoutExceptionHandling();

    //     $user = User::factory()->create();
    //     $category = Category::factory()->create();
        
    //     $response = $this->actingAs($user)->get('/admin/categories/'.$category->id);

    //     $response->assertOk();
    // }
}
