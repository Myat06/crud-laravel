@extends('layout')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Add New Attendance</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('attendances.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="enrollment_id" class="form-label">Student & Batch</label>
                    <select name="enrollment_id" id="enrollment_id" class="form-select @error('enrollment_id') is-invalid @enderror" required>
                        <option value="">Select Student & Batch</option>
                        @foreach($enrollments as $enrollment)
                            <option value="{{ $enrollment->id }}" {{ old('enrollment_id') == $enrollment->id ? 'selected' : '' }}>
                                {{ $enrollment->student->name }} - {{ $enrollment->batch->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('enrollment_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" 
                           value="{{ old('date', date('Y-m-d')) }}" required>
                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="present" {{ old('status') == 'present' ? 'selected' : '' }}>Present</option>
                        <option value="absent" {{ old('status') == 'absent' ? 'selected' : '' }}>Absent</option>
                        <option value="late" {{ old('status') == 'late' ? 'selected' : '' }}>Late</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mb-3">
                    <label for="remarks" class="form-label">Remarks</label>
                    <textarea name="remarks" id="remarks" class="form-control @error('remarks') is-invalid @enderror" 
                              rows="3">{{ old('remarks') }}</textarea>
                    @error('remarks')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Save Attendance</button>
                <a href="{{ route('attendances.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection 