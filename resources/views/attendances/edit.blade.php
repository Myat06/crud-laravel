@extends('layout')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Attendance</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('attendances.update', $attendance) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="student_id" class="form-label">Student</label>
                    <select name="student_id" id="student_id" class="form-select @error('student_id') is-invalid @enderror" required>
                        <option value="">Select Student</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ old('student_id', $attendance->student_id) == $student->id ? 'selected' : '' }}>
                                {{ $student->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('student_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="batch_id" class="form-label">Batch</label>
                    <select name="batch_id" id="batch_id" class="form-select @error('batch_id') is-invalid @enderror" required>
                        <option value="">Select Batch</option>
                        @foreach($batches as $batch)
                            <option value="{{ $batch->id }}" {{ old('batch_id', $attendance->batch_id) == $batch->id ? 'selected' : '' }}>
                                {{ $batch->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('batch_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" 
                           value="{{ old('date', $attendance->date->format('Y-m-d')) }}" required>
                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="present" {{ old('status', $attendance->status) == 'present' ? 'selected' : '' }}>Present</option>
                        <option value="absent" {{ old('status', $attendance->status) == 'absent' ? 'selected' : '' }}>Absent</option>
                        <option value="late" {{ old('status', $attendance->status) == 'late' ? 'selected' : '' }}>Late</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mb-3">
                    <label for="remarks" class="form-label">Remarks</label>
                    <textarea name="remarks" id="remarks" class="form-control @error('remarks') is-invalid @enderror" 
                              rows="3">{{ old('remarks', $attendance->remarks) }}</textarea>
                    @error('remarks')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Update Attendance</button>
                <a href="{{ route('attendances.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection 