@extends('layouts.app')

@section('title', $course->title)

@section('content')
<h1>{{ $course->title }}</h1>
<p>{{ $course->description }}</p>

@if(auth()->check())
    <form action="{{ route('enroll.store', $course->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Đăng ký khóa học</button>
    </form>
@else
    <p><a href="{{ route('login') }}">Đăng nhập</a> để đăng ký khóa học.</p>
@endif

<h3 class="mt-4">Danh sách bài học</h3>
<ul class="list-group">
    @foreach($course->lessons as $lesson)
        <li class="list-group-item">{{ $lesson->title }}</li>
    @endforeach
</ul>
@endsection
