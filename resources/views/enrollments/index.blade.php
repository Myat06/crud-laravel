@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Enrollment Page</h3>
        </div>
        <div class="card-body">
            <a href="{{ url('/enrollments/create') }}" class="btn btn-success btn-sm" title="Add New Enrollment">
                <i class="fa fa-plus" aria-hidden="true"></i> Add new
            </a>
            <br/>
            <br/>

            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Enroll No</th>
                            <th>Batch</th>
                            <th>Student</th>
                            <th>Join Date</th>
                            <th>Total Fee</th>
                            <th>Paid Amount</th>
                            <th>Remaining Fee</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($enrollments) && $enrollments->count() > 0)
                            @foreach ($enrollments as $enrollment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $enrollment->enroll_no }}</td>
                                    <td>{{ $enrollment->batch->name }}</td>
                                    <td>{{ $enrollment->student->name }}</td>
                                    <td>{{ $enrollment->join_date }}</td>
                                    <td>{{ $enrollment->fee }}</td>
                                    <td>{{ $enrollment->payments->sum('amount') }}</td>
                                    <td>{{ $enrollment->remaining_fee }}</td>
                                    <td>
                                        @if($enrollment->remaining_fee <= 0)
                                            <span class="badge bg-success">
                                                <i class="fa fa-check-circle"></i> Paid
                                            </span>
                                        @else
                                            <span class="badge bg-warning">
                                                <i class="fa fa-clock-o"></i> Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/enrollments/' . $enrollment->id) }}" title="View Enrollment">
                                            <button class="btn btn-info btn-sm">
                                                <i class="fa fa-eye" aria-hidden="true"></i> View
                                            </button>
                                        </a>
                                        <a href="{{ url('/enrollments/' . $enrollment->id . '/edit') }}" title="Edit Enrollment">
                                            <button class="btn btn-primary btn-sm">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                            </button>
                                        </a>

                                        <form action="{{ route('enrollments.destroy', $enrollment->id) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Enrollment" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10" class="text-center">No Enrollment found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection