@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">Course Page</div>
        <div class="card-body">
            <form action="{{ url('/courses') }}" method="POST">
                @csrf

                <!-- Name Field -->
                <div class="mb-3">
                    <label for="name" class="form-label">Course Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                

                <!-- Phone Field -->
                <div class="mb-3">
                    <label for="syllabus" class="form-label">Syllabus</label>
                    <input type="text" name="syllabus" id="syllabus" class="form-control" value="{{ old('syllabus') }}">
                    @error('syllabus')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Address Field -->
                <div class="mb-3">
                    <label for="duration" class="form-label">Duration</label>
                    <input type="text" name="duration" id="duration" class="form-control " value="{{ old('duration') }}">
                    @error('duration')
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