@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Batches</h3>
        </div>
        <div class="card-body">
            <a href="{{ url('/batches/create') }}" class="btn btn-success btn-sm" title="Add New Batch">
                <i class="fa fa-plus" aria-hidden="true"></i> Add new
            </a>
            <br/>
            <br/>

            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Batch</th>
                            <th>Course</th>
                            <th>Lecture</th>
                            <th>Start Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($batches) && $batches->count() > 0)
                            @foreach ($batches as $batch)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $batch->name }}</td>
                                    <td>{{ $batch->course->name }}</td>
                                    <td>{{ $batch->teacher ? $batch->teacher->name : 'Not Assigned' }}</td>
                                    <td>{{ $batch->start_date }}</td>
                                    <td>
                                        <a href="{{ url('/batches/' . $batch->id) }}" title="View Batch">
                                            <button class="btn btn-info btn-sm">
                                                <i class="fa fa-eye" aria-hidden="true"></i> View
                                            </button>
                                        </a>
                                        <a href="{{ url('/batches/' . $batch->id . '/edit') }}" title="Edit Batch">
                                            <button class="btn btn-primary btn-sm">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                            </button>
                                        </a>

                                        <form action="{{ route('batches.destroy', $batch->id) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Batch" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                                
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">No Batch found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection