<?php

declare(strict_types = 1);


namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Traits\HasUuid;

class Habit extends Model
{
    use HasFactory;
    use HasUuid;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

      protected static function boot(): void
    {
        parent::boot();


        static::creating(function (self $log){
            $log->uuid = (string) Str::uuid();
        });

        static::updating(function (self $log){
            if($log->isDirty('completed_at')) {
                unset($log->uuid);
            }
        });
    }
    public function logs(): HasMany
    {
        return $this->hasMany(HabitLog::class);
    }
}
