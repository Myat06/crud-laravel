<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Batch;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Get all attendance statistics
            $todayStats = Attendance::whereDate('date', Carbon::now()->timezone('Asia/Jakarta')->toDateString())
                ->select('status', DB::raw('count(*) as count'))
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();

            // Get total batches (all batches)
            $totalBatches = Batch::count();

            // Get total courses
            $totalCourses = \App\Models\Course::count();

            // Get unique enrolled students
            $enrolledStudents = Enrollment::select('student_id')
                ->distinct()
                ->count();

            // Get total registered students
            $totalStudents = \App\Models\Student::count();

            // Get total teachers
            $totalTeachers = \App\Models\Teacher::count();

            // Get batch-wise attendance summary
            $batchAttendance = Batch::withCount([
                'enrollments as present_count' => function ($query) {
                    $query->whereHas('attendances', function ($q) {
                        $q->where('status', 'present');
                    });
                },
                'enrollments as absent_count' => function ($query) {
                    $query->whereHas('attendances', function ($q) {
                        $q->where('status', 'absent');
                    });
                },
                'enrollments as total_students'
            ])->get();

            // Debug information
            \Log::info('Dashboard Data:', [
                'todayStats' => $todayStats,
                'totalBatches' => $totalBatches,
                'totalCourses' => $totalCourses,
                'enrolledStudents' => $enrolledStudents,
                'totalStudents' => $totalStudents,
                'totalTeachers' => $totalTeachers,
                'batchAttendance' => $batchAttendance->count()
            ]);

            return view('dashboard.index', compact(
                'todayStats',
                'totalBatches',
                'totalCourses',
                'enrolledStudents',
                'totalStudents',
                'totalTeachers',
                'batchAttendance'
            ));
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Dashboard Error: ' . $e->getMessage());
            
            // Return view with empty data
            return view('dashboard.index', [
                'todayStats' => [],
                'totalBatches' => 0,
                'totalCourses' => 0,
                'enrolledStudents' => 0,
                'totalStudents' => 0,
                'totalTeachers' => 0,
                'batchAttendance' => collect(),
                'error' => 'Unable to load dashboard data. Please try again later.'
            ]);
        }
    }
}