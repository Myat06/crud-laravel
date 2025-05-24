<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Response;

class EnrollmentController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $enrollments = Enrollment::all();
        return view('enrollments.index')->with('enrollments', $enrollments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $batches = \App\Models\Batch::pluck('name', 'id'); // id => name
        $students = \App\Models\Student::pluck('name', 'id'); // id => name
        return view('enrollments.create', compact('batches', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Check if student is already enrolled in any batch
        $existingEnrollment = Enrollment::where('student_id', $request->student_id)->first();
        
        if ($existingEnrollment) {
            return back()
                ->withInput()
                ->withErrors(['student_id' => 'This student is already enrolled in a batch.']);
        }

        $input = $request->all();
        Enrollment::create($input);
        return redirect('enrollments')->with('flash_message', 'Enrollment Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : View 
    {
        $enrollments = Enrollment::find($id);
        return view('enrollments.show')->with('enrollments', $enrollments);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $batches = \App\Models\Batch::pluck('name', 'id');
        $students = \App\Models\Student::pluck('name', 'id');
        return view('enrollments.edit', compact('enrollment', 'batches', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $enrollment = Enrollment::find($id);
        
        // Check if student is already enrolled in any other batch
        $existingEnrollment = Enrollment::where('student_id', $request->student_id)
            ->where('id', '!=', $id)
            ->first();
        
        if ($existingEnrollment) {
            return back()
                ->withInput()
                ->withErrors(['student_id' => 'This student is already enrolled in another batch.']);
        }

        $input = $request->all();
        $enrollment->update($input);
        return redirect('enrollments')->with('flash_message', 'Enrollment Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Enrollment::destroy($id);
        return redirect('enrollments')->with('flash_message', 'Enrollment deleted!');
    }
}
