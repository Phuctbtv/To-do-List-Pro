<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Vite; // <-- Thêm dòng này

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Sets up the tests.
     */
    protected function setUp(): void
    {
        parent::setUp();
        Vite::preventStubs(); // <-- Dòng này sẽ sửa lỗi của bạn
    }
}
