<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

abstract class UserStampModel extends Model
{
    public static function boot(): void
    {
        parent::boot();

        if (!app()->runningInConsole() || !app()->runningInConsole() && app()->runningCommand() !== 'db:seed') {
            static::creating(function ($model) {
                $model->created_by = Auth::id();
            });

            static::saving(function ($model) {
                $model->updated_by = Auth::id();
            });
        }
    }

    public function created_by(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function updated_by(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }
}
