@extends('layout')
@section('content')
    <div class="card">
        <div class="card-header">Batches Page</div>
           
        <div class="card-body">
            <div class="card-body">
                <h5 class="card-title">Batch: {{ $batches->name }}</h5>
                <p class="card-text">Course : {{ $batches->course->name }}</p>
                <p class="card-text">Lecture : {{ $batches->teacher ? $batches->teacher->name : 'Not Assigned' }}</p>
                <p class="card-text">Start Date : {{ $batches->start_date }}</p>
            
                

            </div>
            </hr>
        </div>
    </div>
    @endsection