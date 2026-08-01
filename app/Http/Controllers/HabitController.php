<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHabitRequest;
use Illuminate\Http\Request;
use App\Models\Habit;
use App\Http\Resources\HabitResource;

class HabitController extends Controller
{
    public function store(StoreHabitRequest $request)
    {
        $data = $request->validated();

        $habit = Habit::create($data);
        // return resource
        return HabitResource::make($habit);
    }
}
