@extends('user.layouts.master')
@section('title', 'Pina Ecommerce')

@section('content')
    <!-- home-slider -->
    @include('user.layouts.components.banner-home')
    <!-- info-boxes-slider -->
    <div class="container">
        @include('user.layouts.components.info-boxes-slider')

        @include('user.layouts.components.categories-home-slider')
    </div>

    <section class="products-section pt-0">
        @include('user.layouts.components.products-slider', [
            'title' => 'Sản phẩm nổi bật',
            'products' => $products,
        ])
    </section>

    <section class="products-section pt-0">
        @include('user.layouts.components.products-slider', [
            'title' => 'Sản phẩm mới',
            'products' => $products,
        ])

        <div class="container">
            <div class="banner banner-big-sale appear-animate" data-animation-delay="200" data-animation-name="fadeInUpShorter"
                style="background: #2A95CB center/cover url('/assets/theme/client/images/demoes/demo4/banners/banner-4.jpg')">
                <div class="banner-content row align-items-center mx-0">
                    <div class="col-md-9 col-sm-8">
                        <h2 class="text-white text-uppercase text-center text-sm-left ls-n-20 mb-md-0 px-4">
                            <b class="d-inline-block mr-3 mb-1 mb-md-0">Sale sập sàn</b> Giảm Giá Đến 70%
                            <small class="text-transform-none align-middle">Chỉ Áp Dụng Khi Mua Online</small>
                        </h2>
                    </div>
                    <div class="col-md-3 col-sm-4 text-center text-sm-right">
                        <a class="btn btn-light btn-white btn-lg" href="category.html">Xem Ngay!!</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="products-section pt-0">
        @include('user.layouts.components.products-slider', [
            'title' => 'Tất cả sản phẩm',
            'products' => $products,
        ])
    </section>

    <section class="feature-boxes-container">
        <div class="container appear-animate" data-animation-name="fadeInUpShorter">
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-box px-sm-5 feature-box-simple text-center">
                        <div class="feature-box-icon">
                            <i class="icon-earphones-alt"></i>
                        </div>

                        <div class="feature-box-content p-0">
                            <h3>Hỗ trợ khách hàng</h3>
                            <h5>Bảo đảm chất lượng</h5>

                            <p> Sản phẩm chính hãng 100%: Tất cả điện thoại được cung cấp đều có nguồn gốc rõ ràng, nguyên
                                seal, đầy đủ phụ kiện và bảo hành chính hãng từ nhà sản xuất.
                                Bảo hành và đổi trả dễ dàng: Cam kết 1 đổi 1 trong vòng 7 ngày nếu sản phẩm lỗi do nhà sản
                                xuất. Bảo hành theo đúng chính sách của hãng.
                            </p>
                        </div>
                        <!-- End .feature-box-content -->
                    </div>
                    <!-- End .feature-box -->
                </div>
                <!-- End .col-md-4 -->

                <div class="col-md-4">
                    <div class="feature-box px-sm-5 feature-box-simple text-center">
                        <div class="feature-box-icon">
                            <i class="icon-credit-card"></i>
                        </div>

                        <div class="feature-box-content p-0">
                            <h3>Thanh Toán Dễ Dàng</h3>
                            <h5>Hỗ Trợ Nhiều Phương Thức</h5>

                            <p>Chúng tôi hỗ trợ đa dạng hình thức thanh toán như chuyển khoản, ví điện tử (Momo, VNPAY),
                                thanh toán khi nhận hàng và trả góp lãi suất 0%. Mua sắm dễ dàng – thanh toán linh hoạt, an
                                toàn tuyệt đối!</p>
                        </div>
                        <!-- End .feature-box-content -->
                    </div>
                    <!-- End .feature-box -->
                </div>
                <!-- End .col-md-4 -->

                <div class="col-md-4">
                    <div class="feature-box px-sm-5 feature-box-simple text-center">
                        <div class="feature-box-icon">
                            <i class="icon-action-undo"></i>
                        </div>
                        <div class="feature-box-content p-0">
                            <h3>Đội Ngũ Hỗ Trợ Tận Tâm</h3>
                            <h5>Luôn Sẵn Sàng Vì Khách Hàng</h5>

                            <p>Chúng tôi sở hữu đội ngũ nhân viên giàu kinh nghiệm, thân thiện và chuyên nghiệp, luôn sẵn
                                sàng hỗ trợ bạn 24/7. Dù là tư vấn sản phẩm, hướng dẫn mua hàng hay giải đáp thắc mắc – bạn
                                sẽ luôn nhận được sự hỗ trợ nhanh chóng và chu đáo nhất.</p>

                        </div>
                        <!-- End .feature-box-content -->
                    </div>
                    <!-- End .feature-box -->
                </div>
                <!-- End .col-md-4 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container-->
    </section>

@endsection
