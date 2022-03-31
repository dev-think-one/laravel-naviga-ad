<?php

namespace NavigaAdClient\Responses;

use Illuminate\Http\Client\Response;
use NavigaAdClient\Requests\PaginatedRequest;

class PaginatedResponse extends Response
{
    protected PaginatedRequest $request;
    protected array $query = [];

    public function __construct($response, PaginatedRequest $request, array $query = [])
    {
        parent::__construct($response);
        $this->request = $request;
        $this->query   = $query;
    }

    public function entities(?string $class = null): array
    {
        $items = $this->json('Results');
        if (!is_array($items)) {
            return [];
        }
        if ($class) {
            $items = array_map(fn ($item) => new $class($item), $items);
        }

        return $items;
    }

    public function currentPage(): int
    {
        return (int ) $this->json('PageNumber');
    }

    public function countEntities(): int
    {
        return (int ) $this->json('PageSize');
    }

    public function isEmpty(): bool
    {
        return $this->json('PageSize') <= 0;
    }

    public function totalPages(): int
    {
        return (int ) $this->json('TotalNumberOfPages');
    }

    public function totalEntities(): int
    {
        return (int ) $this->json('TotalNumberOfRecords');
    }

    public function hasNext(): bool
    {
        return $this->currentPage() < $this->totalPages();
    }

    public function hasPrev(): bool
    {
        return $this->currentPage() > 1;
    }

    public function nextPage(): ?static
    {
        if (!$this->hasNext()) {
            return null;
        }

        return $this->request->setCurrentPage($this->currentPage() + 1)->retrieve($this->query);
    }

    public function prevPage(): ?static
    {
        if (!$this->hasPrev()) {
            return null;
        }

        return $this->request->setCurrentPage($this->currentPage() + 1)->retrieve($this->query);
    }
}
