<?php

namespace App\Repositories\Eloquent;

use App\Models\Mood;
use App\Repositories\Interfaces\MoodRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class MoodRepository implements MoodRepositoryInterface
{
    public function all(): Collection
    {
        return Mood::query()
            ->orderBy('name')
            ->get();
    }

    public function findById(int $id): ?Mood
    {
        return Mood::query()->find($id);
    }

    public function findBySlug(string $slug): ?Mood
    {
        return Mood::query()
            ->where('slug', $slug)
            ->first();
    }

    public function create(array $data): Mood
    {
        return Mood::query()->create($data);
    }

    public function update(Mood $mood, array $data): Mood
    {
        $mood->update($data);

        return $mood->fresh();
    }

    public function delete(Mood $mood): bool
    {
        return (bool) $mood->delete();
    }
}