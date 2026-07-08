<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\EmployeeAttendanceController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\EmployeeDocumentController;
use App\Http\Controllers\Admin\EmployeeSalaryController;
use App\Http\Controllers\Admin\IncomeController;
use App\Http\Controllers\Admin\OutcomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ScoreController;
use App\Http\Controllers\Admin\StudentAttendanceController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\StudentDocumentController;
use App\Http\Controllers\Admin\StudentFeesController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherAttendanceController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\TeacherDocumentController;
use App\Http\Controllers\Admin\TeacherSalaryController;
use App\Http\Controllers\Admin\TimetableController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CertificatController;
use App\Http\Controllers\Website\CourseController;
use App\Http\Controllers\Website\ContactController;
use App\Http\Controllers\Website\TestimonialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\Website\ManController;
use App\IncomeSource;
use Illuminate\Support\Facades\Route;



// Route::get('home_page', [AboutController::class, 'home_page'])->name('home_page');
Route::get('about', [AboutController::class, 'about'])->name('about');
Route::get('/', [AboutController::class, 'home_page'])->name('home_page');
Route::get('course', [CourseController::class, 'course'])->name('course');
Route::get('contact', [ContactController::class, 'contact'])->name('contact');
Route::get('testimonial', [TestimonialController::class, 'testimonial'])->name('testimonial');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/teacher/dashboard', [TeacherDashboardController::class, 'index'])
    ->middleware('auth')
    ->name('teacher.dashboard');

