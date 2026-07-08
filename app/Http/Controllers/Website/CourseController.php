<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function course()
    {
        $classes = Classe::all();
        return view('webside.course.course',compact('classes'));
    }

}
