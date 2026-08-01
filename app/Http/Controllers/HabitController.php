<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHabitRequest;
use App\Http\Requests\UpdateHabitRequest;
use Illuminate\Http\Request;
use App\Models\Habit;
use App\Http\Resources\HabitResource;
use App\Models\HabitLog;

class HabitController extends Controller
{

    public function index()
    {
        // return resource collection
        return HabitResource::collection(Habit::all());
    }

    public function show(Habit $habit)
    {
        // return resource
        return HabitResource::make($habit);
    }



    public function store(StoreHabitRequest $request)
    {
        $data = $request->only('uuid', 'title');


        $habit = Habit::create(array_merge($data, ['user_id' =>1]));
        // return resource
        return HabitResource::make($habit);
    }

    public function update(UpdateHabitRequest $request, Habit $habit)
    {
        $data = $request->validated();

        $habit->update($data);

        // return resource
        return HabitResource::make($habit);
    }

    public function destroy(Habit $habit)
    {
        HabitLog::whereHabitId($habit->id)->delete();
        $habit->delete();

        return response()->noContent();
    }
        
}