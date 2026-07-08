<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Score;
use App\Models\Student;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;

class CertificatController extends Controller
{
    public function index($id)
    {
        $student = Student::findOrFail($id);

        $scores = Score::with('subject')
            ->where('student_id', $id)
            ->get();

        return view('Admin.certificat.index', compact('student', 'scores'));
    }

    public function download($id)
    {

        $student = Student::findOrFail($id);

        $scores = Score::with('subject')
            ->where('student_id', $id)
            ->get();
        $pdf = SnappyPdf::loadView(
            'Admin.certificat.pdf',
            compact('student', 'scores')
        );
        $pdf->setPaper('a4');
        $pdf->setOrientation('landscape');
        return $pdf->download(
            'certificate_' . $student->id . '.pdf'
        );
    }
}
