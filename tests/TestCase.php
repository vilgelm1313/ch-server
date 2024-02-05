<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use ReflectionClass;
use ReflectionMethod;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    protected static function getProtectedMethod(string $class, string $method): ReflectionMethod
    {
        $class = new ReflectionClass($class);
        $m = $class->getMethod($method);
        $m->setAccessible(true);

        return $m;
    }
}
