<?php

namespace Tests\Feature\Settings;

use App\Models\Settings\Tariff;
use Tests\Feature\BaseController;

class TariffControllerTest extends BaseController
{
    protected string $model = Tariff::class;
    protected string $apiPath = 'tariff';

    protected function getFields(): array
    {
        return [
            'name' => 'test',
            'is_active' => false,
            'index' => 1,
            'key' => 'test',
        ];
    }

    public function testStoreWithExistingName()
    {
        $tariff = Tariff::factory()->create();
        $this->postJson('/tariff', $tariff->toArray())
            ->assertJson([
                'success' => false,
            ]);
    }
}
