<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Tạo roles
        Role::create(['name' => 'student']);
        Role::create(['name' => 'instructor']);

        // Tạo tài khoản Student
        $student = User::firstOrCreate(
            ['email' => 'student@example.com'],
            [
                'name' => 'Student User',
                'password' => Hash::make('password'),
            ]
        );
        // Gán role student
        $student->assignRole('student');

        // Tạo tài khoản Instructor
        $instructor = User::firstOrCreate(
            ['email' => 'instructor@example.com'],
            [
                'name' => 'Instructor User',
                'password' => Hash::make('password'),
            ]
        );
        // Gán role instructor
        $instructor->assignRole('instructor');

        // Tạo một số khóa học mẫu
        Course::create([
            'title' => 'Khóa học Laravel cơ bản',
            'description' => 'Học Laravel từ cơ bản đến nâng cao',
            'price' => 999000,
            'instructor_id' => $instructor->id,
            'status' => 'active'
        ]);

        Course::create([
            'title' => 'Lập trình PHP',
            'description' => 'Khóa học PHP toàn diện',
            'price' => 799000,
            'instructor_id' => $instructor->id,
            'status' => 'active'
        ]);
    }
}