Route::get('/teacher/doshboard', [TeacherDashboardController::class, 'index'])
    ->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //employees managment
    Route::get('/employee_add', [EmployeeController::class, 'employee_add'])->name('employee_add');
    Route::post('employee_save', [EmployeeController::class, 'employee_save'])->name('employee_save');
    Route::get('employee_list', [EmployeeController::class, 'employee_list'])->name('employee_list');
    Route::get('employee_edit/{id}/', [EmployeeController::class, 'employee_edit'])->name('employee_edit');
    Route::get('employee_deatil/{id}/', [EmployeeController::class, 'employee_detail'])->name('employee_detail');
    Route::put('employee_update/{id}/', [EmployeeController::class, 'employee_update'])->name('employee_update');
    Route::get('employee_delete/{id}/', [EmployeeController::class, 'employee_delete'])->name('employee_delete');


    //employee document managEmployeeSalaryController

    Route::get('/emp_document_list', [EmployeeDocumentController::class, 'emp_document_list'])->name('emp_document_list');
    Route::get('emp_document_add', [EmployeeDocumentController::class, 'emp_document_add'])->name('emp_document_add');
    Route::post('emp_document_save', [EmployeeDocumentController::class, 'emp_document_save'])->name('emp_document_save');
    Route::get('emp_document_edit/{id}', [EmployeeDocumentController::class, 'emp_document_edit'])->name('emp_document_edit');
    Route::put('emp_document_update/{id}', [EmployeeDocumentController::class, 'emp_document_update'])->name('emp_document_update');
    Route::get('emp_document_delete/{id}', [EmployeeDocumentController::class, 'emp_document_delete'])->name('emp_document_delete');
    Route::get('emp_file_download/{document_file}', [EmployeeDocumentController::class, 'emp_file_download'])->name('emp_file_download');

    //employee Attendance
    Route::get('emp_attendance_list/', [EmployeeAttendanceController::class, 'emp_attendance_list'])->name('emp_attendance_list');
    Route::get('emp_attendance_add', [EmployeeAttendanceController::class, 'emp_attendance_add'])->name('emp_attendance_add');
    Route::post('emp_attendance_save', [EmployeeAttendanceController::class, 'emp_attendance_save'])->name('emp_attendance_save');
    Route::get('emp_attendance_detail/{id}/{year}/{month}', [EmployeeAttendanceController::class, 'emp_attendance_detail'])->name('emp_attendance_detail');
    Route::get('emp_attendance_delete/{id}', [EmployeeAttendanceController::class, 'emp_attendance_delete'])->name('emp_attendance_delete');

    //employee salary
    Route::get('employee_salary_list', [EmployeeSalaryController::class, 'employee_salary_list'])->name('employee_salary_list');
    Route::get('employee_salary_count/{id}/{year}/{month}', [EmployeeSalaryController::class, 'employee_salary_count'])->name('employee_salary_count');
    Route::post('employee_salary_save/{id}', [EmployeeSalaryController::class, 'employee_salary_save'])->name('employee_salary_save');
    Route::get('employee_salary_delete/{id}/{year}/{month}', [EmployeeSalaryController::class, 'employee_salary_delete'])->name('employee_salary_delete');
    Route::get('employee_salary_payment', [EmployeeSalaryController::class, 'employee_salary_payment'])->name('employee_salary_payment');
    Route::get('employee_salary_pay/{id}/{year}/{month}', [EmployeeSalaryController::class, 'employee_salary_pay'])->name('employee_salary_pay');


    //teacher managment
    Route::get('/teacher_add', [TeacherController::class, 'teacher_add'])->name('teacher_add');
    Route::post('teacher_save', [TeacherController::class, 'teacher_save'])->name('teacher_save');
    Route::get('teacher_list', [TeacherController::class, 'teacher_list'])->name('teacher_list');
    Route::get('teacher_detail/{id}', [TeacherController::class, 'teacher_detail'])->name('teacher_detail');
    Route::get('teacher_edit/{id}', [TeacherController::class, 'teacher_edit'])->name('teacher_edit');
    Route::put('teacher_update/{id}', [TeacherController::class, 'teacher_update'])->name('teacher_update');
    Route::get('teacher_delete/{id}', [TeacherController::class, 'teacher_delete'])->name('teacher_delete');

    // teacher document management

    Route::get('/teacher_document_list', [TeacherDocumentController::class, 'teacher_document_list'])->name('teacher_document_list');
    Route::get('teacher_document_add', [TeacherDocumentController::class, 'teacher_document_add'])->name('teacher_document_add');
    Route::post('teacher_document_save', [TeacherDocumentController::class, 'teacher_document_save'])->name('teacher_document_save');
    Route::get('teacher_document_edit/{id}', [TeacherDocumentController::class, 'teacher_document_edit'])->name('teacher_document_edit');
    Route::put('teacher_document_udpate/{id}', [TeacherDocumentController::class, 'teacher_document_update'])->name('teacher_document_update');
    Route::get('teacher_document_delete/{id}', [TeacherDocumentController::class, 'teacher_document_delete'])->name('teacher_document_delete');
    Route::get('teacher_file_download/{document_file}', [TeacherDocumentController::class, 'teacher_file_download'])->name('teacher_file_download');

    //teacher Attendance managment
    Route::get('teacher_attendance_add', [TeacherAttendanceController::class, 'teacher_attendance_add'])->name('teacher_attendance_add');
    Route::get('teacher_attendance_list', [TeacherAttendanceController::class, 'teacher_attendance_list'])->name('teacher_attendance_list');
    Route::post('teacher_attendance_save', [TeacherAttendanceController::class, 'teacher_attendance_save'])->name('teacher_attendance_save');
    Route::get('teacher_attendance_detail/{id}/{year}/{month}', [TeacherAttendanceController::class, 'teacher_attendance_detail'])->name('teacher_attendance_detail');
    Route::get('teacher_attendance_delete/{id}', [TeacherAttendanceController::class, 'teacher_attendance_delete'])->name('teacher_attendance_delete');
    Route::get('teacher_attendance_edite/{id}', [TeacherAttendanceController::class, 'teacher_attendance_edite'])->name('teacher_attendance_edite');

    //teacher salary managments
    Route::get('teacher_salary_list', [TeacherSalaryController::class, 'teacher_salary_list'])->name('teacher_salary_list');
    Route::get('teacher_salary_count/{id}/{year}/{month}', [TeacherSalaryController::class, 'teacher_salary_count'])->name('teacher_salary_count');
    Route::post('teacher_salary_save/{id}', [TeacherSalaryController::class, 'teacher_salary_save'])->name('teacher_salary_save');
    Route::get('teacher_salary_delete/{id}/{year}/{month}', [TeacherSalaryController::class, 'teacher_salary_delete'])->name('teacher_salary_delete');
    Route::get('teacher_salary_payment', [TeacherSalaryController::class, 'teacher_salary_payment'])->name('teacher_salary_payment');
    Route::get('teacher_salary_pay/{id}/{year}/{month}', [TeacherSalaryController::class, 'teacher_salary_pay'])->name('teacher_salary_pay');
    //class managment

    Route::get('/class_add', [ClassController::class, 'class_add'])->name('class_add');
    Route::post('class_save', [ClassController::class, 'class_save'])->name('class_save');
    Route::get('class_list', [ClassController::class, 'class_list'])->name('class_list');
    Route::get('class_edit/{id}', [ClassController::class, 'class_edit'])->name('class_edit');
    Route::put('class_update/{id}', [ClassController::class, 'class_update'])->name('class_update');
    Route::get('class_delete/{id}', [ClassController::class, 'class_delete'])->name('class_delete');


    // subject managment
    Route::get('/subject_list', [SubjectController::class, 'subject_list'])->name('subject_list');
    Route::get('subject_add', [SubjectController::class, 'subject_add'])->name('subject_add');
    Route::post('subject_save', [SubjectController::class, 'subject_save'])->name('subject_save');
    Route::get('subject_edit/{id}', [SubjectController::class, 'subject_edit'])->name('subject_edit');
    Route::put('subject_update/{id}', [SubjectController::class, 'subject_update'])->name('subject_update');
    Route::delete('subject_delete/{id}', [SubjectController::class, 'subject_delete'])->name('subject_delete');
    Route::get('subject_detail/{id}',[SubjectController::class, 'subject_detail'])->name('subject_detail');
    Route::get('add_teacher_to_subject/{id}',[SubjectController::class, 'add_teacher_to_subject'])->name('add_teacher_to_subject');
    Route::post('save_teacher_to_subject/{id}',[SubjectController::class, 'save_teacher_to_subject'])->name('save_teacher_to_subject');
    Route::get('add_student_to_subject/{id}',[SubjectController::class, 'add_student_to_subject'])->name('add_student_to_subject');
    Route::post('save_student_to_subject/{id}',[SubjectController::class, 'save_student_to_subject'])->name('save_student_to_subject');
    //Student managment
    Route::get('/student_add', [StudentController::class, 'student_add'])->name('student_add');
    Route::post('student_save', [StudentController::class, 'student_save'])->name('student_save');
    Route::get('student_list', [StudentController::class, 'student_list'])->name('student_list');
    Route::get('student_detail/{id}', [StudentController::class, 'student_detail'])->name('student_detail');
    Route::get('student_edit/{id}', [StudentController::class, 'student_edit'])->name('student_edit');
    Route::put('student_update/{id}', [StudentController::class, 'student_update'])->name('student_update');
    Route::get('student_delete/{id}', [StudentController::class, 'student_delete'])->name('student_delete');

    //student fees managmebt
    Route::get('student_fees_list', [StudentFeesController::class, 'student_fees_list'])->name('student_fees_list');
    Route::get('student_fees_add', [StudentFeesController::class, 'student_fees_add'])->name('student_fees_add');
    Route::get('/student-info/{id}', [StudentFeesController::class, 'studentInfo']);
    Route::post('student_fees_save', [StudentFeesController::class, 'student_fees_save'])->name('student_fees_save');
    Route::get('student_fees_delete/{id}/{year}/{month}', [StudentFeesController::class, 'student_fees_delete'])->name('student_fees_delete');
    //students document mangment

    Route::get('/student_document_add', [StudentDocumentController::class, 'student_document_add'])->name('student_document_add');
    Route::post('student_document_save', [StudentDocumentController::class, 'student_document_save'])->name('student_document_save');
    Route::get('student_document_list', [StudentDocumentController::class, 'student_document_list'])->name('student_document_list');
    Route::get('student_document_edit/{id}', [StudentDocumentController::class, 'student_document_edit'])->name('student_document_edit');
    Route::put('student_document_update/{id}', [StudentDocumentController::class, 'student_document_update'])->name('student_document_update');
    Route::get('student_document_delete/{id}', [StudentDocumentController::class, 'student_document_delete'])->name('student_document_delete');
    Route::get('student_file_download/{document_file}', [StudentDocumentController::class, 'student_file_download'])->name('student_file_download');

    //Student attendance managmet

    Route::get('student_attendance_list', [StudentAttendanceController::class, 'student_attendance_list'])->name('student_attendance_list');
    Route::get('student_attendance_add', [StudentAttendanceController::class, 'student_attendance_add'])->name('student_attendance_add');
    Route::post('student_attendance_save', [StudentAttendanceController::class, 'student_attendance_save'])->name('student_attendance_save');
    Route::get('student_attendance_detail/{id}/{year}/{month}', [StudentAttendanceController::class, 'student_attendance_detail'])->name('student_attendance_detail');
    Route::get('student_attendance_delete/{id}/{year}/{month}', [StudentAttendanceController::class, 'student_attendance_delete'])->name('student_attendance_delete');


    //assign subjects to class
    Route::get('assign_subject_to_class/{id}', [ClassController::class, 'assign_subject_to_class'])->name('assign_subject_to_class');
    Route::post('assign_subject_to_class_save', [ClassController::class, 'assign_subject_to_class_save'])->name('assign_subject_to_class_save');

    //class student list
    Route::get('class_student_list/{id}', [ClassController::class, 'class_student_list'])->name('class_student_list');

    //class detail
    Route::get('/class_detail/{id}', [ClassController::class, 'class_detail'])->name('class_detail');

    //Income managment

    Route::get('income_list', [IncomeController::class, 'income_list'])->name('income_list');
    Route::get('income_add', [IncomeController::class, 'income_add'])->name('income_add');
    Route::post('income_save', [IncomeController::class, 'income_save'])->name('income_save');
    Route::get('income_edit/{id}', [IncomeController::class, 'income_edit'])->name('income_edit');
    Route::put('income_update/{id}', [IncomeController::class, 'income_update'])->name('income_update');
    Route::get('income_delete/{id}', [IncomeController::class, 'income_delete'])->name('income_delete');

    // income source managment
    Route::get('income_source_list', [IncomeController::class, 'income_source_list'])->name('income_source_list');
    Route::get('income_source_add', [IncomeController::class, 'income_source_add'])->name('income_source_add');
    Route::post('income_source_save', [IncomeController::class, 'income_source_save'])->name('income_source_save');
    Route::get('income_source_edit/{id}', [IncomeController::class, 'income_source_edit'])->name('income_source_edit');
    Route::put('income_source_update/{id}', [IncomeController::class, 'income_source_update'])->name('income_source_update');
    Route::get('income_source_delete/{id}', [IncomeController::class, 'income_source_delete'])->name('income_source_delete');
});


