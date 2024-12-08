<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskapiController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        switch ($request->method()) {
            case 'GET':
                return $this->index($request);
            case 'POST':
                return $this->store($request);
            case 'PUT':
                return $this->update($request, $request->id);
            case 'DELETE':
                return $this->destroy($request->id);
        }
    }




    public function index(Request $request)
    {
        $query = Task::query();

        if ($request->has('status') && in_array($request->status, ['pending', 'completed'])) {
            $query->where('status', $request->status);
        }

        $tasks = $query->get();
        return response()->json($tasks);
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

        $task = Task::create($request->all());
        return response()->json(['success' => true, 'message' => 'Task Created', 'task' => $task]);
    }


    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'status' => 'required|in:pending,completed',
            'category' => 'nullable',
            'due_date' => 'nullable|date',
        ]);

        $task->update($request->all());
        return response()->json(['success' => true, 'message' => 'Task Updated', 'task' => $task]);
    }





    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(['success' => true, 'message' => 'Task Deleted']);
    }


    public function restore($id)
    {
        $task = Task::withTrashed()->findOrFail($id);
        $task->restore();
        return response()->json(['success' => true, 'message' => 'Task Restored']);
    }




}
