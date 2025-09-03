<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\CrudGenerator;

class CrudGeneratorTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_crudgenerator_inext_request(): void
    {
        $response = $this->get("/api/application/crudgenerators");
        $response->assertStatus(200);
    }

    public function test_post_crudgenerator_store_request(): void
    {
        $response = $this->post("/api/application/crudgenerators", [

        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('crud_generator', [

        ]);
    }

    public function test_get_crudgenerator_show_request(): void
    {
        $crudgenerator = CrudGenerator::factory()->create();
        $find = CrudGenerator::find($crudgenerator->id);
        $response = $this->get("/api/application/crudgenerators/{$crudgenerator->id}");
        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $find->id);
    }

    public function test_put_crudgenerator_update_request(): void
    {
        $crudgenerator = CrudGenerator::factory()->create();
        $response = $this->put("/api/application/crudgenerators/{$crudgenerator->id}", [

        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('crud_generator', [

        ]);
    }

    public function test_delete_crudgenerator_delete_request(): void
    {
        $crudgenerator = CrudGenerator::factory()->create();
        $response = $this->delete("/api/application/crudgenerators/{$crudgenerator->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('crud_generator', ['id' => $crudgenerator->id]);
    }
}