//outcome source controller
Route::get('outcome_source_list', [OutcomeController::class, 'outcome_source_list'])->name('outcome_source_list');
Route::get('outcome_source_add', [OutcomeController::class, 'outcome_source_add'])->name('outcome_source_add');
Route::post('outcome_source_save', [OutcomeController::class, 'outcome_source_save'])->name('outcome_source_save');
Route::get('outcome_source_edit/{id}', [OutcomeController::class, 'outcome_source_edit'])->name('outcome_source_edit');
Route::put('outcome_source_update/{id}', [OutcomeController::class, 'outcome_source_update'])->name('outcome_source_update');
Route::get('outcome_source_delete/{id}', [OutcomeController::class, 'outcome_source_delete'])->name('outcome_source_delete');

//outcome controller
Route::get('outcome_list', [OutcomeController::class, 'outcome_list'])->name('outcome_list');
Route::get('outcome_add', [OutcomeController::class, 'outcome_add'])->name('outcome_add');
Route::post('outcome_save', [OutcomeController::class, 'outcome_save'])->name('outcome_save');
Route::get('outcome_edit/{id}', [OutcomeController::class, 'outcome_edit'])->name('outcome_edit');
Route::put('outcome_update/{id}', [OutcomeController::class, 'outcome_update'])->name('outcome_update');
Route::get('outcome_delete/{id}', [OutcomeController::class, 'outcome_delete'])->name('outcome_delete');

