<?php

namespace App\Repositories\Interfaces;

use App\Models\Mood;
use Illuminate\Database\Eloquent\Collection;

interface MoodRepositoryInterface
{
    public function all(): Collection;

    public function findById(int $id): ?Mood;

    public function findBySlug(string $slug): ?Mood;

    public function create(array $data): Mood;

    public function update(Mood $mood, array $data): Mood;

    public function delete(Mood $mood): bool;
}