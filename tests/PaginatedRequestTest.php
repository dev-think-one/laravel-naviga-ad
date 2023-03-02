<?php

namespace NavigaAdClient\Tests;

use Illuminate\Support\Facades\Http;
use NavigaAdClient\NavigaAd;
use NavigaAdClient\Responses\PaginatedResponse;

class PaginatedRequestTest extends TestCase
{
    /** @test */
    public function simple_request()
    {
        Http::fake(function (\Illuminate\Http\Client\Request $request) {
            if ($request->data()['page'] ==  2) {
                $this->assertStringStartsWith('Basic ', $request->header('Authorization')[0]);
                $this->assertEquals('test.request', $request->header('Host')[0]);
                $this->assertEquals('bar', $request->data()['foo']);
                $this->assertEquals('2', $request->data()['page']);
                $this->assertEquals('16', $request->data()['pageSize']);

                return Http::response(json_encode([
                    'PageNumber'           => 3,
                    'PageSize'             => 5,
                    'TotalNumberOfPages'   => 8,
                    'TotalNumberOfRecords' => 38,
                    'Results'              => [
                        ['foo1' => 'bar1'],
                        ['foo2' => 'bar2'],
                        ['foo3' => 'bar3'],
                        ['foo4' => 'bar4'],
                        ['foo5' => 'bar5'],
                    ],
                ]), 200);
            } else {
                return Http::response(json_encode([]), 200);
            }
        });

        /** @var PaginatedResponse $response */
        $response = NavigaAd::paginatedRequest('book/ordertypes', 16, 2)->retrieve([
            'foo' => 'bar',
        ]);

        $this->assertCount(5, $response->entities());
        $this->assertEquals(3, $response->currentPage());
        $this->assertEquals(5, $response->countEntities());
        $this->assertFalse($response->isEmpty());
        $this->assertEquals(8, $response->totalPages());
        $this->assertEquals(38, $response->totalEntities());
        $this->assertTrue($response->hasPrev());
        $this->assertTrue($response->hasNext());


        $nextResponse = $response->nextPage();
        $this->assertNull($nextResponse->nextPage());
        $prevResponse = $response->prevPage();
        $this->assertNull($prevResponse->prevPage());
    }
}
