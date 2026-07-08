<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentDocument;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Builder\Stub;

class StudentDocumentController extends Controller
{
    
        public function student_document_add(){
            $students = Student::all();
            return view('Admin.students.student_documents.student_document_add',compact('students'));
        }
        public function student_document_save(Request $request){
             $request ->validate([
            'student_id' => ['required'],
            'document_name' => ['required', 'string', 'max:255'],
            'document_file' => ['required', 'file', 'mimes:pdf,doc,docx,png,jpg,jpeg'],
            'upload_date' => ['nullable', 'date'],
        ]);

        $document = new StudentDocument();
        $document->student_id= $request->student_id;
        $document->document_name = $request->document_name;
        $document->upload_date = $request->upload_date;
        $file = $request->document_file;
        $file_name = time() . "_".$file->getClientOriginalName();
        $request->document_file ->move('images/student_document/',$file_name);

        $document->document_file = $file_name;
        $document->save();
        return redirect()->route('student_document_list')->with('success','Document Inserted Successfully!');
        }
         public function student_document_list(){
        $documents = StudentDocument::all();
        return view('Admin.students.student_documents.student_document_list' ,compact('documents'));
    }


    public function student_document_edit($id){
        $students = Student::all();
        $document = StudentDocument::find($id);
        return view('Admin.students.student_documents.student_document_edit',compact('document','students'));

    }

    public function student_document_update(Request $request,$id){
        $document = StudentDocument::find($id);
         $request ->validate([
            'student_id' => ['required'],
            'document_name' => ['required', 'string', 'max:255'],
            'upload_date' => ['nullable', 'date'],
        ]);

        if(!is_null($request->document_file)){
            $request->validate([
                'document_file' => ['required', 'file', 'mimes:pdf,doc,docx,png,jpg,jpeg']
            ]);
        }

         $document->student_id= $request->student_id;
        $document->document_name = $request->document_name;
        $document->upload_date = $request->upload_date;


        if ($request->hasFile('document_file')) {
        $file = $request->file('document_file');

        if ($document->document_file && file_exists(public_path('images/student_document/' . $document->document_file))) {
            unlink(public_path('images/student_document/' . $document->document_file));
        }

        $file_name = time() . "_".$file->getClientOriginalName();
        $file ->move('images/student_document/',$file_name);
        $document->document_file = $file_name;
        }
        $document->save();
        return redirect()->route('student_document_list')->with('success','Document Updated Successfully!');

    }
    public function student_document_delete($id){
        $document = StudentDocument::find($id);
         $file_path = public_path('images/student_document/') . $document->document_file;
        
        if(File::exists($file_path)){
            File::delete($file_path);
        }
        $document->delete();
        return redirect()->route('student_document_list')->with('success','Document Deleted Successfully!');
    }


    public function student_file_download($document_file){
        $path = public_path('images/student_document/'.$document_file);
           if(!file_exists($path)){
            return redirect()->back()->with('error','No found!');
           }
           return response()->download($path);
    }

}
