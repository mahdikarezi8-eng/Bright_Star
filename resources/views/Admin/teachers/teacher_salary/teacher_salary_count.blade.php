 @extends('Admin.master')
 @section('content')
     <div class='card mt-3 mr-3 ml-3'>
         <div class="card-body">
             <h4 class="card-title">Count teacher Salary</h4>
             @php
                 $month = request('month', date('n'));
                 $year = request('year', date('Y'));
             @endphp
             <br>
             <hr class="mt-3" style="margin-top: 10px;">

             <form class="form-sample" action="{{ route('teacher_salary_save', $teacher->id) }}" method="post"
                 enctype="multipart/form-data">
                 @csrf
                 <div class="row">
                     <div class="col-md-6">
                         <div class="form-group row">
                             <label class="col-sm-3 col-form-label">Salary Month</label>
                             <div class="col-sm-9">
                                 <select class="form-control  form-select" name="salary_month">
                                     @for ($m = 1; $m <= 12; $m++)
                                         <option class="text-dark" disabled value="{{ $m }}"
                                             {{ $month == $m ? 'selected' : '' }}>
                                             {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                         </option>
                                     @endfor
                                 </select>
                                 <input type="hidden" name="salary_month" value="{{ $month }}">
                             </div>
                             @error('salary_month')
                                 <span class="text-danger">{{ $message }}</span>
                             @enderror
                         </div>
                     </div>
                     <div class="col-md-6">
                         <div class="form-group row">
                             <label class="col-sm-3 col-form-label">Salary Year</label>
                             <div class="col-sm-9">
                                 <input readonly type="text" value="{{ date('Y') }}" class="form-control"
                                     name="salary_year">
                             </div>
                             @error('salary_year')
                                 <span class="text-danger">{{ $message }}</span>
                             @enderror
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-md-6">
                         <div class="form-group row">
                             <label class="col-sm-3 col-form-label">Gross Salary</label>
                             <div class="col-sm-9">
                                 <div class="input-group">
                                     <input readonly type="text" id="gross_salary" class="form-control"
                                         value="{{ $teacher->gross_salary }}" name="gross_salary">
                                     <span class="input-group-text">AF</span>
                                 </div>
                             </div>
                         </div>
                     </div>
                     @error('gross_salary')
                         <span class="text-danger">{{ $message }}</span>
                     @enderror
                     <div class="col-md-6">
                         <div class="form-group row">
                             <label class="col-sm-3 col-form-label">Absent Amount</label>
                             <div class="col-sm-9">
                                 <div class="input-group">
                                     <div class="input-group">
                                         <input readonly id="absent_amount" type="text" value="{{ $absent_amount }}"
                                             class="form-control" name="absent_amount">
                                         <span class="input-group-text">AF</span>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     @error('absent_amount')
                         <span class="text-danger">{{ $message }}</span>
                     @enderror
                 </div>

                 <div class="row">
                     <div class="col-md-6">
                         <div class="form-group row">
                             <label class="col-sm-3 col-form-label">Absent Day</label>
                             <div class="col-sm-9">
                                 <div class="input-group">
                                     <input readonly type="text" value="{{ $absent_days }}" class="form-control"
                                         name="absent_day">
                                     <span class="input-group-text">Day</span>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-6">
                         <div class="form-group row">
                             <label class="col-sm-3 col-form-label">Net Salary</label>
                             <div class="col-sm-9">
                                 <div class="input-group">
                                     <input readonly id="net_salary" type="text" value="{{ $net_salary }}"
                                         class="form-control" name="net_salary">
                                     <span class="input-group-text">AF</span>
                                 </div>
                             </div>
                         </div>
                         @error('net_salary')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-md-6">
                         <div class="form-group row">
                             <label class="col-sm-3 col-form-label">Bonus</label>
                             <div class="col-sm-9">
                                 <div class="input-group">
                                     <input class="form-control" id="bonus" type="text" name="bonus">
                                     <span class="input-group-text">AF</span>
                                 </div>
                             </div>
                         </div>
                         @error('bonus')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="col-md-6">
                         <div class="form-group row">
                             <label class="col-sm-3 col-form-label">Pay Date</label>
                             <div class="col-sm-9">
                                 <input type="date" class="form-control" name="pay_date">
                             </div>
                         </div>
                         @error('pay_date')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                 </div>
                 <button type="submit" class="btn btn-primary mr-2">Save</button>
             </form>
         </div>
     </div>
 @endsection
