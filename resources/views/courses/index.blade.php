@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Courses Application</h3>
        </div>
        <div class="card-body">
            <a href="{{ url('/courses/create') }}" class="btn btn-success btn-sm" title="Add New Courses">
                <i class="fa fa-plus" aria-hidden="true"></i> Add new
            </a>
            <br/>
            <br/>

            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Course Name</th>
                            <th>Syllabus</th>
                            <th>Duration</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($courses) && $courses->count() > 0)
                            @foreach ($courses as $course)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->syllabus }}</td>
                                    <td>{{ $course->duration() }}</td>
                                    <td>
                                        <a href="{{ url('/courses/' . $course->id) }}" title="View Course">
                                            <button class="btn btn-info btn-sm">
                                                <i class="fa fa-eye" aria-hidden="true"></i> View
                                            </button>
                                        </a>
                                        <a href="{{ url('/courses/' . $course->id . '/edit') }}" title="Edit Course">
                                            <button class="btn btn-primary btn-sm">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                            </button>
                                        </a>

                                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Course" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                                
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">No Courses found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection