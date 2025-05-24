@extends('layout')
@section('content')
    <div class="card">
        <div class="card-header">Edit Teacher</div>
           
        <div class="card-body">
            <form action="{{ url('/teachers/' . $teacher->id) }}" method="POST">
              
                {!! csrf_field() !!}
                @method('PATCH')
                <input type="hidden" name="id" id="id" value="{{ $teacher->id }}" />
                
                <!-- Name Field -->
                <label>Name</label></br>
                <input type="text" name="name" id="name" value="{{ $teacher->name }}" class="form-control"></br>
                <label>Mobile</label></br>
                <input type="text" name="phone" id="phone" value="{{ $teacher->phone }}" class="form-control"></br>
                <label>Address</label></br>
                <input type="text" name="address" id="address" value="{{ $teacher->address }}" class="form-control"></br>
                <input type="submit" value="Update" class="btn btn-success"></br>
            </form>
          
        </div>
    </div>
    @stop