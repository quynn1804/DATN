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
@endsection
