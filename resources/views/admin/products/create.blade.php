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
            <h4 class="mb-sm-0 font-size-18">Thêm Sảm Phẩm</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.products.index') }}">Sản Phẩm</a>
                    </li>
                    <li class="breadcrumb-item active">Thêm Sản Phẩm</li>
                </ol>
            </div>
        </div>


        <form id="form-create-product" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
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
                                            {{-- <div class="position-relative d-inline-block">
                                                <div class="position-absolute bottom-0 end-0">
                                                    <label for="project-image-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Select Image">
                                                        <div class="avatar-xs">
                                                            <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer shadow font-size-16">
                                                                <i class='bx bxs-image-alt'></i>
                                                            </div>
                                                        </div>
                                                    </label>
                                                    <input class="form-control d-none" id="project-image-input" type="file" accept="image/png, image/gif, image/jpeg" name="images[]" onchange="previewImage(event)" multiple>
                                                </div>
                                                <div class="avatar-lg">
                                                    <div class="avatar-title bg-light">
                                                        <img src id="projectlogo-img" />
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/png, image/gif, image/jpeg">
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
                                        <input name="name" type="text" class="form-control " placeholder="Nhập tên sản phẩm..." value="{{ old('name') }}">
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
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
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
                                        <input type="number" name="price" value="{{ old('price') }}" class="w-full border border-gray-300 p-2 rounded form-control" placeholder="Nhập giá sản phẩm">
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
                                        <input type="number" name="quantity" value="{{ old('quantity') }}" class="w-full border border-gray-300 p-2 rounded form-control" placeholder="Nhập số lượng sản phẩm">
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
                                    {{ old('description') }}
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
                                    <button type="button" id="add-variant" class="bg-gray-200 rounded hover:bg-gray-300 font-semibold btn btn-primary">
                                        Thêm biến thể
                                    </button>
                                </div>
                            </div>

                            <div class="row" id="variants-wrapper">
                                <div class="variant-item grid grid-cols-3 gap-3 border p-3 rounded relative col-sm-12">
                                    <button type="button" class="remove-variant absolute top-2 right-2 border-0 text-red-600 ont-semibold text-sm btn btn-primary">
                                        Xóa
                                    </button>

                                    <!-- Màu sắc -->
                                    <div>
                                        <label class="block font-medium text-gray-700">Màu sắc :</label>
                                        <select name="variants[0][color_id]" class="w-full border border-gray-300 p-1 rounded">
                                            @foreach ($colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Dung lượng -->
                                    <div>
                                        <label class="block font-medium text-gray-700">Dung lượng :</label>
                                        <select name="variants[0][capacity_id]" class="w-full border border-gray-300 p-1 rounded">
                                            @foreach ($capacities as $capacity)
                                            <option value="{{ $capacity->id }}">{{ $capacity->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Giá biến thể -->
                                    <div>
                                        <label class="block font-medium text-gray-700">Giá biến thể :</label>
                                        <input type="number" name="variants[0][price]" class="w-full border border-gray-300 p-1 rounded">
                                    </div>

                                    <!-- Số lượng biến thể -->
                                    <div>
                                        <label class="block font-medium text-gray-700">Số lượng :</label>
                                        <input type="number" name="variants[0][stock]" class="w-full border border-gray-300 p-1 rounded">
                                    </div>
                                </div>
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



    let variantIndex = 1;

    // Thêm biến thể mới
    document.getElementById('add-variant').addEventListener('click', function() {
        const variantsWrapper = document.getElementById('variants-wrapper');
        const variantHtml = `
        <div class="variant-item grid grid-cols-3 gap-3 border p-3 rounded relative col-sm-8">
            <button type="button" class="remove-variant absolute top-2 right-2 border-0 text-red-600 ont-semibold text-sm btn btn-primary">Xóa</button>

            <div>
                <label class="block font-medium text-gray-700">Màu sắc</label>
                <select name="variants[${variantIndex}][color_id]" class="w-full border border-gray-300 p-1 rounded">
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Dung lượng</label>
                <select name="variants[${variantIndex}][capacity_id]" class="w-full border border-gray-300 p-1 rounded">
                    @foreach ($capacities as $capacity)
                        <option value="{{ $capacity->id }}">{{ $capacity->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Giá biến thể</label>
                <input type="number" name="variants[${variantIndex}][price]" class="w-full border border-gray-300 p-1 rounded">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Số lượng</label>
                <input type="number" name="variants[${variantIndex}][stock]" class="w-full border border-gray-300 p-1 rounded">
            </div>
        </div>
    `;
        variantsWrapper.insertAdjacentHTML('beforeend', variantHtml);
        variantIndex++;
    });

    // Xoá biến thể
    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-variant')) {
            const variantItem = e.target.closest('.variant-item');
            variantItem.remove();
        }
    });

</script>
@endsection
