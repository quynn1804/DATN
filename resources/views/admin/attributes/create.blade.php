@extends('admin.layouts.master')

@section('content')
    <h2>Thêm {{ $viewData['title'] }}</h2>
    <form action="{{ route('attributes.store', $type) }}" method="POST">
        @csrf
        @foreach ($viewData['fields'] as $field => $label)
            <div class="mb-3">
                <label class="form-label">{{ $label }}</label>
                <input type="text" name="{{ $field }}" class="form-control" required>
            </div>
        @endforeach
        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('attributes.index', $type) }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection
