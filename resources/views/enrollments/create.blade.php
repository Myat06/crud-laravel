@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">Enrollment Page</div>
        <div class="card-body">
            <form action="{{ url('/enrollments') }}" method="POST">
                @csrf

                <!-- Enroll Field -->
                <div class="mb-3">
                    <label for="enroll_no" class="form-label">Enroll NO</label>
                    <input type="text" name="enroll_no" id="enroll_no" class="form-control @error('enroll_no') is-invalid @enderror" value="{{ old('enroll_no') }}" required>
                    @error('enroll_no')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Batch Field -->
                <div class="mb-3">
                    <label for="batch_id" class="form-label">Batch</label>
                    <select name="batch_id" id="batch_id" class="form-control @error('batch_id') is-invalid @enderror">
                        <option value="">Select Batch</option>
                        @foreach($batches as $id => $name)
                            <option value="{{ $id }}" {{ old('batch_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('batch_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Student Field -->
                <div class="mb-3">
                    <label for="student_id" class="form-label">Student</label>
                    <select name="student_id" id="student_id" class="form-control @error('student_id') is-invalid @enderror">
                        <option value="">Select Student</option>
                        @foreach($students as $id => $name)
                            <option value="{{ $id }}" {{ old('student_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('student_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Join Date Field -->
                <div class="mb-3">
                    <label for="join_date" class="form-label">Join Date</label>
                    <input type="date" name="join_date" id="join_date" class="form-control " value="{{ old('join_date') }}">
                    @error('join_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Fee Field -->
                <div class="mb-3">
                    <label for="fee" class="form-label">Fee</label>
                    <input type="number" name="fee" id="fee" class="form-control" value="{{ old('fee') }}">
                    @error('fee')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check" aria-hidden="true"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop