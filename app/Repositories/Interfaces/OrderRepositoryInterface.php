<?php

namespace App\Repositories\Interfaces;

use Carbon\CarbonInterface;

interface OrderRepositoryInterface
{
    public function count(): int;

    public function countByDate(CarbonInterface $date): int;
}