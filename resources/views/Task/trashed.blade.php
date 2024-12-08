@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4"> Deleted Tasks</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>title </th>
                <th>description</th>
                <th>status</th>
                <th>category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->category }}</td>
                    <td>
                        <form action="{{ route('tasks.restore', $task) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success btn-sm">Restore</button>
                        </form>
                        <form action="{{ route('tasks.forceDelete', $task) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Sold Delete </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
</div>
@endsection
