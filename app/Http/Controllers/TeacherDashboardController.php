<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Classe;
use App\Models\Student;

class TeacherDashboardController extends Controller
{
    /**
     * Display the teacher dashboard.
     */
    public function index()
    {
        $teacher = Auth::user()->Teacher;
        
        if (!$teacher) {
            return redirect()->route('dashboard')->with('error', 'Teacher profile not found. Please contact administrator.');
        }
        
        $subjects = $teacher->subjects ?? collect();
        $classes = [];
        $students = [];
        
        foreach ($subjects as $subject) {
            $subjectClasses = $subject->classes ?? collect();
            foreach ($subjectClasses as $class) {
                if (!in_array($class, $classes)) {
                    $classes[] = $class;
                }
                $classStudents = $class->students ?? collect();
                foreach ($classStudents as $student) {
                    if (!in_array($student, $students)) {
                        $students[] = $student;
                    }
                }
            }
        }
        
        return view('teacher.dashboard', compact('teacher', 'subjects', 'classes', 'students'));
    }

    /**
     * Display the teacher profile.
     */
    public function profile()
    {
        $teacher = Auth::user()->Teacher;
        
        if (!$teacher) {
            return redirect()->route('dashboard')->with('error', 'Teacher profile not found. Please contact administrator.');
        }
        
        return view('teacher.profile', compact('teacher'));
    }

    /**
     * Display the teacher's classes.
     */
    public function myClasses()
    {
        $teacher = Auth::user()->Teacher;
        
        if (!$teacher) {
            return redirect()->route('dashboard')->with('error', 'Teacher profile not found. Please contact administrator.');
        }
        
        $subjects = $teacher->subjects ?? collect();
        $classes = [];
        
        foreach ($subjects as $subject) {
            $subjectClasses = $subject->classes ?? collect();
            foreach ($subjectClasses as $class) {
                if (!in_array($class, $classes)) {
                    $classes[] = $class;
                }
            }
        }
        
        return view('teacher.classes', compact('teacher', 'classes', 'subjects'));
    }

    /**
     * Display the teacher's subjects.
     */
    public function mySubjects()
    {
        $teacher = Auth::user()->Teacher;
        
        if (!$teacher) {
            return redirect()->route('dashboard')->with('error', 'Teacher profile not found. Please contact administrator.');
        }
        
        $subjects = $teacher->subjects ?? collect();
        
        return view('teacher.subjects', compact('teacher', 'subjects'));
    }

    /**
     * Display the teacher's students.
     */
    public function myStudents()
    {
        $teacher = Auth::user()->Teacher;
        
        if (!$teacher) {
            return redirect()->route('dashboard')->with('error', 'Teacher profile not found. Please contact administrator.');
        }
        
        $subjects = $teacher->subjects ?? collect();
        $students = [];
        
        foreach ($subjects as $subject) {
            $subjectClasses = $subject->classes ?? collect();
            foreach ($subjectClasses as $class) {
                $classStudents = $class->students ?? collect();
                foreach ($classStudents as $student) {
                    if (!in_array($student, $students)) {
                        $students[] = $student;
                    }
                }
            }
        }
        
        return view('teacher.students', compact('teacher', 'students'));
    }
}
