<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Assignee;
use App\Models\Task;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskAssignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'deadline' => 'required|date',
            'team' => 'required|string|max:255',
            'members' => 'required|array',
            'description' => 'sometimes|string|max:1000',
        ]);
    
        // Create Task
        $task = Task::create([
            'title' => $request->title,
            'deadline' => $request->deadline,
            'description' => $request->description,
        ]);
    
        // Find or create the Team
        $team = Team::firstOrCreate(['name' => $request->team]);
    
        // Store in task_team pivot table
        $task->teams()->attach($team->id);
    
        // Store assignees (task-user relationship)
        foreach ($request->members as $userId) {
            DB::table('assignees')->insert([
                'task_id' => $task->id,
                'user_id' => $userId,
                'assigned_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    
        return redirect()->route('dashboard')->with('success', 'Task created successfully!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
