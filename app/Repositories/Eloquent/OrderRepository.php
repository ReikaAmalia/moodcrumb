<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\OrderRepositoryInterface;
use Carbon\CarbonInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function count(): int
    {
        return 0;
    }

    public function countByDate(CarbonInterface $date): int
    {
        return 0;
    }
}