// score managment
Route::get('score_add', [ScoreController::class, 'score_add'])->name('score_add');
Route::post('score_save', [ScoreController::class, 'score_save'])->name('score_save');
Route::get('score_list', [ScoreController::class, 'score_list'])->name('score_list');
Route::get('score_edit/{id}', [ScoreController::class, 'score_edit'])->name('score_edit');
Route::put('score_update/{id}', [ScoreController::class, 'score_update'])->name('score_update');
Route::get('score_delete/{id}', [ScoreController::class, 'score_delete'])->name('score_delete');

//cirtificat managment
Route::get('/certificat/{id}', [CertificatController::class, 'index'])
    ->name('certificat_add');

Route::get('/certificat/pdf/{id}', [CertificatController::class, 'download'])
    ->name('download');


// Timetable managment

Route::get('timetable_list', [TimetableController::class, 'timetable_list'])->name('timetable_list');
Route::get('timetable_add', [TimetableController::class, 'timetable_add'])->name('timetable_add');
Route::post('timetable_save', [TimetableController::class, 'timetable_save'])->name('timetable_save');
Route::get('timetable_edit/{id}', [TimetableController::class, 'timetable_edit'])->name('timetable_edit');
Route::put('timetable_update/{id}', [TimetableController::class, 'timetable_update'])->name('timetable_update');
Route::get('timetable_delete/{id}', [TimetableController::class, 'timetable_delete'])->name('timetable_delete');


