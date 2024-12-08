<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {

    $query = Task::query();


    if ($request->has('status') && in_array($request->status, ['pending', 'completed'])) {
        $query->where('status', $request->status);
    }

    $tasks = $query->get();
    return view('task.index', compact('tasks'));
    }






    public function create()
    {
        return view('task.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'status' => 'required|in:pending,completed',
            'category' => 'nullable',
            'due_date' => 'nullable|date',
        ]);

        Task::create($request->all());
        // return redirect()->route('tasks.index')->with('success', 'Task Created');
        return response()->json(['success' => true, 'message' => 'Task Created']);

    }

    public function edit(Task $task)
    {
        return view('task.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required|in:pending,completed',
            'category' => 'nullable',
            'due_date' => 'nullable|date',
        ]);

        $task->update($request->all());
        return redirect()->route('task.index');
    }








//////////////////////////////////update stutas//////////////////
    public function updatestatus(Request $request, Task $task)
    {
        $request->validate([
             'title' => 'required',
            'status' => 'required|in:pending,completed',
             'category' => 'nullable',
             'due_date' => 'nullable|date',
        ]);

        $task->update($request->all());
        return response()->json(['success' => true]);
    }



 //////////////////////////////// delete and soft delete /////////////
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Delete successfuly');;
    }


    public function trashed()
{
    $tasks = Task::onlyTrashed()->get(); // الحصول على المهام المحذوفة
    return view('task.trashed', compact('tasks'));
}

public function restore($id)
{
    $task = Task::withTrashed()->find($id);
    $task->restore(); // استعادة المهمة
    return redirect()->route('tasks.trashed')->with('success', 'تم استعادة المهمة بنجاح.');
}


public function forceDelete($id)
{
    $task = Task::withTrashed()->find($id);
    $task->forceDelete(); // حذف المهمة نهائيًا
    return redirect()->route('tasks.trashed')->with('success', 'تم حذف المهمة نهائيًا.');
}

}
