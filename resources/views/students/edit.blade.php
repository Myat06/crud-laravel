@extends('layout')
@section('content')
    <div class="card">
        <div class="card-header">Edit Page</div>
           
        <div class="card-body">
            <form action="{{ url('/students/' . $students->id) }}" method="POST" enctype="multipart/form-data">
              
                {!! csrf_field() !!}
                @method('PATCH')
                <input type="hidden" name="id" id="id" value="{{ $students->id }}" id="id" />
                <label>Name</label></br>
                <input type="text" name="name" id="name" value="{{ $students->name }}" class="form-control"></br>
                <label>Email</label></br>
                <input type="text" name="email" id="email" value="{{ $students->email }}" class="form-control"></br>
                <label>Mobile</label></br>
                <input type="text" name="phone" id="phone" value="{{ $students->phone }}" class="form-control"></br>
                <label>Address</label></br>
                <input type="text" name="address" id="address" value="{{ $students->address }}" class="form-control"></br>
                <label>Date of Birth</label></br>
                <input type="date" name="date_of_birth" id="date_of_birth" value="{{ $students->date_of_birth }}" class="form-control"></br>
                
                <label>Profile Picture</label></br>
                @if($students->profile_picture)
                    <img src="{{ asset('storage/' . $students->profile_picture) }}" alt="Profile Picture" width="80" class="mb-2 rounded"><br>
                @endif
                <input type="file" name="profile_picture" class="form-control mb-3">

                <input type="submit" value="Update" class="btn btn-success"></br>
            </form>
          
        </div>
    </div>
    @stop