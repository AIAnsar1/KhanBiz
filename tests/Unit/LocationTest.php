<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Locations;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LocationTest extends TestCase
{
   use RefreshDatabase;

   private function makeModel(array $overrides = []): Locations
   {
        return Locations::factory()->make($overrides);
   }

   private function createModel(array $overrides = []): Locations
   {
        return Locations::factory()->create($overrides);
   }

   public function test_can_create_model(): void
   {
        $model = $this->makeModel();
        $this->assertInstanceOf(Locations::class, $model);
   }

   public function test_can_store_model(): void
   {
        $model = $this->createModel();
        $this->assertDatabaseHas('locations', ['id' => $model->id]);
   }

    public function test_can_update_model(): void
    {
        $model = $this->createModel();
        $model->update(['country_code' => 'US']);
        $this->assertEquals('US', $model->fresh()->country_code);
    }

    public function test_can_delete_model(): void
    {
        $model = $this->createModel();
        $model->delete();
        // change crud_generators to your migration name
        $this->assertDatabaseMissing('locations', [
            'id' => $model->id,
        ]);
    }

    public function test_can_find_model(): void
    {
        $model = $this->createModel();
        $found = Locations::find($model->id);
        $this->assertNotNull($found);
        $this->assertEquals($model->id, $found->id);
    }
}
