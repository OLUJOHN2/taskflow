<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Fetch metrics related to user's projects and assigned tasks
        $totalProjects = Project::where('owner_id', $user->id)->count();
        $activeProjects = Project::where('owner_id', $user->id)->where('status', 'active')->count();
        $completedProjects = Project::where('owner_id', $user->id)->where('status', 'completed')->count();

        $totalTasks = Task::where('assigned_to', $user->id)->orWhere('created_by', $user->id)->count();
        $pendingTasks = Task::where('assigned_to', $user->id)->where('status', 'todo')->count();
        $inProgressTasks = Task::where('assigned_to', $user->id)->where('status', 'in_progress')->count();
        $completedTasks = Task::where('assigned_to', $user->id)->where('status', 'completed')->count();
        
        $overdueTasks = Task::where('assigned_to', $user->id)
            ->where('status', '!=', 'completed')
            ->where('due_date', '<', now())
            ->count();

        $recentProjects = Project::where('owner_id', $user->id)->latest()->take(5)->get();
        $recentTasks = Task::where('assigned_to', $user->id)->orWhere('created_by', $user->id)->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalProjects',
            'activeProjects',
            'completedProjects',
            'totalTasks',
            'pendingTasks',
            'inProgressTasks',
            'completedTasks',
            'overdueTasks',
            'recentProjects',
            'recentTasks'
        ));
    }
}