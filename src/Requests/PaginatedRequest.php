<?php

namespace NavigaAdClient\Requests;

use NavigaAdClient\NavigaAdApi;
use NavigaAdClient\Responses\PaginatedResponse;

class PaginatedRequest
{
    protected NavigaAdApi $api;

    protected string $endpoint;
    protected int $perPage;
    protected int $currentPage;

    public function __construct(
        NavigaAdApi $api,
        string      $endpoint,
        int         $perPage = 20,
        int         $currentPage = 1,
    ) {
        $this->api = $api;

        throw_if(empty($endpoint));
        $this->endpoint = $endpoint;

        $this->setPerPage($perPage);
        $this->setCurrentPage($currentPage);
    }

    public function endpoint(): string
    {
        return $this->endpoint;
    }

    public function perPage(): int
    {
        return $this->perPage;
    }

    public function currentPage(): int
    {
        return $this->currentPage;
    }

    public function setPerPage(int $perPage): static
    {
        throw_if($perPage <= 0);
        $this->perPage = $perPage;

        return $this;
    }

    public function setCurrentPage(int $currentPage): static
    {
        throw_if($currentPage <= 0);
        $this->currentPage = $currentPage;

        return $this;
    }

    public function retrieve(array $query = []): PaginatedResponse
    {
        $response = $this->api->pendingRequest()->get($this->endpoint, array_merge($query, [
            'page'     => $this->currentPage,
            'pageSize' => $this->perPage,
        ]));

        return new PaginatedResponse($response, clone $this, $query);
    }
}
