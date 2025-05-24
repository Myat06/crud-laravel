@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">Batches Page</div>
        <div class="card-body">
            <form action="{{ url('/batches') }}" method="POST">
                @csrf

                <!-- Name Field -->
                <div class="mb-3">
                    <label for="name" class="form-label">Batch</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                

                <!-- Course Field -->
                <div class="mb-3">
                    <label for="course_id" class="form-label">Course Name</label>
                    <!-- <input type="text" name="course_id" id="course_id" class="form-control" value="{{ old('course_id') }}"> -->
                    <select name="course_id" id="course_id" class="form-control @error('course_id') is-invalid @enderror">
                        <option value="">Select Course</option>
                        @foreach ($courses as $id => $name)
                            <option value="{{ $id }}" {{ old('course_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('course_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Teacher Field -->
                <div class="mb-3">
                    <label for="teacher_id" class="form-label">Teacher</label>
                    <select name="teacher_id" id="teacher_id" class="form-control @error('teacher_id') is-invalid @enderror">
                        <option value="">Select Teacher</option>
                        @foreach ($teachers as $id => $name)
                            <option value="{{ $id }}" {{ old('teacher_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('teacher_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Address Field -->
                <div class="mb-3">
                    <label for="duration" class="form-label">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control " value="{{ old('start_date') }}">
                    @error('start_date')
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