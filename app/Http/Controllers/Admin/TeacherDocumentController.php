<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeacherDocument;
use Illuminate\Http\Request;

class TeacherDocumentController extends Controller
{
    
     public function teacher_document_list(){
        $documents = TeacherDocument::all();
        return view('Admin.teachers.teacher_documents.teacher_document_list' ,compact('documents'));
    }

    public function teacher_document_add(){
        $teachers = Teacher::all();
        return view('Admin.teachers.teacher_documents.teacher_document_add' ,compact('teachers'));
    }

    public function teacher_document_save(Request $request){
        $request ->validate([
            'teacher_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'file' => ['required', 'file', 'mimes:pdf,doc,docx,png,jpg,jpeg'],
            'upload_date' => ['nullable', 'date'],
        ]);
        

        $document = new TeacherDocument();
        $document->teacher_id= $request->teacher_id;
        $document->document_name = $request->name;
        $document->upload_date = $request->upload_date;
        $file = $request->file;
        $file_name = time() . "_".$file->getClientOriginalName();
        $request->file ->move('images/teacher_document/',$file_name);

        $document->document_file = $file_name;
        $document->save();
        return redirect()->route('teacher_document_list')->with('success','Document Inserted Successfully!');
    }
   

    public function teacher_document_edit($id){
        $teachers = Teacher::all();
        $document = TeacherDocument::find($id);
        return view('Admin.teachers.teacher_documents.teacher_document_edit',compact('document','teachers'));
    }


    public function teacher_document_update(Request $request , $id){
        $document =TeacherDocument::find($id);

        $request->validate([
             'teacher_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'upload_date' => ['nullable', 'date'],
        ]);

        if(!is_null($request->file)){
            $request->validate([
                'file' => ['required', 'file', 'mimes:pdf,doc,docx,png,jpg,jpeg']
            ]);

        
        }
        
        $document->teacher_id= $request->teacher_id;
        $document->document_name = $request->name;
        $document->upload_date = $request->upload_date;

        
        if ($request->hasFile('file')) {
        $file = $request->file('file');

        if ($document->document_file && file_exists(public_path('images/teacher_document/' . $document->document_file))) {
            unlink(public_path('images/teacher_document/' . $document->document_file));
        }

        $file_name = time() . "_".$file->getClientOriginalName();
        $file ->move('images/teacher_document/',$file_name);
        $document->document_file = $file_name;
        }
        $document->save();
        return redirect()->route('teacher_document_list')->with('success','Document Updated Successfully!');

    }

    public function teacher_document_delete($id){
        $document = TeacherDocument::find($id);
         $file_path = public_path('images/teacher_document/') . $document->document_file;
        
        if(File::exists($file_path)){
            File::delete($file_path);
        }
        $document->delete();
        return redirect()->route('teacher_document_list')->with('success','Document Deleted Successfully!');
        }

        public function  teacher_file_download($document_file){
           $path = public_path('images/teacher_document/'.$document_file);
           if(!file_exists($path)){
            return redirect()->back()->with('error','No found!');
           }
           return response()->download($path);
    }

}
