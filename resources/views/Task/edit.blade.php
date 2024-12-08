@extends('layouts.master')
@section('css')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">List</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Edit</span>
						</div>
					</div>


				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                    <div class="container">
                        <h1 class="text-center mb-4">create new task</h1>
                        <form   id="create-task-form" class="bg-light p-4 rounded shadow">
                            @csrf
                            <div class="form-group">
                                <label for="title">title </label>
                                <input type="text" value="{{ $task->title }}" name="title" class="form-control" placeholder="أدخل عنوان المهمة" required>
                            </div>
                            <div class="form-group">
                                <label for="description">description</label>
                                <textarea name="description"  class="form-control" >{{ $task->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="status">status</label>
                                <select name="status">
                                    <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>pending</option>
                                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>completed</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="category"> (category)</label>
                                <input type="text"  value="{{ $task->category }}" name="category" class="form-control" placeholder="أدخل الفئة">
                            </div>

                            <div class="form-group">
                                <label for="due_date"> due_date||deadline</label>
                                <input type="date" name="due_date" class="form-control" value="{{ $task->due_date }}">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                            <a href="/tasks" class="btn btn-secondary btn-block mt-2">Back</a>
                        </form>
                        <div id="success-message" class="success-message" style="display:none;"></div>
                    </div>

                    {{-- <h1>Edit Task </h1>
                    <form action="{{ route('tasks.update', $task) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" name="title" value="{{ $task->title }}" required>
                        <textarea name="description">{{ $task->description }}</textarea>
                        <select name="status">
                            <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>pending</option>
                            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>completed</option>
                        </select>
                        <input type="text" name="category" value="{{ $task->category }}" placeholder=" (category)">
                        <button type="submit">Update</button>
                    </form> --}}









				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    $(document).ready(function() {
        $('#create-task-form').on('submit', function(e) {
            e.preventDefault(); // منع إعادة تحميل الصفحة

            $.ajax({
                url: '{{ route('tasks.update', $task) }}', // المسار لتخزين المهمة
                method: 'POST',
                data: $(this).serialize(), // إرسال البيانات من النموذج
                success: function(response) {
                    if (response.success) {
                        console.log(response);
                        // عرض رسالة النجاح باستخدام Toastr
                        toastr.success(response.message); // عرض الإشعار
                        $('#create-task-form')[0].reset(); // إعادة تعيين النموذج
                    }
                },
                error: function(xhr) {
                    // يمكنك إضافة معالجة الأخطاء هنا
                    console.error('حدث خطأ:', xhr);
                }
            });
        });
    });
</script>

@endsection
