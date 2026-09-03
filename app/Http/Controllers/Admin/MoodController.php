<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMoodRequest;
use App\Http\Requests\Admin\UpdateMoodRequest;
use App\Models\Mood;
use App\Services\Admin\MoodService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MoodController extends Controller
{
    public function __construct(
        protected MoodService $moodService
    ) {
    }

    /**
     * Display a listing of moods.
     */
    public function index(): View
    {
        $moods = $this->moodService->getAll();

        return view('admin.moods.index', compact('moods'));
    }

    /**
     * Show the form for creating a new mood.
     */
    public function create(): View
    {
        return view('admin.moods.create');
    }

    /**
     * Store a newly created mood.
     */
    public function store(
        StoreMoodRequest $request
    ): RedirectResponse {
        $this->moodService->create(
            $request->validated()
        );

        return redirect()
            ->route('admin.moods.index')
            ->with(
                'success',
                'Mood berhasil ditambahkan.'
            );
    }

    /**
     * Display the specified mood.
     */
    public function show(Mood $mood): View
    {
        return view(
            'admin.moods.show',
            compact('mood')
        );
    }

    /**
     * Show the form for editing the specified mood.
     */
    public function edit(Mood $mood): View
    {
        return view(
            'admin.moods.edit',
            compact('mood')
        );
    }

    /**
     * Update the specified mood.
     */
    public function update(
        UpdateMoodRequest $request,
        Mood $mood
    ): RedirectResponse {
        $this->moodService->update(
            $mood,
            $request->validated()
        );

        return redirect()
            ->route('admin.moods.index')
            ->with(
                'success',
                'Mood berhasil diperbarui.'
            );
    }

    /**
     * Remove the specified mood.
     */
    public function destroy(
        Mood $mood
    ): RedirectResponse {
        $this->moodService->delete($mood);

        return redirect()
            ->route('admin.moods.index')
            ->with(
                'success',
                'Mood berhasil dihapus.'
            );
    }
}