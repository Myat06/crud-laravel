@extends('layout')

@section('content')
@if(isset($error))
    <div class="alert alert-danger">
        {{ $error }}
    </div>
@endif

<div class="row g-4">
    <!-- Total Courses Card -->
    <div class="col-md-3">
        <div class="card h-100">
            <div class="card-header bg-success text-white">
                <h5 class="card-title mb-0">Total Courses</h5>
            </div>
            <div class="card-body text-center">
                <h3 class="display-4 mb-0">{{ $totalCourses ?? 0 }}</h3>
                <p class="text-muted">Available Courses</p>
            </div>
        </div>
    </div>

    <!-- Total Batches Card -->
    <div class="col-md-3">
        <div class="card h-100">
            <div class="card-header bg-info text-white">
                <h5 class="card-title mb-0">Total Batches</h5>
            </div>
            <div class="card-body text-center">
                <h3 class="display-4 mb-0">{{ $totalBatches ?? 0 }}</h3>
                <p class="text-muted">All Batches</p>
            </div>
        </div>
    </div>

    <!-- Total Teachers Card -->
    <div class="col-md-3">
        <div class="card h-100">
            <div class="card-header bg-warning text-white">
                <h5 class="card-title mb-0">Total Teachers</h5>
            </div>
            <div class="card-body text-center">
                <h3 class="display-4 mb-0">{{ $totalTeachers ?? 0 }}</h3>
                <p class="text-muted">Registered Teachers</p>
            </div>
        </div>
    </div>

    <!-- Total Students Overview -->
    <div class="col-md-3">
        <div class="card h-100">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Total Students</h5>
            </div>
            <div class="card-body text-center">
                <h3 class="display-4 mb-0">{{ $totalStudents ?? 0 }}</h3>
                <p class="text-muted">Registered Students</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4 g-4">
    <!-- Today's Attendance Card -->
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Today's Attendance</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-4">
                        <h3 class="text-success mb-0">{{ $todayStats['present'] ?? 0 }}</h3>
                        <p class="text-muted small">Present</p>
                    </div>
                    <div class="col-4">
                        <h3 class="text-warning mb-0">{{ $todayStats['late'] ?? 0 }}</h3>
                        <p class="text-muted small">Late</p>
                    </div>
                    <div class="col-4">
                        <h3 class="text-danger mb-0">{{ $todayStats['absent'] ?? 0 }}</h3>
                        <p class="text-muted small">Absent</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Batch-wise Attendance Summary -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="card-title mb-0">Batch-wise Attendance</h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($batchAttendance ?? [] as $batch)
                        <div class="list-group-item">
                            <h6 class="mb-1">{{ $batch->name }}</h6>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="badge bg-primary me-2">Total: {{ $batch->total_students }}</span>
                                    <span class="badge bg-success me-2">Present: {{ $batch->present_count ?? 0 }}</span>
                                    <span class="badge bg-danger">Absent: {{ $batch->absent_count ?? 0 }}</span>
                                </div>
                                <a href="{{ route('attendances.by-batch', $batch) }}" class="btn btn-sm btn-outline-primary">
                                    View Details
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="list-group-item text-center py-4">
                            <div class="text-muted">
                                <i class="bi bi-collection fs-4 d-block mb-2"></i>
                                No batch data available
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection