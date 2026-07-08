<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Timetable;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public function timetable_list(Request $request)
    {
        $query = Timetable::with(['teacher', 'subject', 'class']);

        // 👇 FILTER by class
        if ($request->class_id) {
            $query->where('class_id', $request->class_id);
        }

        $timetables = $query->get();

        $table = [];

        foreach ($timetables as $tt) {
            $table[$tt->weekday][$tt->time] = $tt;
        }

        $classes = \App\Models\Classe::all();

        $days = [
            1 => 'Saturday',
            2 => 'Sunday',
            3 => 'Monday',
            4 => 'Tuesday',
            5 => 'Wednesday',
            6 => 'Thursday',
        ];

        $periods = [1, 2, 3, 4, 5, 6, 7];

        return view('Admin.timetables.timetable_list', compact(
            'table',
            'classes',
            'days',
            'periods'
        ));
    }

    public function timetable_add()
    {
        $teachers = Teacher::all();
        $subjects = Subject::all();
        $classes = Classe::all();
        return view('Admin.timetables.timetable_add', compact('teachers', 'subjects', 'classes'));
    }


    public function timetable_save(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'class_id'   => 'required|integer',
            'weekday'    => 'required|integer|min:1|max:6',
            'time'       => 'required|integer|min:1|max:7',
        ]);

        // ❗ جلوگیری از تداخل استاد
        $exists = Timetable::where('teacher_id', $request->teacher_id)
            ->where('weekday', $request->weekday)
            ->where('time', $request->time)
            ->exists();

        if ($exists) {
            return back()->with('error', 'This teacher already has a class at this time.');
        }

        // ❗ جلوگیری از تداخل صنف (خیلی مهم)
        $classConflict = Timetable::where('class_id', $request->class_id)
            ->where('weekday', $request->weekday)
            ->where('time', $request->time)
            ->exists();

        if ($classConflict) {
            return back()->with('error', 'This class already has a subject at this time.');
        }

        // ذخیره
        Timetable::create([
            'teacher_id' => $request->teacher_id,
            'subject_id' => $request->subject_id,
            'class_id'   => $request->class_id,
            'weekday'    => $request->weekday,
            'time'       => $request->time,
        ]);

        return redirect()->route('timetable_list')
            ->with('success', 'Timetable created successfully.');
    }

    public function timetable_edit($id)
    {
        $timetable = Timetable::find($id);
        $teachers = Teacher::all();
        $subjects = Subject::all();
        $classes = Classe::all();
        return view('Admin.timetables.timetable_edit', compact('timetable', 'teachers', 'subjects', 'classes'));
    }


    public function timetable_update(Request $request, $id)
    {
        $request->validate([
            'teacher_id' => 'required',
            'subject_id' => 'required',
            'class_id'   => 'required',
            'weekday'    => 'required|integer|min:1|max:6',
            'time'       => 'required|integer|min:1|max:7',
        ]);

        $timetable = Timetable::findOrFail($id);

        // ❗ جلوگیری از تداخل استاد (به جز خودش)
        $teacherConflict = Timetable::where('teacher_id', $request->teacher_id)
            ->where('weekday', $request->weekday)
            ->where('time', $request->time)
            ->where('id', '!=', $id)
            ->exists();

        if ($teacherConflict) {
            return back()->with('error', 'Teacher already has class at this time.');
        }

        // ❗ جلوگیری از تداخل صنف
        $classConflict = Timetable::where('class_id', $request->class_id)
            ->where('weekday', $request->weekday)
            ->where('time', $request->time)
            ->where('id', '!=', $id)
            ->exists();

        if ($classConflict) {
            return back()->with('error', 'Class already has subject at this time.');
        }

        // update
        $timetable->update([
            'teacher_id' => $request->teacher_id,
            'subject_id' => $request->subject_id,
            'class_id'   => $request->class_id,
            'weekday'    => $request->weekday,
            'time'       => $request->time,
        ]);

        return redirect()->route('timetable_list')
            ->with('success', 'Timetable updated successfully.');
    }

    public function timetable_delete($id)
    {
        $timetable = Timetable::find($id);
        $timetable->delete();
        return redirect()->route('timetable_list')
            ->with('success', 'Timetable deleted successfully.');
    }
}
