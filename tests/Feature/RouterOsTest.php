<?php

namespace Tests\Feature;

use App\Api\RouterosAPI;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class RouterOsTest extends TestCase
{
    public function testSingleton()
    {
        $obj1 = App::make(RouterosAPI::class);
        $obj2 = App::make(RouterosAPI::class);

        $this->assertSame($obj1, $obj2);
    }
}
