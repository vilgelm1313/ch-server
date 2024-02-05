<?php

namespace Tests\Feature\Settings;

use App\Models\Settings\Country;
use Tests\Feature\BaseController;

class CountryControllerTest extends BaseController
{
    protected string $model = Country::class;
    protected string $apiPath = 'country';

    protected function getFields(): array
    {
        return [
            'name' => 'test',
            'code' => 'code',
            'is_active' => true,
        ];
    }

    public function testStoreWithExistingName()
    {
        $country = Country::factory()->create();
        $this->postJson('/country', $country->toArray())
            ->assertJson([
                'success' => false,
            ]);
    }
}
