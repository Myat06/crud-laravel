@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Payments </h3>
        </div>
        <div class="card-body">
            <a href="{{ url('/payments/create') }}" class="btn btn-success btn-sm" title="Add New Payment">
                <i class="fa fa-plus" aria-hidden="true"></i> Add new
            </a>
            <br/>
            <br/>

            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Enroll No</th>
                            <th>Paid Date</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($payments) && $payments->count() > 0)
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $payment->enrollment->enroll_no }}</td>
                                    <td>{{ $payment->paid_date }}</td>
                                    <td>{{ $payment->amount }}</td>
                                    <td>
                                        <a href="{{ url('/payments/' . $payment->id) }}" title="View Payment">
                                            <button class="btn btn-info btn-sm">
                                                <i class="fa fa-eye" aria-hidden="true"></i> View
                                            </button>
                                        </a>
                                        <a href="{{ url('/payments/' . $payment->id . '/edit') }}" title="Edit Payment">
                                            <button class="btn btn-primary btn-sm">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                            </button>
                                        </a>
                                        <a href="{{ url('/payments/print/' . $payment->id) }}" target="_blank" title="Print Payment">
                                            <button class="btn btn-secondary btn-sm">
                                                <i class="fa fa-print" aria-hidden="true"></i> Print
                                            </button>
                                        </a>
                                        <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Payment" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">No Payment found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection