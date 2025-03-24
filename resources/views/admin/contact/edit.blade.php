@extends('admin.layouts.index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3 mb-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Cập nhật trạng thái liên hệ</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.contacts.update', $contact->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label>Họ Tên:</label>
                                <input type="text" class="form-control" value="{{ $contact->name }}" disabled>
                            </div>

                            <div class="form-group mb-3">
                                <label>Email hoặc Số điện thoại:</label>
                                <input type="text" class="form-control" value="{{ $contact->email }}" disabled>
                            </div>

                            <div class="form-group mb-3">
                                <label>Chủ Đề:</label>
                                <input type="text" class="form-control" value="{{ $contact->subject }}" disabled>
                            </div>

                            <div class="form-group mb-3">
                                <label>Tin Nhắn:</label>
                                <textarea class="form-control" rows="5" disabled>{{ $contact->message }}</textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label>Trạng Thái:</label>
                                <select name="status" class="form-control">
                                    <option value="chưa trả lời" {{ $contact->status == 'chưa trả lời' ? 'selected' : '' }}>
                                        Chưa trả lời</option>
                                    <option value="đã trả lời" {{ $contact->status == 'đã trả lời' ? 'selected' : '' }}>Đã
                                        trả lời</option>
                                </select>
                            </div>

                            <div class="form-group mb-3 text-end">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">Quay lại</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
