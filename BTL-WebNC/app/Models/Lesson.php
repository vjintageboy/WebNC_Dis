<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Lesson extends Model
{
    use HasFactory;

    // Các trường được phép gán giá trị hàng loạt
    protected $fillable = [
        'title',      // Tiêu đề bài học
        'content',    // Nội dung bài học
        'video_url',  // URL video của bài học
        'course_id',  // ID của khóa học mà bài học thuộc về
        'order'       // Thứ tự hiển thị của bài học trong khóa học
    ];

    // Quan hệ N - 1: Một bài học thuộc về một khóa học
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
