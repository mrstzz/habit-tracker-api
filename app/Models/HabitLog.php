<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Traits\HasUuid;
class HabitLog extends Model
{
    use HasFactory;
    use HasUuid;
  

    public function habit(): BelongsTo
    {
        return $this->belongsTo(Habit::class);
    }
}
