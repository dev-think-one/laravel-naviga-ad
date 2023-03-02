<?php

namespace NavigaAdClient\Tests;

use Illuminate\Support\Facades\Http;
use NavigaAdClient\NavigaAd;

class GeneralRequestTest extends TestCase
{
    /** @test */
    public function simple_request()
    {
        Http::fake(function (\Illuminate\Http\Client\Request $request) {
            $this->assertStringStartsWith('Basic ', $request->header('Authorization')[0]);
            $this->assertEquals('test.request', $request->header('Host')[0]);

            return Http::response(json_encode([]), 200);
        });
        $response = NavigaAd::pendingRequest()->get('/api/ad/sizes');
    }
}
