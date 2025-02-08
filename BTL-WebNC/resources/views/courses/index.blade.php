@extends('layouts.app')

@section('title', 'Danh sách khóa học')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col">
            <h1>Khóa học</h1>
        </div>
        @if(auth()->check() && (auth()->user()->hasRole('instructor') || auth()->user()->hasRole('admin')))
        <div class="col text-end">
            <a href="{{ route('courses.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tạo khóa học mới
            </a>
        </div>
        @endif
    </div>

    <div class="row g-4">
        @forelse($courses as $course)
            <div class="col-md-4">
                <div class="card h-100">
                    @if($course->image)
                        <img src="{{ Storage::url($course->image) }}" 
                             class="card-img-top" 
                             alt="{{ $course->title }}" 
                             style="height: 200px; object-fit: cover;">
                    @else
                        <img src="/images/default-course.jpg" 
                             class="card-img-top" 
                             alt="Default course image" 
                             style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->title }}</h5>
                        <p class="card-text">{{ Str::limit($course->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">
                                <i class="fas fa-user"></i> {{ $course->instructor->name }}
                            </span>
                            <span class="text-primary fw-bold">
                                {{ number_format($course->price, 0, ',', '.') }}đ
                            </span>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <a href="{{ route('courses.show', $course) }}" 
                           class="btn btn-outline-primary w-100">
                            Xem chi tiết
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    Chưa có khóa học nào được tạo.
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $courses->links() }}
    </div>
</div>
@endsection