// Roll managments
Route::get('role_list', [RoleController::class, 'role_list'])->name('role_list');
Route::get('role_add', [RoleController::class, 'role_add'])->name('role_add');
Route::post('role_save', [RoleController::class, 'role_save'])->name('role_save');
Route::get('role_edit/{id}', [RoleController::class, 'role_edit'])->name('role_edit');
Route::put('role_update/{id}', [RoleController::class, 'role_update'])->name('role_update');
Route::get('role_delete/{id}', [RoleController::class, 'role_delete'])->name('role_delete');


// Permision managment
Route::get('permission_list', [PermissionController::class, 'permission_list'])->name('permission_list');
Route::get('permission_add', [PermissionController::class, 'permission_add'])->name('permission_add');
Route::post('permission_save', [PermissionController::class, 'permission_save'])->name('permission_save');
Route::get('permission_edit/{id}', [PermissionController::class, 'permission_edit'])->name('permission_edit');
Route::put('permission_update/{id}', [PermissionController::class, 'permission_update'])->name('permission_update');
Route::get('permission_delete/{id}', [PermissionController::class, 'permission_delete'])->name('permission_delete');
//add role in permission mangment
Route::get('role_to_permission_list', [RoleController::class, 'role_to_permission_list'])->name('role_to_permission_list');
Route::get('add_role_in_permission', [RoleController::class, 'add_role_in_permission'])->name('add_role_in_permission');
Route::post('role_to_permission_save', [RoleController::class, 'role_to_permission_save'])->name('role_to_permission_save');
Route::get('role_to_permission_edit/{id}', [RoleController::class, 'role_to_permission_edit'])->name('role_to_permission_edit');
Route::put('role_to_permission_update/{id}', [RoleController::class, 'role_to_permission_update'])->name('role_to_permission_update');
Route::get('role_to_permission_delete/{id}', [RoleController::class, 'role_to_permission_delete'])->name('role_to_permission_delete');


