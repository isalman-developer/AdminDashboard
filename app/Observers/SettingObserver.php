<?php

namespace App\Observers;

use App\Models\Setting;
use App\Repositories\SettingRepository;

class SettingObserver
{
    public function __construct(
        protected SettingRepository $repository
    ) {}

    /**
     * Handle the Setting "created" event.
     */
    public function created(Setting $setting): void
    {
        $this->repository->forgetKey($setting->key);
    }

    /**
     * Handle the Setting "updated" event.
     */
    public function updated(Setting $setting): void
    {
        $this->repository->forgetKey($setting->key);
    }

    /**
     * Handle the Setting "deleted" event.
     */
    public function deleted(Setting $setting): void
    {
        $this->repository->forgetKey($setting->key);
    }
}
