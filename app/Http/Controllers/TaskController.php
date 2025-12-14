<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task; 
use App\Http\Requests\StoreTaskRequest; 
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $task =Task::all();// lấy tất cả dữ liệu bản ghi của bảng Task
        // $task =Task::paginate(10);//  mỗi trang có 10 bản ghi của bảng Task
        // Sắp xếp theo created_at (mặc định Laravel có created_at)
        $task = Task::with('user')->orderBy('due_date')
                    ->paginate(10);
        // Lấy 10 task từ database

        // Tải luôn user liên quan (không bị lỗi N+1 query)

        // Sắp xếp theo due_date (hạn chót)

        // Phân trang (chia thành các trang)
        return view('task.index',compact('task'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $data = array_merge($request->all(),[
            'user_id'=>Auth::id()
        ]);
        Task::create($data);
        return redirect()->route('tasks.index')
            ->with('success','Create new task successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id);
        return view('task.show',compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //tìm ra thằng đang edit hiện tại tìm id của nó
         $task = Task::findOrFail($id);
         return view('task.edit',compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTaskRequest $request, string $id)
    {
         $task = Task::findOrFail($id);
         $task->update($request->all());
         return redirect()->route('tasks.index')
             ->with('success','Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        
        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully!');
    }
}
