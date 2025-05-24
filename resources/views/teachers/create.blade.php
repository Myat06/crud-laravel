@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">Teacher Page</div>
        <div class="card-body">
            <form action="{{ url('/teachers') }}" method="POST">
                @csrf

                <!-- Name Field -->
                <div class="mb-3">
                    <label for="name" class="form-label">Teacher Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Phone Field -->
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Address Field -->
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}">
                    @error('address')
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