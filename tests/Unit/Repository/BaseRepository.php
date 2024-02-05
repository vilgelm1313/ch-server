<?php

namespace Tests\Unit\Repository;

use App\Events\Model\ModelDestroyed;
use App\Events\Model\ModelStored;
use App\Events\Model\ModelUpdated;
use App\Models\BaseModel;
use App\Repositories\BaseRepository as Repository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

abstract class BaseRepository extends TestCase
{
    use RefreshDatabase;

    protected Repository $repository;
    protected BaseModel $model;
    protected string $repositoryClass;
    protected string $modelClass;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = new $this->repositoryClass();
        $this->model = $this->modelClass::factory()->create();
        Event::fake();
    }

    public function testShow()
    {
        $repositoryModel = $this->repository->show($this->model->id);

        $this->assertEquals($this->model->id, $repositoryModel->id);
    }

    public function testIndex()
    {
        /**
         * @var LengthAwarePaginator
         */
        $models = $this->repository->index(10);

        $this->assertInstanceOf(LengthAwarePaginator::class, $models);
        $this->assertTrue($models->items()[0]->id === $this->model->id);
    }

    public function testUpdate()
    {
        $fields = $this->getFields();
        $repositoryModel = $this->repository->update($this->model->id, $fields);
        Event::assertDispatched(ModelUpdated::class);

        $keys = array_keys($fields);

        foreach ($keys as $key) {
            if ($key === 'password') {
                $this->assertTrue(Hash::check($fields[$key], $repositoryModel->password));
            } else {
                $this->assertEquals($fields[$key], $repositoryModel->{$key});
            }
        }
    }

    public function testDestroy()
    {
        $this->repository->destroy($this->model->id);
        $this->assertDatabaseMissing($this->model->getTable(), ['id' => $this->model->id]);
        Event::assertDispatched(ModelDestroyed::class);
    }

    public function testStore()
    {
        $model = $this->repository->store($this->getFields());
        $this->assertDatabaseHas($this->model->getTable(), [
            'id' => $model->id,
        ]);
        Event::assertDispatched(ModelStored::class);
    }

    public function testGetClass()
    {
        $class = $this->getClass($this->repositoryClass);

        $this->assertEquals($this->modelClass, $class);
    }

    public function testActivation()
    {
        $fields = $this->getFields();
        if (!isset($fields['is_active'])) {
            $this->assertTrue(true);
        } else {
            $this->model->is_active = false;
            $this->model->save();
            $model = $this->repository->activate($this->model->id);
            $this->assertTrue($model->is_active);
            $this->assertDatabaseHas($model->getTable(), [
                'id' => $model->id,
                'is_active' => true,
            ]);
        }
    }

    public function testDeactivation()
    {
        $fields = $this->getFields();
        if (!isset($fields['is_active'])) {
            $this->assertTrue(true);
        } else {
            $this->model->is_active = true;
            $this->model->save();
            $model = $this->repository->deactivate($this->model->id);
            $this->assertFalse($model->is_active);
            $this->assertDatabaseHas($model->getTable(), [
                'id' => $model->id,
                'is_active' => false,
            ]);
        }
    }

    protected function getClass(string $repositoryClass): string
    {
        $rep = new $repositoryClass();
        $method = $this->getProtectedMethod($repositoryClass, 'getClass');
        $class = $method->invokeArgs($rep, []);

        return $class;
    }

    abstract protected function getFields(): array;
}
