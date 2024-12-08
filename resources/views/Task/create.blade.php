@extends('layouts.master')
@section('css')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">list</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Create</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <!-- row -->
    <div class="row">

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

        <div class="container mt-5">
            <h1 class="text-center mb-4">  Add New Task</h1>
            <form id="create-task-form" class="bg-light p-4 rounded shadow">
                @csrf
                <div class="form-group">
                    <label for="title"> title</label>
                    <input type="text" name="title" class="form-control"  required>
                </div>
                <div class="form-group">
                    <label for="description">description</label>
                    <textarea name="description" class="form-control" ></textarea>
                </div>
                <div class="form-group">
                    <label for="status">status</label>
                    <select name="status" class="form-control">
                        <option value="pending">pending</option>
                        <option value="completed">completed</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="category"> (category)</label>
                    <input type="text" name="category" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="due_date">due_date|deadline</label>
                    <input type="date" name="due_date" class="form-control" placeholder="أدخل تاريخ الاستحقاق">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Create</button>
                <a href="tasks" class="btn btn-secondary btn-block mt-2">Back</a>
            </form>
            <div id="success-message" class="mt-3" style="display:none; color: green;"></div>
        </div>





    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#create-task-form').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route('tasks.store') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            toastr.success(response.message);
                            $('#create-task-form')[0].reset();

                        }
                    },
                    error: function(xhr) {

                        console.error('حدث خطأ:', xhr);
                    }
                });
            });
        });
    </script>
@endsection
