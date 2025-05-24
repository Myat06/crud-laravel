<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher; // Updated to use the Teacher model
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Teacher::query();

        // Add search/filter logic if needed

        $teachers = $query->paginate(10);
        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('teachers.create'); // Updated view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        Teacher::create($input); // Save teacher data
        return redirect('teachers')->with('flash_message', 'Teacher Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $teacher = Teacher::find($id); // Find teacher by ID
        return view('teachers.show')->with('teacher', $teacher); // Updated view
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $teacher = Teacher::find($id); // Find teacher by ID
        return view('teachers.edit')->with('teacher', $teacher); // Updated view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $teacher = Teacher::find($id); // Find teacher by ID
        $input = $request->all();
        $teacher->update($input); // Update teacher data
        return redirect('teachers')->with('flash_message', 'Teacher Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Teacher::destroy($id); // Delete teacher by ID
        return redirect('teachers')->with('flash_message', 'Teacher Deleted!');
    }
}
