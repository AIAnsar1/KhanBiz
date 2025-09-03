<?php

namespace Tests\Unit;

use Tests\TestCase; // <- Laravel TestCase
use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use App\Models\Companies;

class CompaniesTest extends TestCase
{
    use RefreshDatabase;

    private function makeModel(array $overrides = []): Companies
    {
        return Companies::factory()->make($overrides);
    }

    private function createModel(array $overrides = []): Companies
    {
        return Companies::factory()->create($overrides);
    }

    public function test_can_create_model(): void
    {
        $model = $this->makeModel();
        $this->assertInstanceOf(Companies::class, $model);
    }

    public function test_can_store_model(): void
    {
        $model = $this->createModel();
        $this->assertDatabaseHas('companies', ['id' => $model->id]);
    }

    public function test_can_update_model(): void
    {
        $model = $this->createModel();
        $model->update(['legal_name' => 'legal_name']);
        $this->assertEquals('legal_name', $model->fresh()->legal_name);
    }

    public function test_can_delete_model(): void
    {
        $model = $this->createModel();
        $model->delete();
        // change crud_generators to your migration name
        $this->assertDatabaseMissing('companies', [
            'id' => $model->id,
        ]);
    }

    public function test_can_find_model(): void
    {
        $model = $this->createModel();
        $found = Companies::find($model->id);
        $this->assertNotNull($found);
        $this->assertEquals($model->id, $found->id);
    }
}
