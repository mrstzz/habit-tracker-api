<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreHabitRequest;
use App\Http\Requests\UpdateHabitRequest;
use App\Http\Resources\HabitResource;
use App\Models\Habit;
use App\Models\HabitLog;

class HabitController extends Controller
{
    public function index()
    {
        // return resource collection
        return HabitResource::collection(
            Habit::query()
                ->when(
                    str(request()->string('with', ''))->contains('user'),
                    fn ($query) => $query->with('user')
                )
                ->when(
                    str(request()->string('with', ''))->contains('logs'),
                    fn ($query) => $query->with('logs')
                )
                ->get()
        );
    }

    public function show(Habit $habit)
    {
        // return resource
        return HabitResource::make($habit->loadMissing(['user', 'logs']));
    }

    public function store(StoreHabitRequest $request)
    {
        $data = $request->only('uuid', 'title');

        $habit = Habit::create(array_merge($data, ['user_id' => 1]));

        return HabitResource::make($habit->loadMissing(['user', 'logs']));
    }

    public function update(UpdateHabitRequest $request, Habit $habit)
    {
        $data = $request->validated();

        $habit->update($data);

        return HabitResource::make($habit->loadMissing(['user', 'logs']));
    }

    public function destroy(Habit $habit)
    {
        HabitLog::whereHabitId($habit->id)->delete();
        $habit->delete();

        return response()->noContent();
    }
}
