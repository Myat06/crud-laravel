<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Student::query();

        // Search by name
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        // Search by phone
        if ($request->has('phone')) {
            $phone = $request->phone;
            $query->where('phone', 'like', "%{$phone}%");
        }

        $students = $query->latest()->paginate(10);
        
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $path = $file->store('profile_pictures', 'public');
            $input['profile_picture'] = $path; // <-- This line is correct!
        }
        Student::create($input);
        return redirect('students')->with('flash_message', 'Student Addedd!.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $student = Student::find($id);
        return view('students.show')->with('students', $student);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $student = Student::find($id);
        return view('students.edit')->with('students', $student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $student = Student::find($id);
        $input = $request->all();
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $path = $file->store('profile_pictures', 'public');
            $input['profile_picture'] = $path;
        }
        $student->update($input);
        return redirect('students')->with('flash_message', 'Student Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Student::destroy($id);
        return redirect('students')->with('flash_message', 'Student deleted!');
    }
}
