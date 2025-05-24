@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">Payments </div>
        <div class="card-body">
            <form action="{{ url('/payments') }}" method="POST">
                @csrf

                <!-- Enroll Field -->
                <div class="mb-3">
                    <label for="enrollment_id" class="form-label">Enroll NO</label>
                    <select name="enrollment_id" id="enrollment_id" class="form-control @error('enrollment_id') is-invalid @enderror">
                        <option value="">Select Enroll No</option>
                        @foreach ($enrollments as $id => $enroll_no)
                            <option value="{{ $id }}" {{ old('enrollment_id') == $id ? 'selected' : '' }}>{{ $enroll_no }}</option>
                        @endforeach
                    </select>
                    @error('enrollment_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Paid Date Field -->
                <div class="mb-3">
                    <label for="paid_date" class="form-label">Paid Date</label>
                    <input type="date" name="paid_date" id="paid_date" class="form-control" value="{{ old('paid_date') }}">
                    @error('paid_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Fee Field -->
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount') }}">
                    @error('amount')
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