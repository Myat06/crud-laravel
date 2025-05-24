@extends('layout')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Attendance Records for {{ $batch->name }}</h3>
    </div>
    <div class="card-body">
        <!-- Search Bar -->
        <form action="{{ route('attendances.by-batch', $batch) }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" name="search" class="form-control" placeholder="Search by student name..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select name="status" class="form-select">
                            <option value="">All Status</option>
                            <option value="present" {{ request('status') == 'present' ? 'selected' : '' }}>Present</option>
                            <option value="absent" {{ request('status') == 'absent' ? 'selected' : '' }}>Absent</option>
                            <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>Late</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Search
                    </button>
                    <a href="{{ route('attendances.by-batch', $batch) }}" class="btn btn-secondary">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </div>
        </form>

        <a href="{{ route('attendances.bulk-create', $batch) }}" class="btn btn-success btn-sm mb-3" title="Add Bulk Attendance">
            <i class="fa fa-plus" aria-hidden="true"></i> Add Bulk Attendance
        </a>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Student</th>
                        <th>Status</th>
                        <th>Remarks</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($attendances) && $attendances->count() > 0)
                        @foreach($attendances as $attendance)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $attendance->date->format('Y-m-d') }}</td>
                                <td>{{ $attendance->enrollment->student->name }}</td>
                                <td>
                                    <span class="badge bg-{{ $attendance->status === 'present' ? 'success' : ($attendance->status === 'late' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($attendance->status) }}
                                    </span>
                                </td>
                                <td>{{ $attendance->remarks }}</td>
                                <td>
                                    <a href="{{ route('attendances.edit', $attendance) }}" title="Edit Attendance">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                        </button>
                                    </a>
                                    <form action="{{ route('attendances.destroy', $attendance) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this attendance record?')">
                                            <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">No attendance records found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $attendances->links() }}
        </div>
    </div>
</div>
@endsection 