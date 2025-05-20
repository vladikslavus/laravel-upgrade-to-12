<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;

class TestController extends Controller
{
    public function latestGradeRelation()
    {
        $student = Student::with(['latestGrade'])->first(); // В with() передаётся отношение

        return response()->json($student->latestGrade);
    }

    public function firstGradeRelation()
    {
        $student = Student::with(['firstGrade'])->first();

        return response()->json($student->firstGrade);
    }

    public function highestGradeRelation()
    {
        $student = Student::with(['highestGrade'])->first();

        return response()->json($student->highestGrade);
    }

    public function lowestGradeRelation()
    {
        $student = Student::with(['lowestGrade'])->first();

        return response()->json($student->lowestGrade);
    }

    public function latestValidGradeRelation()
    {
        $student = Student::with(['latestValidGrade'])->first();

        return response()->json($student->latestValidGrade);
    }

    public function showMonitorByTeacher()
    {
        $teacher = Teacher::find(1);
        $monitor = $teacher->monitor;
        // $classroom = $monitor->classroom;

        // return ($monitor === null);
        return 'Учитель ' . $teacher->name . ' заведует старостой '. $monitor->name;
    }
}
