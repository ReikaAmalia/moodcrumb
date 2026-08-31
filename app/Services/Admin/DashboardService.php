<?php

namespace App\Services\Admin;

use App\Repositories\Interfaces\OrderRepositoryInterface;

class DashboardService
{
    public function __construct(
        protected OrderRepositoryInterface $orderRepository
    ) {
    }

    public function getStats(): array
    {
        return [
            'total_orders' => $this->orderRepository->count(),
            'today_orders' => $this->orderRepository->countByDate(now()),
        ];
    }
}