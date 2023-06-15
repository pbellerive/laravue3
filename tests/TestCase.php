<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    const UNAUTHORIZE = 403;
    const NOT_FOUND = 404;
    const UNPROCESSABLE_ENTITY = 422;
    const SUCCESSFULLY_CREATED = 201;

    public function setUp(): void
    {
        parent::setUp();

        // $this->withoutExceptionHandling();

        $this->artisan('migrate:refresh', [
            '--seed' => '1'
        ]);

    }
}
