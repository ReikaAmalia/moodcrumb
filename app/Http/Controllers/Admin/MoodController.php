<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\MoodService;

class MoodController extends Controller
{
    public function __construct(
        protected MoodService $moodService
    ) {
    }

    public function index()
    {
        $moods = $this->moodService->getAll();

        return view('admin.moods.index', compact('moods'));
    }

    public function create()
    {
        return view('admin.moods.create');
    }
}