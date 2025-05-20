@php
use Carbon\Carbon;
@endphp


@extends('admin.layouts.master')

@section('title', 'Tư vấn khách hàng')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Tư vấn khách hàng</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">
                            Trang chủ
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        Tư vấn khách hàng
                    </li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->



<div class="d-lg-flex">
    <div class="chat-leftsidebar me-lg-4">
        <div class="">
            <div class="py-4 border-bottom">
                <div class="d-flex">
                    <div class="flex-shrink-0 align-self-center me-3">
                        <img src="https://laravel.com/img/logomark.min.svg" class="avatar-xs rounded-circle" alt="">
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="font-size-15 mb-1">
                            {{ auth()->user()->name }}
                        </h5>
                        <p class="text-muted mb-0"><i class="mdi mdi-circle text-success align-middle me-1"></i> Hoạt động
                        </p>
                    </div>
                </div>
            </div>

            <div class="search-box chat-search-box py-4">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Tìm kiếm người dùng...">
                    <i class="bx bx-search-alt search-icon"></i>
                </div>
            </div>

            <div class="chat-leftsidebar-nav">
                @include('admin.chats.tab.Item')
                <div class="tab-content py-4">
                    <div class="tab-pane show active" id="chat">
                        <div>
                            <h5 class="font-size-14 mb-3">Gần đây</h5>
                            <ul class="list-unstyled chat-list" data-simplebar style="max-height: 410px;">

                                @if(!empty($conversations))
                                @foreach ($conversations as $chat)
                                <li>
                                    <a href="{{ route('admin.chats.detail', $chat->id) }}">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 align-self-center me-3">
                                                <i class="mdi mdi-circle font-size-10 text-success"></i>
                                            </div>
                                            <div class="flex-shrink-0 align-self-center me-3">
                                                @if(Storage::exists($chat->user->image))
                                                <img src="{{ Storage::url($chat->user->image) }}" class="rounded-circle avatar-xs" alt="{{ $chat->user->name }}">
                                                @else
                                                <img src="https://laravel.com/img/logomark.min.svg" class="rounded-circle avatar-xs" alt="Image Default">
                                                @endif
                                            </div>

                                            <div class="flex-grow-1 overflow-hidden">
                                                <h5 class="text-truncate font-size-14 mb-1">
                                                    {{ $chat->user->name }}
                                                </h5>
                                                @if($chat->latestMessage)
                                                <p class="text-truncate mb-0">
                                                    {{ $chat->latestMessage->message ?? '' }}
                                                </p>
                                                @else
                                                <p class="text-truncate mb-0">
                                                    🎊 Hãy chào bạn mới của bạn
                                                </p>
                                                @endif
                                            </div>

                                            @if($chat->latestMessage)
                                            <div class="font-size-11">
                                                {{ $chat->latestMessage->created_at->format('H:i') ?? '' }}
                                            </div>
                                            @endif

                                        </div>
                                    </a>
                                </li>
                                @endforeach

                                @else

                                <h1>Chưa người dùng nào</h1>

                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="tab-pane" id="groups">
                        <h5 class="font-size-14 mb-3">Groups</h5>
                        <ul class="list-unstyled chat-list" data-simplebar style="max-height: 410px;">
                            <li>
                                <a href="javascript: void(0);">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                    G
                                                </span>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1">
                                            <h5 class="font-size-14 mb-0">General</h5>
                                        </div>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a href="javascript: void(0);">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                    R
                                                </span>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1">
                                            <h5 class="font-size-14 mb-0">Reporting</h5>
                                        </div>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a href="javascript: void(0);">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                    M
                                                </span>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1">
                                            <h5 class="font-size-14 mb-0">Meeting</h5>
                                        </div>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a href="javascript: void(0);">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                    A
                                                </span>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1">
                                            <h5 class="font-size-14 mb-0">Project A</h5>
                                        </div>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a href="javascript: void(0);">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                    B
                                                </span>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1">
                                            <h5 class="font-size-14 mb-0">Project B</h5>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-pane" id="contacts">
                        <h5 class="font-size-14 mb-3">Contacts</h5>

                        <div data-simplebar style="max-height: 410px;">
                            <div>
                                <div class="avatar-xs mb-3">
                                    <span class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                        A
                                    </span>
                                </div>

                                <ul class="list-unstyled chat-list">
                                    <li>
                                        <a href="javascript: void(0);">
                                            <h5 class="font-size-14 mb-0">Adam Miller</h5>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="javascript: void(0);">
                                            <h5 class="font-size-14 mb-0">Alfonso Fisher</h5>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="mt-4">
                                <div class="avatar-xs mb-3">
                                    <span class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                        B
                                    </span>
                                </div>

                                <ul class="list-unstyled chat-list">
                                    <li>
                                        <a href="javascript: void(0);">
                                            <h5 class="font-size-14 mb-0">Bonnie Harney</h5>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="mt-4">
                                <div class="avatar-xs mb-3">
                                    <span class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                        C
                                    </span>
                                </div>

                                <ul class="list-unstyled chat-list">
                                    <li>
                                        <a href="javascript: void(0);">
                                            <h5 class="font-size-14 mb-0">Charles Brown</h5>
                                        </a>
                                        <a href="javascript: void(0);">
                                            <h5 class="font-size-14 mb-0">Carmella Jones</h5>
                                        </a>
                                        <a href="javascript: void(0);">
                                            <h5 class="font-size-14 mb-0">Carrie Williams</h5>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="mt-4">
                                <div class="avatar-xs mb-3">
                                    <span class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                        D
                                    </span>
                                </div>

                                <ul class="list-unstyled chat-list">
                                    <li>
                                        <a href="javascript: void(0);">
                                            <h5 class="font-size-14 mb-0">Dolores Minter</h5>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="w-100 user-chat">
        <div class="card">
            <div class="p-4 border-bottom d-flex justify-content-center align-items-center" style="min-height: 100vh">
                <h1 class="text-danger">Bạn chưa có tin nhắn nào</h1>
            </div>
        </div>
    </div>

</div>


@vite('resources/js/chat.js')
@endsection
