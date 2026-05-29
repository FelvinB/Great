<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function timeIn(Request $request)
    {
        $student = Student::where('student_id', $request->student_id)->first();

        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }

        $attendance = Attendance::create([
            'student_id' => $student->id,
            'date' => now()->toDateString(),
            'time_in' => now()->toTimeString()
        ]);

        return response()->json([
            'message' => 'Time in successful',
            'attendance' => $attendance
        ]);
    }

    public function timeOut(Request $request)
    {
        $student = Student::where('student_id', $request->student_id)->first();

        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }

        $attendance = Attendance::where('student_id', $student->id)
            ->where('date', now()->toDateString())
            ->latest()
            ->first();

        if (!$attendance) {
            return response()->json([
                'message' => 'No time in found'
            ], 404);
        }

        $attendance->update([
            'time_out' => now()->toTimeString()
        ]);

        return response()->json([
            'message' => 'Time out successful',
            'attendance' => $attendance
        ]);
    }

    public function logs()
    {
        return Attendance::with('student')->get();
    }
}