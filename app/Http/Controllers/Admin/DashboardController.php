<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Task; // ĐỔI THÀNH TASK

class DashboardController extends Controller
{
    /**
     * Hiển thị trang dashboard admin
     */
    // app/Http\Controllers\Admin\DashboardController.php
    public function index()
    {
        // Thống kê tổng quan
        $stats = [
            'total_users' => User::where('role', 'user')->count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'new_users_today' => User::whereDate('created_at', today())->count(),
        ];

        // Thống kê cho Task
        $stats['total_tasks'] = Task::count();
        $stats['not_started_tasks'] = Task::where('status', Task::NOT_STARTED)->count();
        $stats['in_progress_tasks'] = Task::where('status', Task::IN_PROGRESS)->count();
        $stats['completed_tasks'] = Task::where('status', Task::COMPLETED)->count();
        
        // Lấy 10 tasks mới nhất
        $recent_tasks = Task::with('user')
                        ->latest()
                        ->take(10)
                        ->get();

        // Lấy 10 users mới nhất với số lượng tasks
        $recent_users = User::withCount('tasks')
                        ->latest()
                        ->take(10)
                        ->get();

        return view('admin.dashboard.index', compact('stats', 'recent_tasks', 'recent_users'));
    }
}