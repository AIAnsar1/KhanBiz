<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_category_inext_request(): void
    {
        $response = $this->get("/api/application/categories");
        $response->assertStatus(200);
    }

    public function test_post_category_store_request(): void
    {
        $response = $this->post("/api/application/categories", [
            "title" => "New Title",
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('categories', [
            "title" => "New Title",
        ]);
    }

    public function test_get_category_show_request(): void
    {
        $category = Category::factory()->create();
        $find = Category::find($category->id);
        $response = $this->get("/api/application/categories/{$category->id}");
        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $find->id);
    }

    public function test_put_category_update_request(): void
    {
        $category = Category::factory()->create();
        $response = $this->put("/api/application/categories/{$category->id}", [
            "title" => "Updated Title",
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('categories', [
            "title" => "Updated Title",
        ]);
    }

    public function test_delete_category_delete_request(): void
    {
        $category = Category::factory()->create();
        $response = $this->delete("/api/application/categories/{$category->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