// user managment for employee
Route::get('emp_user_list', [UserController::class, 'emp_user_list'])->name('emp_user_list');
Route::get('emp_user_add', [UserController::class, 'emp_user_add'])->name('emp_user_add');
Route::post('emp_user_save', [UserController::class, 'emp_user_save'])->name('emp_user_save');
Route::get('emp_user_edit/{id}', [UserController::class, 'emp_user_edit'])->name('emp_user_edit');
Route::put('emp_user_update/{id}', [UserController::class, 'emp_user_update'])->name('emp_user_update');
Route::get('emp_user_delete/{id}', [UserController::class, 'emp_user_delete'])->name('emp_user_delete');

// user managment for teacher
Route::get('teacher_user_list', [UserController::class, 'teacher_user_list'])->name('teacher_user_list');
Route::get('teacher_user_add', [UserController::class, 'teacher_user_add'])->name('teacher_user_add');
Route::post('teacher_user_save', [UserController::class, 'teacher_user_save'])->name('teacher_user_save');
Route::get('teacher_user_edit/{id}', [UserController::class, 'teacher_user_edit'])->name('teacher_user_edit');
Route::put('teacher_user_update/{id}', [UserController::class, 'teacher_user_update'])->name('teacher_user_update');
Route::get('teacher_user_delete/{id}', [UserController::class, 'teacher_user_delete'])->name('teacher_user_delete');
// the webside managment

Route::get('about_list', [AboutController::class, 'about_list'])->name('about_list');
Route::get('about_add', [AboutController::class, 'about_add'])->name('about_add');
Route::post('about_save', [AboutController::class, 'about_save'])->name('about_save');
Route::get('about_edit/{id}', [AboutController::class, 'about_edit'])->name('about_edit');
Route::put('about_update/{id}', [AboutController::class, 'about_update'])->name('about_update');
Route::get('about_delete/{id}', [AboutController::class, 'about_delete'])->name('about_delete');
//courses management
Route::get('course_list',[CourseController::class, 'course_list' ])->name('course_list');
Route::get('course_add',[CourseController::class, 'course_add' ])->name('course_add');
Route::post('course_save',[CourseController::class, 'course_save' ])->name('course_save');
Route::get('course_edit/{id}',[CourseController::class, 'course_edit' ])->name('course_edit');
Route::put('course_update/{id}',[CourseController::class, 'course_update' ])->name('course_update');
Route::put('course_delete/{id}',[CourseController::class, 'course_delete' ])->name('course_delete');
//Testimonidal managment
Route::get('testimonial_list',[TestimonialController::class, 'testimonial_list' ])->name('testimonial_list');
Route::get('testimonial_add',[TestimonialController::class, 'testimonial_add' ])->name('testimonial_add');
Route::post('testimonial_save',[TestimonialController::class, 'testimonial_save' ])->name('testimonial_save');
Route::get('testimonial_edit/{id}',[TestimonialController::class, 'testimonial_edit' ])->name('testimonial_edit');
Route::put('testimonial_update/{id}',[TestimonialController::class, 'testimonial_update' ])->name('testimonial_update');
Route::get('testimonial_delete/{id}',[TestimonialController::class, 'testimonial_delete' ])->name('testimonial_delete');
//contact  management
Route::get('contact_list',[ContactController::class, 'contact_list' ])->name('contact_list');
Route::get('contact_add',[ContactController::class, 'contact_add' ])->name('contact_add');
Route::post('contact_save',[ContactController::class, 'contact_save' ])->name('contact_save');
Route::get('contact_edit/{id}',[ContactController::class, 'contact_edit' ])->name('contact_edit');
Route::put('contact_update/{id}',[ContactController::class, 'contact_update' ])->name('contact_update');
Route::get('contact_delete/{id}',[ContactController::class, 'contact_delete' ])->name('contact_delete');
// tes


require __DIR__ . '/auth.php';
