<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Public landing page.
     */
    public function index(): View
    {
        return view('customer.home.index');
    }

    /**
     * Customer dashboard.
     */
    public function dashboard(): View
    {
        return view('customer.dashboard.index');
    }
}