<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Enrollment;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the attendance records.
     */
    public function index(Request $request)
    {
        $query = Attendance::with(['enrollment.student', 'enrollment.batch']);

        // Search by student name
        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('enrollment.student', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by date
        if ($request->has('date') && $request->date !== '') {
            $query->whereDate('date', $request->date);
        }

        $attendances = $query->latest()->paginate(10);
        
        return view('attendances.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new attendance record.
     */
    public function create()
    {
        $enrollments = Enrollment::with(['student', 'batch'])->get();
        return view('attendances.create', compact('enrollments'));
    }

    /**
     * Store a newly created attendance record.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'enrollment_id' => 'required|exists:enrollments,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late',
            'remarks' => 'nullable|string'
        ]);

        // Check for existing attendance record
        $existingAttendance = Attendance::where('enrollment_id', $validated['enrollment_id'])
            ->whereDate('date', $validated['date'])
            ->first();

        if ($existingAttendance) {
            return back()->withErrors(['enrollment_id' => 'Attendance already recorded for this student on this date.']);
        }

        Attendance::create($validated);

        return redirect()->route('attendances.index')
            ->with('success', 'Attendance record created successfully.');
    }

    /**
     * Display the specified attendance record.
     */
    public function show(Attendance $attendance)
    {
        return view('attendances.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified attendance record.
     */
    public function edit(Attendance $attendance)
    {
        $enrollments = Enrollment::with(['student', 'batch'])->get();
        return view('attendances.edit', compact('attendance', 'enrollments'));
    }

    /**
     * Update the specified attendance record.
     */
    public function update(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'enrollment_id' => 'required|exists:enrollments,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late',
            'remarks' => 'nullable|string'
        ]);

        $attendance->update($validated);

        return redirect()->route('attendances.index')
            ->with('success', 'Attendance record updated successfully.');
    }

    /**
     * Remove the specified attendance record.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('attendances.index')
            ->with('success', 'Attendance record deleted successfully.');
    }

    /**
     * Show attendance by batch
     */
    public function byBatch(Request $request, Batch $batch)
    {
        $query = Attendance::with(['enrollment.student'])
            ->whereHas('enrollment', function($q) use ($batch) {
                $q->where('batch_id', $batch->id);
            });

        // Search by student name
        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('enrollment.student', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by date
        if ($request->has('date') && $request->date !== '') {
            $query->whereDate('date', $request->date);
        }

        $attendances = $query->latest()->paginate(10);

        return view('attendances.by-batch', compact('attendances', 'batch'));
    }

    /**
     * Bulk attendance creation for a batch
     */
    public function bulkCreate(Batch $batch)
    {
        $enrollments = Enrollment::with('student')
            ->where('batch_id', $batch->id)
            ->get();
        return view('attendances.bulk-create', compact('batch', 'enrollments'));
    }

    /**
     * Store bulk attendance records
     */
    public function bulkStore(Request $request, Batch $batch)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'attendance' => 'required|array',
            'attendance.*.enrollment_id' => 'required|exists:enrollments,id',
            'attendance.*.status' => 'required|in:present,absent,late',
            'attendance.*.remarks' => 'nullable|string'
        ]);

        DB::beginTransaction();
        try {
            foreach ($validated['attendance'] as $record) {
                // Check for existing attendance record
                $existingAttendance = Attendance::where('enrollment_id', $record['enrollment_id'])
                    ->whereDate('date', $validated['date'])
                    ->first();

                if ($existingAttendance) {
                    DB::rollBack();
                    return back()->withErrors(['attendance' => 'Attendance already recorded for one or more students on this date.']);
                }

                Attendance::create([
                    'enrollment_id' => $record['enrollment_id'],
                    'date' => $validated['date'],
                    'status' => $record['status'],
                    'remarks' => $record['remarks'] ?? null
                ]);
            }
            DB::commit();

            return redirect()->route('attendances.by-batch', $batch)
                ->with('success', 'Bulk attendance records created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create attendance records.');
        }
    }
}
