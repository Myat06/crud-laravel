@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Teachers</h3>
        </div>
        <div class="card-body">
            <!-- Search Bar -->
            <form action="{{ route('teachers.index') }}" method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="search" class="form-control" placeholder="Search by name..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="phone" class="form-control" placeholder="Search by phone..." value="{{ request('phone') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Search
                        </button>
                        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">
                            <i class="fas fa-redo"></i> Reset
                        </a>
                    </div>
                </div>
            </form>

            <a href="{{ route('teachers.create') }}" class="btn btn-success btn-sm mb-3" title="Add New Teacher">
                <i class="fa fa-plus" aria-hidden="true"></i> Add New
            </a>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($teachers) && $teachers->count() > 0)
                            @foreach($teachers as $teacher)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $teacher->name }}</td>
                                    <td>{{ $teacher->address }}</td>
                                    <td>{{ $teacher->phone }}</td>
                                    <td>
                                        <a href="{{ route('teachers.show', $teacher) }}" title="View Teacher">
                                            <button class="btn btn-info btn-sm">
                                                <i class="fa fa-eye" aria-hidden="true"></i> View
                                            </button>
                                        </a>
                                        <a href="{{ route('teachers.edit', $teacher) }}" title="Edit Teacher">
                                            <button class="btn btn-primary btn-sm">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                            </button>
                                        </a>
                                        <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this teacher?')">
                                                <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">No teachers found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $teachers->links() }}
            </div>
        </div>
    </div>
@endsection