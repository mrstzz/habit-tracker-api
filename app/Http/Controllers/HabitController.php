<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHabitRequest;
use Illuminate\Http\Request;
use App\Models\Habit;
use App\Http\Resources\HabitResource;

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
        
}