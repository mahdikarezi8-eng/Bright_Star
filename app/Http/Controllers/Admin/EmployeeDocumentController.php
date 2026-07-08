<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeDocument;
use Illuminate\Http\Request;

class EmployeeDocumentController extends Controller
{
    
     public function emp_document_list(){
        $documents = EmployeeDocument::all();
        return view('Admin.employees.employee_documents.emp_document_list' ,compact('documents'));
    }
    public function emp_document_add(){
        $employees = Employee::all();
        return view('Admin.employees.employee_documents.emp_document_add' ,compact('employees'));
    }

    public function emp_document_save(Request $request){
        $request ->validate([
            'employee_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'file' => ['required', 'file', 'mimes:pdf,doc,docx,png,jpg,jpeg'],
            'upload_date' => ['nullable', 'date'],
        ]);
        
        $document = new EmployeeDocument();
        $document->employee_id= $request->employee_id;
        $document->document_name = $request->name;
        $document->upload_date = $request->upload_date;
        $file = $request->file;
        $file_name = time() . "_".$file->getClientOriginalName();
        $request->file ->move('images/employee_document/',$file_name);

        $document->document_file = $file_name;
        $document->save();
        return redirect()->route('emp_document_list')->with('success','Document Inserted Successfully!');
    }
   
    public function emp_document_edit($id){
        $employees = Employee::all();
        $document = EmployeeDocument::find($id);
        return view('Admin.employees.employee_documents.emp_document_edit',compact('document','employees'));
    }

    public function emp_document_update(Request $request , $id){
        $document =EmployeeDocument::find($id);

        $request->validate([
             'employee_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'upload_date' => ['nullable', 'date'],
        ]);

        if(!is_null($request->file)){
            $request->validate([
                'file' => ['required', 'file', 'mimes:pdf,doc,docx,png,jpg,jpeg']
            ]);

        
        }
        $document->employee_id= $request->employee_id;
        $document->document_name = $request->name;
        $document->upload_date = $request->upload_date;

        
        if ($request->hasFile('file')) {
        $file = $request->file('file');

        if ($document->document_file && file_exists(public_path('images/employee_document/' . $document->document_file))) {
            unlink(public_path('images/employee_document/' . $document->document_file));
        }

        $file_name = time() . "_".$file->getClientOriginalName();
        $file ->move('images/employee_document/',$file_name);
        $document->document_file = $file_name;
        }
        $document->save();
        return redirect()->route('emp_document_list')->with('success','Document Updated Successfully!');

    }

    public function emp_document_delete($id){
        $document = EmployeeDocument::find($id);
         $file_path = public_path('images/employee_document/') . $document->document_file;
        
        if(File::exists($file_path)){
            File::delete($file_path);
            
        }
         $document->delete();
        return redirect()->route('emp_document_list')->with('success','Document Deleted Successfully!');
        
        }

        public function  emp_file_download($document_file){
           $path = public_path('images/employee_document/'.$document_file);
           if(!file_exists($path)){
            return redirect()->back()->with('error','No found!');
           }
           return response()->download($path);
    }

}
