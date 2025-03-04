@extends('user.layouts.main')
@section('content')
    <h2>Kết quả tìm kiếm cho: "{{ $keyword }}"</h2>

    @if ($products->isEmpty())
        <p>Không tìm thấy sản phẩm nào.</p>
    @else

            @foreach ($products as $product)
            <div class="product-item" style="display: flex; align-items: center; gap: 15px;">
                <div class="product-img">
                    <a href="{{ route('singleProduct', ['id' => $product->id]) }}">
                        <img class="primary-img"
                            src="{{ asset('assets/images/' . $product->image) }}" 
                            height="100" width="100" 
                            alt="{{ $product->name }}"
                            style="object-fit: cover; border-radius: 5px;">
                    </a>
                </div>
                <div class="product-content">
                    <h3 class="product-name">
                        <a href="{{ route('singleProduct', ['id' => $product->id]) }}">
                            {{$product->name}}
                        </a>
                    </h3>
                    <div class="price-box">
                        <span class="new-price">{{$product->price}} VND</span>
                    </div>
                </div>
            </div>
            
        @endforeach

    @endif
@endsection
