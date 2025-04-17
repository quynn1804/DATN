@extends('admin.layouts.master')
@section('title', 'New Product')

@section('style')
<style>
    #projectlogo-img {
        width: 6rem;
    }

    .h-screen {
        height: 100%;
    }

</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Sửa Sảm Phẩm</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.products.index') }}">Sản Phẩm</a>
                    </li>
                    <li class="breadcrumb-item active">
                        {{ $product->name }}
                    </li>
                </ol>
            </div>
        </div>


        <form id="form-create-product" action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <span class="text-danger">*</span>
                                            Ảnh Thu Nhỏ
                                        </label>

                                        <div class="text-center">
                                            <div class="position-relative d-inline-block">
                                                <div class="position-absolute bottom-0 end-0">
                                                    <label for="project-image-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Select Image">
                                                        <div class="avatar-xs">
                                                            <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer shadow font-size-16">
                                                                <i class='bx bxs-image-alt'></i>
                                                            </div>
                                                        </div>
                                                    </label>
                                                    <input class="form-control d-none" value="" id="project-image-input" type="file" accept="image/png, image/gif, image/jpeg" name="image" onchange="previewImage(event)">
                                                </div>
                                                <div class="avatar-lg">
                                                    <div class="avatar-title bg-light">
                                                        <img src id="projectlogo-img" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @error('image')
                                        <div class="text-danger fst-italic">*{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <span class="text-danger">*</span>
                                            Tên sản phẩm
                                        </label>
                                        <input name="name" type="text" class="form-control " placeholder="Nhập tên sản phẩm..." value="{{ old('name', $product->name) }}">
                                        @error('name')
                                        <div class="text-danger fst-italic">*{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <div class="row"> --}}
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="projectname-input" class="form-label">
                                            <span class="text-danger">*</span>
                                            Danh mục
                                        </label>
                                        <select name="category_id" class="w-full border border-gray-300 p-2 rounded form-select">
                                            <option value="">-- Chọn danh mục --</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="text-danger fst-italic">*{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="projectname-input" class="form-label">
                                            <span class="text-danger">*</span>
                                            Giá sản phẩm
                                        </label>
                                        <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full border border-gray-300 p-2 rounded form-control" placeholder="Nhập giá sản phẩm">
                                        @error('price')
                                        <div class="text-danger fst-italic">*{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="projectname-input" class="form-label">
                                            <span class="text-danger">*</span>
                                            Số lượng
                                        </label>
                                        <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" class="w-full border border-gray-300 p-2 rounded form-control" placeholder="Nhập số lượng sản phẩm">
                                        @error('quantity')
                                        <div class="text-danger fst-italic">*{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">
                                        <span class="text-danger">*</span>
                                        Mô Tả
                                    </label>
                                    <textarea id="elm1" name="description">
                                    {{ old('description', $product->description) }}
                                    </textarea>
                                    @error('description')
                                    <div class="text-danger fst-italic">*{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="text-end">
                                    <button type="submit" id="submit-create-form-product" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                </div>
                <!-- end col -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">

                            <div class="card-title mb-3 d-flex justify-content-between">
                                <div class="align-content-center">
                                    <h5>Biến thể</h5>
                                </div>
                                <div>
                                    <button type="button" onclick="addVariant()" id="add-variant" class="bg-gray-200 rounded hover:bg-gray-300 font-semibold btn btn-primary">
                                        Thêm biến thể
                                    </button>
                                </div>
                            </div>

                            <div class="row" id="variants-container">
                                @foreach($product->variants as $index => $variant)
                                <div class="border p-4 relative min-w-[300px]">
                                    <input type="hidden" name="variants[{{ $index }}][id]" value="{{ $variant->id }}">

                                    <button type="button" class="absolute top-2 right-2 text-black hover:text-red-600 font-bold text-xl" onclick="removeVariant(this)">❌</button>

                                    <div class="space-y-2">
                                        <div>
                                            <label class="block text-gray-700">Màu sắc</label>
                                            <select name="variants[{{ $index }}][color_id]" class="w-full border rounded p-2">
                                                @foreach($colors as $color)
                                                <option value="{{ $color->id }}" {{ $variant->color_id == $color->id ? 'selected' : '' }}>{{ $color->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <label class="block text-gray-700">Dung lượng</label>
                                            <select name="variants[{{ $index }}][capacity_id]" class="w-full border rounded p-2">
                                                @foreach($capacities as $capacity)
                                                <option value="{{ $capacity->id }}" {{ $variant->capacity_id == $capacity->id ? 'selected' : '' }}>{{ $capacity->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <label class="block text-gray-700">Giá biến thể</label>
                                            <input type="text" name="variants[{{ $index }}][price]" value="{{ $variant->price }}" class="w-full border rounded p-2">
                                        </div>

                                        <div>
                                            <label class="block text-gray-700">Số lượng kho</label>
                                            <input type="number" name="variants[{{ $index }}][stock]" value="{{ $variant->stock }}" class="w-full border rounded p-2">
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                </div>
                <!-- end col -->
            </div>
    </div>
    </form>

</div>
</div>
@endsection

@section('script')
<!--tinymce js-->
<script src="https://themesbrand.com/skote/layouts/assets/libs/tinymce/tinymce.min.js"></script>

<script>
    const previewImage = (event) => {
        const img = document.getElementById("projectlogo-img");
        img.src = URL.createObjectURL(event.target.files[0]);

        $("#projectlogo-img").addClass("h-screen");
    }

    $("#elm1") &&
        tinymce.init({
            selector: "textarea#elm1"
            , height: 350
            , plugins: [
                "advlist"
                , "autolink"
                , "lists"
                , "link"
                , "image"
                , "charmap"
                , "preview"
                , "anchor"
                , "searchreplace"
                , "visualblocks"
                , "code"
                , "fullscreen"
                , "insertdatetime"
                , "media"
                , "table"
                , "help"
                , "wordcount"
            , ]
            , toolbar: "undo redo | blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help"
            , content_style: 'body { font-family:"Poppins",sans-serif; font-size:16px }'
        , });



    function removeVariant(button) {
        let variantContainer = button.closest('.border.p-4');
        if (variantContainer) {
            variantContainer.remove();
        }
    }

    function addVariant() {
        let variantsContainer = document.getElementById('variants-container');
        let index = variantsContainer.children.length; // Đếm số biến thể hiện có

        let variantHtml = `
            <div class="border p-4 relative min-w-[300px]">
                <button type="button" class="absolute top-2 right-2 text-black hover:text-red-600 font-bold text-xl" onclick="removeVariant(this)">❌</button>

                <div class="space-y-2">
                    <input type="hidden" name="variants[${index}][id]" value="">

                    <div>
                        <label class="block text-gray-700">Màu sắc</label>
                        <select name="variants[${index}][color_id]" class="w-full border rounded p-2">
                            @foreach($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700">Dung lượng</label>
                        <select name="variants[${index}][capacity_id]" class="w-full border rounded p-2">
                            @foreach($capacities as $capacity)
                                <option value="{{ $capacity->id }}">{{ $capacity->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700">Giá biến thể</label>
                        <input type="text" name="variants[${index}][price]" class="w-full border rounded p-2">
                    </div>

                    <div>
                        <label class="block text-gray-700">Số lượng kho</label>
                        <input type="number" name="variants[${index}][stock]" class="w-full border rounded p-2">
                    </div>
                </div>
            </div>
        `;

        variantsContainer.insertAdjacentHTML('beforeend', variantHtml);
    }

    function removeVariant(button) {
        let variantContainer = button.closest('.border.p-4');
        if (variantContainer) {
            variantContainer.remove();
        }
    }

</script>
@endsection
