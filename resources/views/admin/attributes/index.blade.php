@extends('admin.layouts.master')

@section('content')
    <h2>Quản lý {{ $viewData['title'] }}</h2>
    <a href="{{ route('attributes.create', $type) }}" class="btn btn-primary mb-3">Thêm mới</a>

    <table class="table">
        <thead>
            <tr>
                @foreach ($viewData['fields'] as $field => $label)
                    <th>{{ $label }}</th>
                @endforeach
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    @foreach ($viewData['fields'] as $field => $label)
                        <td>{{ $item->$field }}</td>
                    @endforeach
                    <td>
                        <a href="{{ route('attributes.edit', [$type, $item->id]) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('attributes.destroy', [$type, $item->id]) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
