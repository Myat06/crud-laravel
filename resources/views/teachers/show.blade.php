@extends('layout')
@section('content')
    <div class="card">
        <div class="card-header">Teacher Page</div>
           
        <div class="card-body">
            <div class="card-body">
                <h5 class="card-title">Teacher Name: {{ $teacher->name }}</h5>
                <p class="card-text">Mobile : {{ $teacher->phone }}</p>
                <p class="card-text">Address : {{ $teacher->address }}</p>
            </div>
            </hr>
        </div>
    </div>
    @endsection