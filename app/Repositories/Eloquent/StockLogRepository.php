<?php

namespace App\Repositories\Eloquent;

use App\Models\StockLog;
use App\Repositories\Interfaces\StockLogRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class StockLogRepository implements StockLogRepositoryInterface
{
    public function create(array $data): StockLog
    {
        return StockLog::query()->create($data);
    }

    /**
     * with('product'): eager-load relasi Product sekaligus,
     * supaya di Blade nanti $log->product tidak memicu query
     * tambahan satu-satu per baris (N+1 query problem).
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return StockLog::query()
            ->with('product')
            ->latest()
            ->paginate($perPage);
    }
}