@extends('user.layouts.main')
@section('title')
    Liên hệ
@endsection
@section('content')
    <!-- Begin Kenne's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Khác</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Trang Chủ</a></li>
                    <li class="active">Liên Hệ</li>
                </ul>
            </div>
        </div>
    </div>
    @if (session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif
    <!-- Kenne's Breadcrumb Area End Here -->
    <!-- Begin Contact Main Page Area -->
    <div class="contact-main-page" style="margin-top: -500px;">
        <div class="container">
            <div id="google-map"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-5 offset-lg-1 col-md-12 order-1 order-lg-2">
                    <div class="contact-page-side-content">
                        <h3 class="contact-page-title">Liên hệ với chúng tôi</h3>
                        <p class="contact-page-message">Chúng tôi luôn tận tâm chăm sóc khách hàng, lắng nghe từng nhu cầu
                            và mong muốn của bạn.
                            Với dịch vụ chuyên nghiệp, tận tình và chu đáo, chúng tôi cam kết mang đến những trải nghiệm tốt
                            nhất, giúp bạn luôn
                            hài lòng và tin tưởng. Sự hài lòng của bạn chính là động lực để chúng tôi không ngừng cải thiện
                            và phát triển</p>
                        <div class="single-contact-block">
                            <h4><i class="fa fa-fax"></i> Địa Chỉ</h4>
                            <p> Xuân Lai, Xuân Thu, Sóc Sơn, Hà Nội</p>
                        </div>
                        <div class="single-contact-block">
                            <h4><i class="fa fa-phone"></i> Phone</h4>
                            <p>Mobile: (08) 337 686 606</p>
                            <p>Hotline: 1009 678 456</p>
                        </div>
                        <div class="single-contact-block last-child">
                            <h4><i class="fa fa-envelope-o"></i> Email</h4>
                            <p>yourmail@domain.com</p>
                            <p>support@hastech.company</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 order-2 order-lg-1">

            
                <div class="contact-form-content">
                    <h3 class="contact-page-title">Hãy Cho Chúng Tôi Biết Tin Nhắn Của Bạn</h3>
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label>Họ Và Tên <span class="required">*</span></label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
            
                        <div class="form-group mb-3">
                            <label>Email<span class="required">*</span></label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
            
                        <div class="form-group mb-3">
                            <label>Chủ Đề</label>
                            <input type="text" name="subject" class="form-control">
                        </div>
            
                        <div class="form-group mb-3">
                            <label>Tin Nhắn Của Bạn</label>
                            <textarea name="message" class="form-control" rows="5"></textarea>
                        </div>
            
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Gửi</button>
                        </div>
                    </form>
                </div>
            </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Contact Main Page Area End Here -->

    <!-- Begin Brand Area -->
    <div class="brand-area ">
        <div class="container">
            <div class="brand-nav border-top ">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="kenne-element-carousel brand-slider slider-nav"
                            data-slick-options='{
                                    "slidesToShow": 6,
                                    "slidesToScroll": 1,
                                    "infinite": false,
                                    "arrows": false,
                                    "dots": false,
                                    "spaceBetween": 30
                                    }'
                            data-slick-responsive='[
                                    {"breakpoint":992, "settings": {
                                    "slidesToShow": 4
                                    }},
                                    {"breakpoint":768, "settings": {
                                    "slidesToShow": 3
                                    }},
                                    {"breakpoint":576, "settings": {
                                    "slidesToShow": 2
                                    }}
                                ]'>

                            <div class="brand-item">
                                <a href="#">
                                    <img src="assets/images/brand/1.png" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="#">
                                    <img src="assets/images/brand/2.png" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="#">
                                    <img src="assets/images/brand/3.png" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="#">
                                    <img src="assets/images/brand/4.png" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="#">
                                    <img src="assets/images/brand/5.png" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="#">
                                    <img src="assets/images/brand/6.png" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="#">
                                    <img src="assets/images/brand/1.png" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="#">
                                    <img src="assets/images/brand/2.png" alt="Brand Images">
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
