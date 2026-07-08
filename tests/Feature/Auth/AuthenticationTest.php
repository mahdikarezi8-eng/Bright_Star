<?php

namespace Tests\Feature\Auth;

use App\Models\Classe;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_teacher_dashboard_shows_subject_class_and_student_information(): void
    {
        $user = User::factory()->create([
            'role' => 'teacher',
        ]);

        $teacher = Teacher::create([
            'user_id' => $user->id,
            'first_name' => 'Ali',
            'last_name' => 'Karimi',
            'father_name' => 'Reza',
            'gender' => 1,
            'birth_year' => 1990,
            'image' => 'teacher.jpg',
            'nic' => '1234567890',
            'phone' => '09120000000',
            'email' => 'teacher@example.com',
            'curent_address' => 'Test address',
            'education_degree' => 'Master',
            'education_university' => 'Test University',
            'education_year' => 2020,
            'talent_score' => 90,
            'gross_salary' => 5000,
            'food' => 500,
            'reg_date' => now()->toDateString(),
        ]);

        $subject = Subject::create([
            'subject_name' => 'Mathematics',
        ]);

        $class = Classe::create([
            'class_name' => 'Grade 10',
            'fees' => 1000,
            'capacity' => 30,
        ]);

        $subject->classes()->attach($class->id);
        $teacher->subjects()->attach($subject->id);

        Student::create([
            'first_name' => 'Sara',
            'last_name' => 'Ahmadi',
            'father_name' => 'Mohammad',
            'gender' => 0,
            'birth_year' => 2011,
            'image' => 'student.jpg',
            'nic' => '0987654321',
            'phone' => '09121111111',
            'email' => 'student@example.com',
            'curent_address' => 'Student address',
            'class_id' => $class->id,
        ]);

        $response = $this->actingAs($user)->get('/teacher/dashboard');

        $response->assertOk();
        $response->assertSeeText('Mathematics');
        $response->assertSeeText('Grade 10');
        $response->assertSeeText('Sara');
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
