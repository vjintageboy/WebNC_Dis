<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrollment extends Model
{
    use HasFactory;

    // Các trường được phép gán giá trị hàng loạt
    protected $fillable = [
        'user_id',      // ID của người dùng đăng ký khóa học
        'course_id',    // ID của khóa học được đăng ký
        'status',       // Trạng thái đăng ký (ví dụ: pending, approved, completed)
        'completed_at'  // Thời gian hoàn thành khóa học (nếu có)
    ];

    // Quan hệ N - 1: Một đăng ký thuộc về một người dùng
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ N - 1: Một đăng ký thuộc về một khóa học
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
