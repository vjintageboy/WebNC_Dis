<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Tạo tài khoản admin nếu chưa tồn tại
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'     => 'Admin User',
                'password' => Hash::make('password'),
                'role'     => 'admin'
            ]
        );

        // Tạo tài khoản giảng viên nếu chưa tồn tại
        $instructor = User::firstOrCreate(
            ['email' => 'instructor@example.com'],
            [
                'name'     => 'Instructor User',
                'password' => Hash::make('password'),
                'role'     => 'instructor'
            ]
        );

        // Tạo một số khóa học mẫu
        Course::create([
            'title'         => 'Khóa học Laravel cơ bản',
            'description'   => 'Học Laravel từ cơ bản đến nâng cao',
            'price'         => 999000,
            'instructor_id' => $instructor->id,
            'status'        => 'active'
        ]);

        Course::create([
            'title'         => 'Lập trình PHP',
            'description'   => 'Khóa học PHP toàn diện',
            'price'         => 799000,
            'instructor_id' => $instructor->id,
            'status'        => 'active'
        ]);
    }
}
