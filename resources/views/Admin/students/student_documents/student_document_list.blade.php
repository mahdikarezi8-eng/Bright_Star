 @extends('Admin.master')
 @section('content')
     <div class="content-wrapper mt-3">
         <div class="card">
             <div class="card-body">
                 <h4 class="card-title d-inline">Students All Document list</h4>
                 <a href="{{ route('student_document_add') }}" class ="btn btn-primary btn-sm float-right">Create new
                     document</a>
                 <div class="table-responsive">
                     <hr>
                     <table id="data" class="table table-striped table-hover">
                         <thead>
                             <tr>
                                 <th>Name</th>
                                 <th>Last Name</th>
                                 <th>
                                     Document Name
                                 </th>ٰ
                                 <th>
                                     File
                                 </th>
                                 <th>
                                     Upload Date
                                 </th>
                                 <th>Update</th>
                                 <th>Delete</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($documents as $document)
                                 <tr>
                                     <td class="py-2 px-2">{{ $document->student->first_name }}</td>
                                     <td class="py-2 px-2">{{ $document->student->last_name }}</td>
                                     <td class="py-2 px-2">{{ $document->document_name }}</td>
                                     <td class="py-2 px-2">
                                         <a href=" {{ route('student_file_download', $document->document_file) }}"><i
                                                 style="font-size: 20px;" class="fa fa-download text-primary"></i></a>
                                     </td>
                                     <td class="py-2 px-2">{{ $document->upload_date }}</td>
                                     <td class="py-2 px-2">
                                         <button class="btn btn-success btn-sm">
                                             <a class="text-light"
                                                 href="{{ route('student_document_edit', $document->id) }}"><span
                                                     class="fa-solid fa-pen-to-square"></span></a>
                                         </button>
                                     </td>
                                     <td class="py-2 px-2">
                                         <a href="{{ route('student_document_delete', $document->id) }}"
                                             class="btn btn-danger btn-sm delete"><i class="fa-solid fa-trash"></i></a>
                                     </td>
                                 </tr>
                             @endforeach
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>
 @endsection
