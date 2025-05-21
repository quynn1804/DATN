@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h1>Danh sách phiếu nhập</h1>

    <a href="{{ route('admin.stock-imports.create') }}" class="btn btn-primary mb-3">+ Tạo phiếu nhập</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã phiếu</th>
                <th>Nhà cung cấp</th>
                <th>Ngày nhập</th>
                <th>Người tạo</th>
                <th>Ghi chú</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($imports as $import)
            <tr>
                <td>{{ $import->code }}</td>
                <td>{{ $import->supplier_name ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($import->import_date)->format('d/m/Y') }}</td>
                <td>{{ $import->user->name ?? '-' }}</td>
                <td>{{ $import->note }}</td>
                <td>
                    <a href="{{ route('admin.stock-imports.show', $import->id) }}" class="btn btn-sm btn-info">Xem</a>

                    <form action="{{ route('admin.stock-imports.destroy', $import->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn ẩn phiếu nhập này không?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-secondary">Ẩn</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Không có phiếu nhập nào.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $imports->links() }}
</div>
@endsection
