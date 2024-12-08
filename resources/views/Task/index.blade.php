@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">list of Tasks</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Empty</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
@if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- row -->
    <div class="row">



                    <a href="{{ route('tasks.create')}}"  class="btn btn-primary"> Create New Task</a>
                    <a href="{{ route('tasks.trashed') }}" class="btn btn-warning">trashed/Restore</a>

        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">list of Tasks</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div >
                <form method="GET" action="{{ route('tasks.index') }}" class="mb-4">
                    <div class="form-row align-items-end">
                        <div class="col-auto">
                            <select name="status" class="form-control">
                                <option value="">Choose the status</option>
                                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>

                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>pending</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>completed</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
                </div>







                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr class="table-success" style="text-align: center">
                                    <th class="border-bottom-0">id</th>
                                    <th class="border-bottom-0">title</th>
                                    <th class="border-bottom-0">status</th>
                                    <th class="border-bottom-0">Descreption</th>
                                    <th class="border-bottom-0">Category</th>
                                    <th class="border-bottom-0">due_date</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($tasks as $task)
                                    <?php $i++; ?>
                                    <tr style="text-align: center">
                                        <td>{{ $i }}</td>
                                        <td>{{ $task->title }}</td>
                                        {{-- <td>{{ $task->status }}</td> --}}
                                        <td>


                                            <select class="status-select" data-request-id="{{ $task->id }}">
                                                <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>
                                                    pending</option>
                                                <option value="completed"
                                                    {{ $task->status == 'completed' ? 'selected' : '' }}>completed</option>
                                            </select>


                                        </td>
                                        <td>{{ $task->description }}</td>
                                        <td>{{ $task->category }}</td>
                                        <td>{{ $task->due_date }}</td>
                                        <td>

                                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" >Delete</button>
                                            </form>

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>











    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>


    {{-- Drop list status with ajax --}}


    <script>
        $(document).ready(function() {

            $('.status-select').on('change', function() {
                const select = $(this);
                const requestId = select.data('request-id');
                const newStatus = select.val();


                if (!confirm(' Are you sure you want to change the status?')) {

                    select.val(select.data('original-status'));
                    return;
                }

                $.ajax({
                    url: '{{ route('tasks.update', '') }}/' + requestId,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        status: newStatus
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.success) {

                            toastr.success('تم تحديث الحالة بنجاح');

                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        } else {
                            toastr.error('حدث خطأ في تحديث الحالة');

                            select.val(select.data('original-status'));
                        }
                    },
                    error: function() {
                        toastr.error('حدث خطأ في الاتصال');

                        select.val(select.data('original-status'));
                    }
                });
            });


            $('.status-select').each(function() {
                $(this).data('original-status', $(this).val());
            });
        });
    </script>
@endsection
