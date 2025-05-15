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
                        <p class="text-muted mb-0">
                            <i class="mdi mdi-circle text-success align-middle me-1"></i>
                            Hoạt động
                        </p>
                    </div>
                </div>
            </div>

            <div class="search-box chat-search-box py-4">
                <div class="position-relative">
                    <form action="" method="GET">
                        <input hidden type="text" class="form-control" placeholder="Tìm kiếm người dùng..." name="user_id" value="{{ $userId }}">
                        <input type="text" class="form-control" placeholder="Tìm kiếm người dùng..." name="search">
                        <i class="bx bx-search-alt search-icon"></i>
                    </form>
                </div>
            </div>

            <div class="chat-leftsidebar-nav">
                @include('admin.chats.tab.Item')
                <div class="tab-content py-4">
                    <div class="tab-pane show active" id="chat">
                        <div>
                            <h5 class="font-size-14 mb-3">Gần đây</h5>
                            <ul class="list-unstyled chat-list" data-simplebar style="max-height: 410px;">

                                @foreach ($conversations as $chat)
                                <li class="{{ $chat->id == $userId ? 'active' : '' }}">
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
                                                <p class="text-truncate mb-0">
                                                    {{ $chat->latestMessage->message ?? '🎊 Hãy chào bạn mới của bạn' }}
                                                </p>
                                            </div>

                                            <div class="font-size-11">
                                                {{-- {{ $chat->latestMessage->created_at->format('H:i') }} --}}
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                @endforeach

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
            <div class="p-4 border-bottom ">
                <div class="row">
                    <div class="col-md-4 col-9">
                        <h5 class="font-size-15 mb-1">
                            {{ $conversation->user->name }}
                        </h5>
                        <p class="text-muted mb-0"><i class="mdi mdi-circle text-success align-middle me-1"></i>
                            Hoạt động
                        </p>
                    </div>
                    <div class="col-md-8 col-3">
                        {{-- <ul class="list-inline user-chat-nav text-end mb-0">
                            <li class="list-inline-item d-none d-sm-inline-block">
                                <div class="dropdown">
                                    <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-search-alt-2"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-md">
                                        <form class="p-3">
                                            <div class="form-group m-0">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">

                                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            <li class="list-inline-item  d-none d-sm-inline-block">
                                <div class="dropdown">
                                    <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-cog"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="chat.html#">View Profile</a>
                                        <a class="dropdown-item" href="chat.html#">Clear chat</a>
                                        <a class="dropdown-item" href="chat.html#">Muted</a>
                                        <a class="dropdown-item" href="chat.html#">Delete</a>
                                    </div>
                                </div>
                            </li>

                            <li class="list-inline-item">
                                <div class="dropdown">
                                    <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-horizontal-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="chat.html#">Action</a>
                                        <a class="dropdown-item" href="chat.html#">Another
                                            action</a>
                                        <a class="dropdown-item" href="chat.html#">Something
                                            else</a>
                                    </div>
                                </div>
                            </li>

                        </ul> --}}
                    </div>
                </div>
            </div>


            <div>
                <div class="chat-conversation p-3">
                    <ul id="chat-box-ul-{{ $userId }}" class="list-unstyled mb-0" data-simplebar style="max-height: 486px;">
                        @foreach ($messages as $message)
                        <li class="{{ $message->sender_type == 'Admin' ? 'right' : '' }}">
                            <div class="conversation-list">
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="chat.html#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="chat.html#">Copy</a>
                                        <a class="dropdown-item" href="chat.html#">Save</a>
                                        <a class="dropdown-item" href="chat.html#">Forward</a>
                                        <a class="dropdown-item" href="chat.html#">Delete</a>
                                    </div>
                                </div>
                                <div class="ctext-wrap">
                                    <div class="conversation-name">{{ $message->sender->name }}</div>
                                    <p>
                                        {{ $message->message }}
                                    </p>
                                    <p class="chat-time mb-0">
                                        <i class="bx bx-time-five align-middle me-1"></i>
                                        {{ $chat->created_at->format('H:i') }}
                                    </p>
                                </div>

                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="p-3 chat-input-section">

                    <form id="chat-box-{{ $userId }}" action="{{ route('admin.chats.write', $userId) }}" method="POST" class="row">
                        @csrf
                        <div class="col">
                            <div class="position-relative">
                                <input type="text" class="form-control chat-input" placeholder="Nhập tin nhắn của bạn..." name="message" id="chat-box-{{ $userId }}-message">
                                <div class="chat-input-links" id="tooltip-container">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item"><a href="javascript: void(0);" title="Emoji"><i class="mdi mdi-emoticon-happy-outline"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="javascript: void(0);" title="Images"><i class="mdi mdi-file-image-outline"></i></a></li>
                                        <li class="list-inline-item"><a href="javascript: void(0);" title="Add Files"><i class="mdi mdi-file-document-outline"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light" onclick="handleApply('{{ $userId }}')">
                                <span class="d-none d-sm-inline-block me-2">Gửi</span>
                                <i class="mdi mdi-send"></i>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        {{-- @include('admin.layouts.components.chats.main', ['user' => $user, 'message' => $message]) --}}
    </div>

</div>

@php
$senderType = Auth::user()->role_id == 1 ? 'Admin' : 'User';
$userCurrent = Auth::user();
@endphp

<script>
    const APP_URL = '{{ route("admin.chats.write", $userId) }}';
    const channelId = '{{ $userId }}';
    const senderType = @json($senderType);
    const userCurrent = @json($userCurrent);

</script>

@vite(['resources/js/chat.js'])
{{-- @vite('resources/js/chat.js') --}}
@endsection
