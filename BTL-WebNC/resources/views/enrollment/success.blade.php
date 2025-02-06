@extends('layouts.app')

@section('title', 'Đăng ký thành công')

@section('content')
<h1>🎉 Bạn đã đăng ký khóa học thành công!</h1>
<a href="{{ route('courses.index') }}" class="btn btn-primary">Quay lại danh sách khóa học</a>
@endsection
