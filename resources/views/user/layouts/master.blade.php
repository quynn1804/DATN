<!DOCTYPE html>
<html lang="en">
{{-- lang="{{ str_replace('_', '-', app()->getLocale()) }}" --}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="keywords" content="LuxChill Ecommerce" />
    <meta name="description" content="Website Ecommerce by LuxChill">
    <meta name="author" content="LuxChill">

    <script src="https://kit.fontawesome.com/12ffb45aae.js" crossorigin="anonymous"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        window.user = @json(Auth::user());

    </script>

    {{-- css all --}}
    @include('user.layouts.partials.css')
    {{-- css local --}}
    @yield('style')

    <style>
        #scrollTopElement {
            height: 40px;
            position: fixed;
            right: 15px;
            width: 40px;
            z-index: 9999;
            bottom: 0;
            color: #fff;
            background-color: #43494e;
            font-size: 16px;
            text-align: center;
            line-height: 1;
            padding: 11px 0;
            visibility: hidden;
            opacity: 0;
            border-radius: 0 0 0 0;
            transition: all 0.3s, margin-right 0s;
            transform: translateY(40px);
        }


        #scrollTopElement.fixed {
            transform: translateY(0);
            opacity: 1;
            visibility: visible;
            color: #FFF;
            width: 49px;
            height: 48px;
            right: 10px;
            text-align: center;
            text-decoration: none;
            z-index: 996;
            transition: background 0.3s ease-out;
            background: rgba(64, 64, 64, 0.75);
        }


        #scrollTopElement.fixed:hover {
            background: #656161;
            color: white;
            cursor: pointer;
        }

        #scrollTopElement>i {
            position: absolute;
            height: 24px;
            line-height: 24px;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
        }

    </style>

    <title>@yield('title')</title>
</head>

<body>

    <div class="page-wrapper">
        <div class="top-notice bg-primary text-white d-none" id="notice-voucher">
            @include('user.layouts.components.top-notice')
        </div>

        <header class="header">
            <div class="header-top">
                @include('user.layouts.partials.header-top')
            </div>

            <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">
                @include('user.layouts.partials.header-middle')
            </div>

            <div class="header-bottom sticky-header d-none d-lg-block" data-sticky-options="{'mobile': false}">
                @include('user.layouts.partials.header-bottom')
            </div>
        </header>

        <main class="main">
            @yield('content')
        </main>

        <footer class="footer bg-dark">
            @include('user.layouts.partials.footer')
        </footer>
    </div>

    {{-- loading effect --}}
    @include('user.layouts.components.loading-overlay')

    <div class="mobile-menu-overlay"></div>
    <!-- End .mobil-menu-overlay -->

    @include('user.layouts.components.mobile-menu-container')
    <!-- End .mobile-menu-container -->

    @include('user.layouts.components.mobile-sticky-navbar')

    {{-- alert--}}

    @php

    $showNewLetter = false;

    @endphp

    @if($showNewLetter)
    @include('user.layouts.components.newsletter-popup')
    @endif

    @if(Auth::check())
    <button id="scrollTopElement" type="button" class="btn btn-primary">
        <i class="fa-solid fa-headset"></i>
    </button>

    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-center" id="myModalLabel">
                        Tin nhắn
                    </h1>
                    <button id="modal-button-close" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <ul class="box-chat-client-ul"></ul>

                    <form id="chat-box" action="{{ route('admin.chats.write', 1) }}" method="POST" class="row">
                        @csrf
                        <div class="col">
                            <div class="position-relative">
                                <input type="text" class="form-control chat-input" placeholder="Nhập tin nhắn của bạn..." name="message" id="chat-client-message">
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
                            <button type="button" class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light" onclick="handleApply('1')">
                                <span class="d-none d-sm-inline-block me-2">Gửi</span>
                                <i class="mdi mdi-send"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @else
    <a id="scroll-top">
        <i class="fa-solid fa-arrow-up"></i>
    </a>
    @endif


    {{-- script global --}}
    @include('user.layouts.partials.global')
    @include('user.layouts.partials.script')
    {{-- script local --}}
    @yield('script')

    @if(Auth::check())
    @php
    $senderType = Auth::user()->role_id == 1 ? 'Admin' : 'User';
    $userCurrent = Auth::user();
    @endphp

    <script>
        const scrollTopElement = document.querySelector('#scrollTopElement');

        function scrollBtnAppear() {
            if (window.scrollY >= 400) {
                scrollTopElement.classList.add('fixed');
            } else {
                scrollTopElement.classList.remove('fixed');
            }
        }

        const handleOpenChatBox = () => {
            console.log(111);
        }

        window.addEventListener('scroll', scrollBtnAppear);

        scrollBtnAppear();

        $(document).ready(function() {
            let myModal = new bootstrap.Modal(document.getElementById('myModal'));
            $('#scrollTopElement').click(function() {
                myModal.show();
            })

            $('#modal-button-close').click(function() {
                myModal.hide();
            });
        });

        const userCurrent = @json($userCurrent);

    </script>

    @vite(['resources/js/box-chat.js'])
    @vite(['resources/js/voucher-notification.js'])
    @endif
</body>

</html>
