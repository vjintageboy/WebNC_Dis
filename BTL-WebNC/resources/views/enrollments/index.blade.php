@extends('layouts.app')

@section('title', 'Khóa học của tôi')

@section('content')
<div class="container">
    <h1 class="mb-4">Khóa học của tôi</h1>

    @if($enrollments->isEmpty())
        <div class="alert alert-info">
            Bạn chưa đăng ký khóa học nào.
            <a href="{{ route('courses.index') }}" class="alert-link">Khám phá các khóa học</a>
        </div>
    @else
        <div class="row g-4">
            @foreach($enrollments as $enrollment)
                <div class="col-md-4">
                    <div class="card h-100">
                        @if($enrollment->course->image)
                            <img src="{{ Storage::url($enrollment->course->image) }}" 
                                class="card-img-top" 
                                alt="{{ $enrollment->course->title }}"
                                style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $enrollment->course->title }}</h5>
                            <p class="card-text">{{ Str::limit($enrollment->course->description, 100) }}</p>
                            
                            <div class="progress mb-3">
                                <div class="progress-bar" role="progressbar" style="width: 25%">
                                    25% hoàn thành
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <div class="d-grid gap-2">
                                <a href="{{ route('courses.show', $enrollment->course) }}" 
                                    class="btn btn-primary">
                                    Tiếp tục học
                                </a>
                                <form action="{{ route('enrollments.destroy', $enrollment) }}" 
                                    method="POST" 
                                    onsubmit="return confirm('Bạn có chắc muốn hủy đăng ký khóa học này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger w-100">
                                        Hủy đăng ký
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection