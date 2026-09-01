<?php

namespace App\Services\Admin;

use App\Models\Mood;
use App\Repositories\Interfaces\MoodRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class MoodService
{
    public function __construct(
        protected MoodRepositoryInterface $moodRepository
    ) {
    }

    public function getAll(): Collection
    {
        return $this->moodRepository->all();
    }

    public function getById(int $id): ?Mood
    {
        return $this->moodRepository->findById($id);
    }

    public function getBySlug(string $slug): ?Mood
    {
        return $this->moodRepository->findBySlug($slug);
    }

    public function create(array $data): Mood
    {
        $data['slug'] = $this->generateUniqueSlug($data['name']);

        return $this->moodRepository->create($data);
    }

    public function update(Mood $mood, array $data): Mood
    {
        if (isset($data['name']) && $data['name'] !== $mood->name) {
            $data['slug'] = $this->generateUniqueSlug(
                $data['name'],
                $mood->id
            );
        }

        return $this->moodRepository->update($mood, $data);
    }

    public function delete(Mood $mood): bool
    {
        return $this->moodRepository->delete($mood);
    }

    protected function generateUniqueSlug(
        string $name,
        ?int $ignoreId = null
    ): string {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (true) {
            $existingMood = $this->moodRepository->findBySlug($slug);

            if (
                ! $existingMood
                || ($ignoreId !== null && $existingMood->id === $ignoreId)
            ) {
                return $slug;
            }

            $slug = $originalSlug . '-' . $counter;

            $counter++;
        }
    }
}