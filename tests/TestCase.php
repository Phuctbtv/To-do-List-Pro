<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
// Chúng ta không cần 'use Illuminate\Support\Facades\Vite;' nữa

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Sets up the tests.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Thay thế dòng code cũ bằng dòng code này
        $this->withoutVite(); 
    }
}
