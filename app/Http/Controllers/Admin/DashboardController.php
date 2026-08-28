<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\DashboardService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardService $dashboardService,
    ) {
    }

    public function index(): View
    {
        $stats = $this->dashboardService->getStats();

        return view('admin.dashboard.index', compact('stats'));
    }
}