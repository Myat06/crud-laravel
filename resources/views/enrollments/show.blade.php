@extends('layout')
@section('content')
    <div class="card">
        <div class="card-header">Enrollments Page</div>
           
        <div class="card-body">
            <div class="card-body">
                <h5 class="card-title">Enroll NO: {{ $enrollments->enroll_no }}</h5>
                <p class="card-text">Batch : {{ $enrollments->batch->name }}</p>
                <p class="card-text">Student : {{ $enrollments->student->name }}</p>
                <p class="card-text">Join Date : {{ $enrollments->join_date }}</p>
                
                <div class="mt-4">
                    <h6 class="card-subtitle mb-2 text-muted">Payment Information</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">Total Fee</h6>
                                    <p class="card-text h4">{{ $enrollments->fee }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">Paid Amount</h6>
                                    <p class="card-text h4">{{ $enrollments->payments->sum('amount') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">Remaining Fee</h6>
                                    <p class="card-text h4">{{ $enrollments->remaining_fee }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($enrollments->payments->count() > 0)
                    <div class="mt-4">
                        <h6 class="card-subtitle mb-2 text-muted">Payment History</h6>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($enrollments->payments as $payment)
                                        <tr>
                                            <td>{{ $payment->paid_date }}</td>
                                            <td>{{ $payment->amount }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
            </hr>
        </div>
    </div>
    @endsection