<?php

namespace App\Repositories;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class SliderRepository
{
    public function allActive(): Collection
    {
        return Slider::where('status', true)
            ->orderByDesc('id')
            ->get();
    }

    public function paginate(string $search = '', int $perPage = 10)
    {
        return Slider::with('media')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('subtitle', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function find(int $id): ?Slider
    {
        return Slider::with('media')->find($id);
    }

    public function create(array $data): Slider
    {
        return Slider::create($data);
    }

    public function update(Slider $slider, array $data): Slider
    {
        $slider->update($data);

        return $slider;
    }

    public function delete(Slider $slider): bool
    {
        return $slider->delete();
    }
}
