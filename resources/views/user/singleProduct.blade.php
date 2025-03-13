@extends('user.layouts.main')
@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Chi Tiết Sản Phẩm</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Trang Chủ</a></li>
                    <li class="active">Chi Tiết Sản Phẩm</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="sp-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="sp-img_area">
                        <div class="sp-img_slider">
                            <div class="single-slide">
                                <img src="{{ asset('assets/images/' . $product->image) }}" alt="{{ $product->name }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="sp-content">
                        <h3 class="sp-title">{{ $product->name }}</h3>
                        <p class="sp-price">
                            @if($product->variants->count() > 0)
                                Giá từ: {{ number_format($product->variants->min('price'), 0, ',', '.') }} đ
                            @else
                                {{ number_format($product->price, 0, ',', '.') }} đ
                            @endif
                        </p>
                        <p class="sp-description">{{ $product->description }}</p>

                        {{-- Form thêm vào giỏ hàng --}}
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            {{-- Chọn màu sắc --}}
                            @if($product->variants->count() > 0)
                                <div class="form-group">
                                    <label for="color">Chọn màu sắc:</label>
                                    <select name="color_id" id="color" class="form-control">
                                        @foreach($product->variants->unique('color_id') as $variant)
                                            <option value="{{ $variant->color_id }}">
                                                {{ optional($variant->color)->name ?? 'Không có màu' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            {{-- Chọn dung lượng --}}
                            @if($product->variants->count() > 0)
                                <div class="form-group">
                                    <label for="capacity">Chọn dung lượng:</label>
                                    <select name="capacity_id" id="capacity" class="form-control">
                                        @foreach($product->variants->unique('capacity_id') as $variant)
                                            <option value="{{ $variant->capacity_id }}">
                                                {{ optional($variant->capacity)->name ?? 'Không có dung lượng' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            {{-- Nhập số lượng --}}
                            <div class="form-group mt-3">
                                <label for="quantity">Số lượng:</label>
                                <input type="number" name="quantity" id="quantity" value="1" min="1" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Thêm vào giỏ hàng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Bootstrap 5 --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
    /* CSS đẹp hơn cho bình luận */
    .comment-box {
        background: #f8f9fa;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 10px;
    }
    .comment-box strong {
        color: #007bff;
    }
    .star-rating input {
        display: none;
    }
    .star-rating label {
        font-size: 24px;
        color: #ccc;
        cursor: pointer;
    }
    .star-rating input:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #fdd835;
    }
</style>

<div id="reviews" class="tab-pane" role="tabpanel">
    <h2 class="text-lg fw-bold text-dark mb-4">Bình luận về sản phẩm: {{ $product->name }}</h2>

    {{-- Thông báo nếu bình luận thành công --}}
    @if(session('success'))
        <div class="alert alert-success text-green-600">{{ session('success') }}</div>
    @endif

    {{-- Form bình luận --}}
    @auth
    <div class="p-3 border rounded bg-light">
        <form action="{{ route('comments.store', $product->id) }}" method="POST">
            @csrf
            <label class="fw-bold text-dark">Đánh giá:</label>
            <div class="star-rating d-flex">
                <input type="radio" name="rating" id="star5" value="5"><label for="star5">★</label>
                <input type="radio" name="rating" id="star4" value="4"><label for="star4">★</label>
                <input type="radio" name="rating" id="star3" value="3"><label for="star3">★</label>
                <input type="radio" name="rating" id="star2" value="2"><label for="star2">★</label>
                <input type="radio" name="rating" id="star1" value="1"><label for="star1">★</label>
            </div>

            <label class="fw-bold text-dark mt-2">Bình luận:</label>
            <textarea name="content" required class="form-control" placeholder="Nhập bình luận của bạn..."></textarea>

            <button type="submit" class="mt-3 btn btn-primary">Gửi</button>
        </form>
    </div>
    @else
        <p class="text-muted">Vui lòng <a href="{{ route('login') }}" class="text-primary">đăng nhập</a> để bình luận.</p>
    @endauth

    {{-- Danh sách bình luận --}}
    <h3 class="fw-bold text-dark mt-4">Danh sách bình luận:</h3>

    <div class="mt-3">
        @foreach($product->comments as $comment)
            <div class="comment-box">
                <p><strong>{{ $comment->user->name }}</strong>
                    <span class="text-warning">
                        {!! str_repeat('★', $comment->rating) !!}
                        {!! str_repeat('☆', 5 - $comment->rating) !!}
                    </span>
                </p>
                <p>{{ $comment->content }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection
