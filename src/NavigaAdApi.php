<?php

namespace NavigaAdClient;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use NavigaAdClient\Requests\PaginatedRequest;

class NavigaAdApi
{
    protected PendingRequest $client;

    public function __construct(
        array  $credentials,
        string $baseUrl,
        array  $options = [],
    ) {
        $client = Http::baseUrl(rtrim($baseUrl, '/').'/');

        if (isset($credentials['username']) && isset($credentials['password'])) {
            $client->withBasicAuth($credentials['username'], $credentials['password']);
        } elseif (isset($credentials['bearer'])) {
            $client->withToken($credentials['bearer']);
        }

        if (isset($options['guzzle'])) {
            $client->withOptions($options['guzzle']);
        }

        if (isset($options['retry'])) {
            $client->retry(...$options['retry']);
        }

        if (isset($options['timeout'])) {
            $client->timeout($options['timeout']);
        }

        if (isset($options['headers'])) {
            $client->withHeaders($options['headers']);
        }

        $this->client = $client;
    }

    public function pendingRequest(): PendingRequest
    {
        return clone $this->client;
    }

    public function paginatedRequest(
        string $endpoint,
        int    $perPage = 20,
        int    $currentPage = 1
    ): PaginatedRequest {
        return new PaginatedRequest($this, $endpoint, $perPage, $currentPage);
    }
}
