@extends(' user.layouts.main')
@section('content')
<div>
    <!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>

    <label for="color">Chọn màu:</label>
    <select id="color">
        @foreach ($product->variations->pluck('color')->unique() as $color)
            <option value="{{ $color->id }}">{{ $color->name }}</option>
        @endforeach
    </select>

    <label for="capacity">Chọn dung lượng:</label>
    <select id="capacity">
        @foreach ($product->variations->pluck('capacity')->unique() as $capacity)
            <option value="{{ $capacity->id }}">{{ $capacity->value }}</option>
        @endforeach
    </select>

    <h3>Giá: <span id="price">0 VND</span></h3>
    <p>Kho: <span id="stock">0</span></p>

    <script>
        function updatePrice() {
            let color_id = $("#color").val();
            let capacity_id = $("#capacity").val();
            let product_id = {{ $product->id }};

            $.post("/get-price", {
                _token: "{{ csrf_token() }}",
                product_id: product_id,
                color_id: color_id,
                capacity_id: capacity_id
            }, function(response) {
                $("#price").text(response.price);
                $("#stock").text(response.stock);
            });
        }

        $("#color, #capacity").change(updatePrice);
        $(document).ready(updatePrice);
    </script>
</body>
</html>

</div>

@endsection
