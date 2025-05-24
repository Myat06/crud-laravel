@extends('layout')
@section('content')
    <div class="card">
        <div class="card-header">Edit Enrollment</div>
           
        <div class="card-body">
            <form action="{{ url('/enrollments/' . $enrollment->id) }}" method="POST">
              
                {!! csrf_field() !!}
                @method('PATCH')
                <input type="hidden" name="id" id="id" value="{{ $enrollment->id }}" />
                <label>Enroll No</label></br>
                <input type="text" name="enroll_no" id="enroll_no" value="{{ $enrollment->enroll_no }}" class="form-control"></br>
                
                <!-- Batch Field -->
                <div class="mb-3">
                    <label for="batch_id" class="form-label">Batch</label>
                    <select name="batch_id" id="batch_id" class="form-control @error('batch_id') is-invalid @enderror">
                        <option value="">Select Batch</option>
                        @foreach($batches as $id => $name)
                            <option value="{{ $id }}" {{ (old('batch_id', $enrollment->batch_id) == $id) ? 'selected' : '' }}>{{ $name }}</option>
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
                            <option value="{{ $id }}" {{ (old('student_id', $enrollment->student_id) == $id) ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('student_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <label>Join Date</label></br>
                <input type="date" name="join_date" id="join_date" value="{{ $enrollment->join_date }}" class="form-control"></br>
                <label>Fee</label></br>
                <input type="number" name="fee" id="fee" value="{{ $enrollment->fee }}" class="form-control"></br>
                <input type="submit" value="Update" class="btn btn-success"></br>
            </form>
          
        </div>
    </div>
    @stop