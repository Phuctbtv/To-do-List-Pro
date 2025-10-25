<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Vite;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Sets up the tests.
     */
    protected function setUp(): void
    {
        parent::setUp();
        Vite::preventStubs();
    }
}
