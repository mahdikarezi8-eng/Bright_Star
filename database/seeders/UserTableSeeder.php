<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions with group_name
        $permissions = [
            // Employee Managment
            ['name' => 'employee_menu', 'group_name' => 'Employee Managment'],
            ['name' => 'employee_add', 'group_name' => 'Employee Managment'],
            ['name' => 'employee_edit', 'group_name' => 'Employee Managment'],
            ['name' => 'employee_delete', 'group_name' => 'Employee Managment'],
            ['name' => 'employee_list', 'group_name' => 'Employee Managment'],
            ['name' => 'employee_document_add', 'group_name' => 'Employee Managment'],
            ['name' => 'employee_document_edit', 'group_name' => 'Employee Managment'],
            ['name' => 'employee_document_delete', 'group_name' => 'Employee Managment'],
            ['name' => 'employee_document_list', 'group_name' => 'Employee Managment'],
            ['name' => 'employee_attendance_add', 'group_name' => 'Employee Managment'],
            ['name' => 'employee_attendance_edit', 'group_name' => 'Employee Managment'],
            ['name' => 'employee_attendance_delete', 'group_name' => 'Employee Managment'],
            ['name' => 'employee_attendance_list', 'group_name' => 'Employee Managment'],
            ['name' => 'employee_salary_add', 'group_name' => 'Employee Managment'],
            ['name' => 'employee_salary_edit', 'group_name' => 'Employee Managment'],
            ['name' => 'employee_salary_delete', 'group_name' => 'Employee Managment'],
            ['name' => 'employee_salary_list', 'group_name' => 'Employee Managment'],
           

            // Teacher Managment
            ['name' => 'teacher_menu', 'group_name' => 'Teacher Managment'],
            ['name' => 'teacher_add', 'group_name' => 'Teacher Managment'],
            ['name' => 'teacher_edit', 'group_name' => 'Teacher Managment'],
            ['name' => 'teacher_delete', 'group_name' => 'Teacher Managment'],
            ['name' => 'teacher_list', 'group_name' => 'Teacher Managment'],
            ['name' => 'teacher_document_add', 'group_name' => 'Teacher Managment'],
            ['name' => 'teacher_document_edit', 'group_name' => 'Teacher Managment'],
            ['name' => 'teacher_document_delete', 'group_name' => 'Teacher Managment'],
            ['name' => 'teacher_document_list', 'group_name' => 'Teacher Managment'],
            ['name' => 'teacher_attendance_add', 'group_name' => 'Teacher Managment'],
            ['name' => 'teacher_attendance_edit', 'group_name' => 'Teacher Managment'],
            ['name' => 'teacher_attendance_delete', 'group_name' => 'Teacher Managment'],
            ['name' => 'teacher_attendance_list', 'group_name' => 'Teacher Managment'],
            ['name' => 'teacher_salary_add', 'group_name' => 'Teacher Managment'],
            ['name' => 'teacher_salary_edit', 'group_name' => 'Teacher Managment'],
            ['name' => 'teacher_salary_delete', 'group_name' => 'Teacher Managment'],
            ['name' => 'teacher_salary_list', 'group_name' => 'Teacher Managment'],
            
            // Student Managment
            ['name' => 'student_menu', 'group_name' => 'Student Managment'],
            ['name' => 'student_add', 'group_name' => 'Student Managment'],
            ['name' => 'student_edit', 'group_name' => 'Student Managment'],
            ['name' => 'student_delete', 'group_name' => 'Student Managment'],
            ['name' => 'student_list', 'group_name' => 'Student Managment'],
            ['name' => 'student_document_add', 'group_name' => 'Student Managment'],
            ['name' => 'student_document_edit', 'group_name' => 'Student Managment'],
            ['name' => 'student_document_delete', 'group_name' => 'Student Managment'],
            ['name' => 'student_document_list', 'group_name' => 'Student Managment'],
            ['name' => 'student_attendance_add', 'group_name' => 'Student Managment'],
            ['name' => 'student_attendance_edit', 'group_name' => 'Student Managment'],
            ['name' => 'student_attendance_delete', 'group_name' => 'Student Managment'],
            ['name' => 'student_attendance_list', 'group_name' => 'Student Managment'],
           

            // Class  And Subject Managment

            ['name' => 'class_&_subject_menu', 'group_name' => 'Class & Subject Managment'],
            ['name' => 'class_add', 'group_name' => 'Class & Subject Managment'],
            ['name' => 'class_edit', 'group_name' => 'Class & Subject Managment'],
            ['name' => 'class_delete', 'group_name' => 'Class & Subject Managment'],
            ['name' => 'class_list', 'group_name' => 'Class & Subject Managment'],
            ['name' => 'assign_subject_to_class', 'group_name' => 'Class & Subject Managment'],
            ['name' => 'class_student_list', 'group_name' => 'Class & Subject Managment'],
            ['name' => 'class_detail', 'group_name' => 'Class & Subject Managment'],

            // Subject Managment
            ['name' => 'subject_add', 'group_name' => 'Class & Subject Managment'],
            ['name' => 'subject_edit', 'group_name' => 'Class & Subject Managment'],
            ['name' => 'subject_delete', 'group_name' => 'Class & Subject Managment'],
            ['name' => 'subject_list', 'group_name' => 'Class & Subject Managment'],
            ['name' => 'subject_detail', 'group_name' => 'Class & Subject Managment'],
            ['name' => 'add_teacher_to_subject', 'group_name' => 'Class & Subject Managment'],
            ['name' => 'add_student_to_subject', 'group_name' => 'Class & Subject Managment'],

            // exam And Score Managment
            ['name' => 'exam_&_score_menu', 'group_name' => 'Exam & Score Managment'],
            ['name' => 'score_add', 'group_name' => 'Exam & Score Managment'],
            ['name' => 'score_edit', 'group_name' => 'Exam & Score Managment'],
            ['name' => 'score_delete', 'group_name' => 'Exam & Score Managment'],
            ['name' => 'score_list', 'group_name' => 'Exam & Score Managment'],
            // Timetable Managment
            ['name' => 'timetable_add', 'group_name' => 'Exam & Score Managment'],
            ['name' => 'timetable_edit', 'group_name' => 'Exam & Score Managment'],
            ['name' => 'timetable_delete', 'group_name' => 'Exam & Score Managment'],
            ['name' => 'timetable_list', 'group_name' => 'Exam & Score Managment'],
            // finance ManagemenFinance
             ['name' => 'finance_menu', 'group_name' => 'Finance Managment'],
             ['name' => 'employee_salary_payment_list', 'group_name' => 'Finance Managment'],
            ['name' => 'teacher_salary_payment_list', 'group_name' => 'Finance Managment'],
        
            ['name' => 'income_add', 'group_name' => 'Finance Managment'],
            ['name' => 'income_edit', 'group_name' => 'Finance Managment'],
            ['name' => 'income_delete', 'group_name' => 'Finance Managment'],
            ['name' => 'income_list', 'group_name' => 'Finance Managment'],
            ['name' => 'income_source_add', 'group_name' => 'Finance Managment'],
            ['name' => 'income_source_edit', 'group_name' => 'Finance Managment'],
            ['name' => 'income_source_delete', 'group_name' => 'Finance Managment'],
            ['name' => 'income_source_list', 'group_name' => 'Finance Managment'],

            // Outcome Managment
            ['name' => 'outcome_add', 'group_name' => 'Finance Managment'],
            ['name' => 'outcome_edit', 'group_name' => 'Finance Managment'],
            ['name' => 'outcome_delete', 'group_name' => 'Finance Managment'],
            ['name' => 'outcome_list', 'group_name' => 'Finance Managment'],
            ['name' => 'outcome_source_add', 'group_name' => 'Finance Managment'],
            ['name' => 'outcome_source_edit', 'group_name' => 'Finance Managment'],
            ['name' => 'outcome_source_delete', 'group_name' => 'Finance Managment'],
            ['name' => 'outcome_source_list', 'group_name' => 'Finance Managment'],

             ['name' => 'student_fees_add', 'group_name' => 'Finance Managment'],
            ['name' => 'student_fees_edit', 'group_name' => 'Finance Managment'],
            ['name' => 'student_fees_delete', 'group_name' => 'Finance Managment'],
            ['name' => 'student_fees_list', 'group_name' => 'Finance Managment'],
            
            //User acout managment
            ['name' => 'user_manage_menu', 'group_name' => 'User Managment'],
            ['name' => 'employee_user_list', 'group_name' => 'User Managment'],
            ['name' => 'employee_user_add', 'group_name' => 'User Managment'],
            ['name' => 'employee_user_edit', 'group_name' => 'User Managment'],
            ['name' => 'employee_user_delete', 'group_name' => 'User Managment'],


            ['name' => 'teacher_user_list', 'group_name' => 'User Managment'],
            ['name' => 'teacher_user_add', 'group_name' => 'User Managment'],
            ['name' => 'teacher_user_edit', 'group_name' => 'User Managment'],
            ['name' => 'teacher_user_delete', 'group_name' => 'User Managment'],
            
            // Role & Permission Managment
            
            ['name' => 'role_&_permission_menu', 'group_name' => 'Role & Permission Managment'],
            ['name' => 'role_add', 'group_name' => 'Role & Permission Managment'],
            ['name' => 'role_edit', 'group_name' => 'Role & Permission Managment'],
            ['name' => 'role_delete', 'group_name' => 'Role & Permission Managment'],
            ['name' => 'role_list', 'group_name' => 'Role & Permission Managment'],
            ['name' => 'permission_add', 'group_name' => 'Role & Permission Managment'],
            ['name' => 'permission_edit', 'group_name' => 'Role & Permission Managment'],
            ['name' => 'permission_delete', 'group_name' => 'Role & Permission Managment'],
            ['name' => 'permission_list', 'group_name' => 'Role & Permission Managment'],
            ['name' => 'role_to_permission_list', 'group_name' => 'Role & Permission Managment'],
            ['name' => 'role_to_permission_add', 'group_name' => 'Role & Permission Managment'],
            ['name' => 'role_to_permission_edit', 'group_name' => 'Role & Permission Managment'],
            ['name' => 'role_to_permission_delete', 'group_name' => 'Role & Permission Managment'],

            // Website Managment

            ['name' => 'website_menu', 'group_name' => 'Website Managment'],
            ['name' => 'about_add', 'group_name' => 'Website Managment'],
            ['name' => 'about_edit', 'group_name' => 'Website Managment'],
            ['name' => 'about_delete', 'group_name' => 'Website Managment'],
            ['name' => 'about_list', 'group_name' => 'Website Managment'],
            ['name' => 'course_add', 'group_name' => 'Website Managment'],
            ['name' => 'course_edit', 'group_name' => 'Website Managment'],
            ['name' => 'course_delete', 'group_name' => 'Website Managment'],
            ['name' => 'course_list', 'group_name' => 'Website Managment'],
            ['name' => 'testimonial_add', 'group_name' => 'Website Managment'],
            ['name' => 'testimonial_edit', 'group_name' => 'Website Managment'],
            ['name' => 'testimonial_delete', 'group_name' => 'Website Managment'],
            ['name' => 'testimonial_list', 'group_name' => 'Website Managment'],
            ['name' => 'contact_add', 'group_name' => 'Website Managment'],
            ['name' => 'contact_edit', 'group_name' => 'Website Managment'],
            ['name' => 'contact_delete', 'group_name' => 'Website Managment'],
            ['name' => 'contact_list', 'group_name' => 'Website Managment'],
            // Dashboard

            ['name' => 'dashboard_list', 'group_name' => 'Dashboard'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission['name'],
                'guard_name' => 'web'
            ], [
                'group_name' => $permission['group_name']
            ]);
        }
        // Create Manager role and assign all permissions
        $managerRole = Role::firstOrCreate(['name' => 'Manager', 'guard_name' => 'web']);
        $managerRole->syncPermissions(Permission::all());

        // Create users
        $manager = User::firstOrCreate(
            ['email' => 'manager@gmail.com'],
            [
                'name' => 'manager',
                'password' => Hash::make('111'),
                'role' => 'manager'
            ]
        );
        $manager->assignRole('Manager');
    }
}
