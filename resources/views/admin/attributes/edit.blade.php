@extends('admin.layouts.master')

@section('content')
    <h2>Chỉnh sửa {{ $viewData['title'] }}</h2>
    <form action="{{ route('attributes.update', [$type, $item->id]) }}" method="POST">
        @csrf @method('PUT')
        @foreach ($viewData['fields'] as $field => $label)
            <div class="mb-3">
                <label class="form-label">{{ $label }}</label>
                <input type="text" name="{{ $field }}" value="{{ $item->$field }}" class="form-control" required>
            </div>
        @endforeach
        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('attributes.index', $type) }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection
