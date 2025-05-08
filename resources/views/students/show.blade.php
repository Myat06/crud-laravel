@extends('layout')
@section('content')
    <div class="card">
        <div class="card-header">Student Page</div>
           
        <div class="card-body">
            <div class="card-body">
                <h5 class="card-title">Student Name: {{ $students->name }}</h5>
                <p class="card-text">Email : {{ $students->email }}</p>
                <p class="card-text">Mobile : {{ $students->phone }}</p>
                <p class="card-text">Address : {{ $students->address }}</p>
                <p class="card-text">DOB : {{ $students->date_of_birth }}</p>
                

            </div>
            </hr>
        </div>
    </div>
    @endsection