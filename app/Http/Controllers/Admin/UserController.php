<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Task; // THÊM MODEL TASK
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Hiển thị danh sách users
     */
    public function index()
    {
        $users = User::where('role', 'user')
                    ->withCount('tasks') // ĐỔI THÀNH tasks (thay vì todos)
                    ->latest()
                    ->paginate(10);
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * Hiển thị form tạo user mới
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Lưu user mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect()->route('admin.users.index')
                        ->with('success', 'User created successfully.');
    }

    /**
     * Hiển thị chi tiết user
     */
    public function show(User $user)
    {
        // Chỉ cho xem user thường, không cho xem admin
        if ($user->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Lấy tasks của user với phân trang
        $tasks = $user->tasks()
                     ->latest()
                     ->paginate(10);
        
        return view('admin.users.show', compact('user', 'tasks'));
    }

    /**
     * Xóa user
     */
    public function destroy(User $user)
    {
        // Không cho xóa chính mình
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                            ->with('error', 'You cannot delete your own account.');
        }

        // Không cho xóa admin
        if ($user->isAdmin()) {
            return redirect()->route('admin.users.index')
                            ->with('error', 'Cannot delete admin users.');
        }

        // Xóa tasks của user trước
        $user->tasks()->delete();
        
        // Xóa user
        $user->delete();

        return redirect()->route('admin.users.index')
                        ->with('success', 'User deleted successfully.');
    }

    /**
     * Chuyển user thành admin
     */
    public function makeAdmin(User $user)
    {
        $user->update(['role' => 'admin']);
        
        return redirect()->route('admin.users.index')
                        ->with('success', 'User promoted to admin.');
    }
}