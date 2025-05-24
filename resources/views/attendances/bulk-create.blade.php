@extends('layout')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Bulk Attendance for {{ $batch->name }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('attendances.bulk-store', $batch) }}" method="POST">
            @csrf
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" 
                           value="{{ old('date', date('Y-m-d')) }}" required>
                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Status</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enrollments as $enrollment)
                        <tr>
                            <td>{{ $enrollment->student->name }}</td>
                            <td>
                                <select name="attendance[{{ $loop->index }}][status]" class="form-select" required>
                                    <option value="present">Present</option>
                                    <option value="absent">Absent</option>
                                    <option value="late">Late</option>
                                </select>
                                <input type="hidden" name="attendance[{{ $loop->index }}][enrollment_id]" value="{{ $enrollment->id }}">
                            </td>
                            <td>
                                <input type="text" name="attendance[{{ $loop->index }}][remarks]" class="form-control">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Save Attendance</button>
                <a href="{{ route('attendances.by-batch', $batch) }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Add any JavaScript for bulk attendance functionality here
    document.addEventListener('DOMContentLoaded', function() {
        // Example: Quick select all students as present
        const quickSelectAll = document.createElement('button');
        quickSelectAll.type = 'button';
        quickSelectAll.className = 'btn btn-outline-primary mb-3';
        quickSelectAll.textContent = 'Mark All Present';
        quickSelectAll.onclick = function() {
            document.querySelectorAll('select[name^="attendance"][name$="[status]"]').forEach(select => {
                select.value = 'present';
            });
        };
        document.querySelector('.card-body').insertBefore(quickSelectAll, document.querySelector('.table-responsive'));
    });
</script>
@endpush
@endsection 