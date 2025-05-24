@extends('layout')
@section('content')
    <div class="card">
        <div class="card-header">Student Page</div>
        <div class="card-body">
            <div class="card-body">
                @if($students->profile_picture)
                    <img src="{{ asset('storage/' . $students->profile_picture) }}" alt="Profile Picture" width="120" class="mb-3 rounded">
                @else
                    <img src="{{ asset('images/default-profile.png') }}" alt="No Profile Picture" width="120" class="mb-3 rounded">
                @endif
                <h5 class="card-title">Student Name: {{ $students->name }}</h5>
                <p class="card-text">Email : {{ $students->email }}</p>
                <p class="card-text">Mobile : {{ $students->phone }}</p>
                <p class="card-text">Address : {{ $students->address }}</p>
                <p class="card-text">DOB : {{ $students->date_of_birth }}</p>

                @if($students->enrollments->count() > 0)
                    <div class="mt-4">
                        <h6 class="card-subtitle mb-2 text-muted">Enrollment Information</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Enroll No</th>
                                        <th>Batch</th>
                                        <th>Join Date</th>
                                        <th>Total Fee</th>
                                        <th>Paid Amount</th>
                                        <th>Remaining Fee</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students->enrollments as $enrollment)
                                        <tr>
                                            <td>{{ $enrollment->enroll_no }}</td>
                                            <td>{{ $enrollment->batch->name }}</td>
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="mt-4">
                        <p class="text-muted">No enrollment records found.</p>
                    </div>
                @endif
            </div>
            </hr>
        </div>
    </div>
@endsection