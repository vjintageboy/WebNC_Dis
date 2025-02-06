@extends('layouts.app')

@section('title', $course->title)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>{{ $course->title }}</h1>
            <div class="mb-4">
                <span class="badge bg-primary">{{ $course->category }}</span>
                <span class="text-muted ms-3">
                    <i class="fas fa-user"></i> {{ $course->instructor->name }}
                </span>
            </div>

            @if($course->image)
                <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="img-fluid rounded mb-4">
            @endif

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Mô tả khóa học</h5>
                    <p class="card-text">{{ $course->description }}</p>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Nội dung khóa học</h5>
                    @if($course->lessons->count() > 0)
                        <div class="list-group">
                            @foreach($course->lessons as $lesson)
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-play-circle me-2"></i>
                                            {{ $lesson->title }}
                                        </div>
                                        @if($isEnrolled)
                                            <a href="{{ route('lessons.show', $lesson) }}" class="btn btn-sm btn-primary">
                                                Xem bài học
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">Chưa có bài học nào trong khóa học này.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card sticky-top" style="top: 20px">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">Đăng ký khóa học</h5>
                    <div class="text-center mb-4">
                        <h3 class="text-primary">{{ number_format($course->price, 0, ',', '.') }}đ</h3>
                    </div>

                    @if(!$isEnrolled)
                        @auth
                            <form action="{{ route('enroll.store', $course) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100">
                                    Đăng ký ngay
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary w-100">
                                Đăng nhập để đăng ký
                            </a>
                        @endauth
                    @else
                        <div class="alert alert-success">
                            Bạn đã đăng ký khóa học này
                        </div>
                    @endif

                    <hr>

                    <div class="course-features">
                        <h6>Khóa học bao gồm:</h6>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-video me-2"></i> {{ $course->lessons->count() }} bài học</li>
                            <li><i class="fas fa-infinity me-2"></i> Truy cập trọn đời</li>
                            <li><i class="fas fa-mobile-alt me-2"></i> Học trên mọi thiết bị</li>
                            <li><i class="fas fa-certificate me-2"></i> Chứng chỉ hoàn thành</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection