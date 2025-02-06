@extends('layouts.app')

@section('title', 'Danh sách khóa học')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">Danh sách khóa học</h1>
    
    {{-- Kiểm tra nếu có khóa học --}}
    @if(isset($courses) && $courses->count() > 0)
        <div class="row">
            @foreach($courses as $course)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        {{-- Nếu khóa học có hình ảnh, bạn có thể hiển thị hình ảnh đó --}}
                        @if(isset($course->image))
                            <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top" alt="{{ $course->title }}">
                        @else
                            <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="{{ $course->title }}">
                        @endif
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <p class="card-text">
                                {{ \Illuminate\Support\Str::limit($course->description, 100, '...') }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('courses.show', $course->id) }}" class="btn btn-primary btn-sm">
                                    Xem chi tiết
                                </a>
                                {{-- Hiển thị thông tin ngày tạo (hoặc thông tin khác nếu cần) --}}
                                <small class="text-muted">
                                    {{ $course->created_at->format('d/m/Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Hiển thị phân trang nếu có --}}
        <div class="d-flex justify-content-center">
            {{ $courses->links() }}
        </div>
    @else
        <p class="text-center">Hiện chưa có khóa học nào được cập nhật.</p>
    @endif
</div>
@endsection

