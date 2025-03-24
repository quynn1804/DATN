@extends('admin.layouts.index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mb-3 mb-lg-5">
            <div class="card">
                <div class="card-header">
                    <h5>Chi tiết liên hệ</h5>
                </div>
                <div class="card-body">
                    <p><strong>Người gửi:</strong> {{ $contact->name }}</p>
                    <p><strong>Email:</strong> {{ $contact->email }}</p>
                    <p><strong>Chủ đề:</strong> {{ $contact->subject }}</p>
                    <p><strong>Tin nhắn:</strong></p>
                    <p>{{ $contact->message }}</p>
                    <p><strong>Ngày gửi:</strong> {{ $contact->created_at->format('d/m/Y H:i') }}</p>
                    
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-primary">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
