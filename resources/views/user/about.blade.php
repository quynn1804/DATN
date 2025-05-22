@extends('user.layouts.master')
@section('title', 'Giới thiệu')
@section('content')

<div class="page-header page-header-bg text-left" style="background: 50%/cover #D4E1EA url('theme/client/images/page-header-bg.jpg');">
    <div class="container">
        <h1><span>VỀ CHÚNG TÔI</span>
            PinaStore </h1>
        <a href="{{ route('contact') }}" class="btn btn-dark">Liên hệ</a>
    </div>
</div>

<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Giới thiệu</li>
        </ol>
    </div>
</nav>

<div class="about-section">
    <div class="container">
        <h2 class="subtitle">CÂU CHUYỆN CỦA CHÚNG TÔI</h2>
        <p>Đây là dự án tốt nghiệp của nhóm DATN-SP25-WD73 với 4 thành viên !!!!!</p>
        <p>Đây là trang website bán điện thoại demo </p>

        <p class="lead">“Tất cả các sản phẩm đều chỉ là demo,nhưng các chức năng của trang web là hết sức đầy đủ cho nhu cầu của khách hàng. ”</p>
    </div>
</div>

<div class="features-section bg-gray">
    <div class="container">
        <h2 class="subtitle">VÌ SAO CHỌN CHÚNG TÔI</h2>
        <div class="row">
            <div class="col-lg-4">
                <div class="feature-box bg-white">
                    <i class="icon-shipped"></i>
                    <div class="feature-box-content p-0">
                        <h3>Miễn phí vận chuyển</h3>
                        <p>Chúng tôi cung cấp dịch vụ giao hàng miễn phí toàn quốc với cam kết đúng hẹn và an toàn.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="feature-box bg-white">
                    <i class="icon-us-dollar"></i>
                    <div class="feature-box-content p-0">
                        <h3>Hoàn tiền 100%</h3>
                        <p>Cam kết hoàn tiền nếu sản phẩm không đúng như mô tả hoặc bị lỗi do nhà sản xuất.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="feature-box bg-white">
                    <i class="icon-online-support"></i>
                    <div class="feature-box-content p-0">
                        <h3>Hỗ trợ 24/7</h3>
                        <p>Đội ngũ hỗ trợ luôn sẵn sàng tư vấn và giải đáp mọi thắc mắc của bạn mọi lúc, mọi nơi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="testimonials-section">
    <div class="container">
        <h2 class="subtitle text-center">KHÁCH HÀNG HÀI LÒNG</h2>

        <div class="testimonials-carousel owl-carousel owl-theme images-left" data-owl-options="{
            'margin': 20,
            'lazyLoad': true,
            'autoHeight': true,
            'dots': false,
            'responsive': {
                '0': {
                    'items': 1
                },
                '992': {
                    'items': 2
                }
            }
        }">
            <div class="testimonial">
                <div class="testimonial-owner">
                    <figure>
                        <img src="{{ asset('theme/client/images/clients/client1.png') }}" alt="client">
                    </figure>
                    <div>
                        <strong class="testimonial-title">John Smith</strong>
                        <span>Khách hàng </span>
                    </div>
                </div>
                <blockquote>
                    <p>Dịch vụ tuyệt vời, đội ngũ hỗ trợ nhanh chóng. Tôi hoàn toàn hài lòng với trải nghiệm mua sắm tại đây.</p>
                </blockquote>
            </div>

            <div class="testimonial">
                <div class="testimonial-owner">
                    <figure>
                        <img src="{{ asset('theme/client/images/clients/client2.png') }}" alt="client">
                    </figure>
                    <div>
                        <strong class="testimonial-title">Bob Smith</strong>
                        <span>Khách hàng </span>
                    </div>
                </div>
                <blockquote>
                    <p>Sản phẩm đúng như mô tả, giao hàng nhanh và chuyên nghiệp. Tôi sẽ tiếp tục ủng hộ trong tương lai.</p>
                </blockquote>
            </div>

            <div class="testimonial">
                <div class="testimonial-owner">
                    <figure>
                        <img src="{{ asset('theme/client/images/clients/client1.png') }}" alt="client">
                    </figure>
                    <div>
                        <strong class="testimonial-title">John Smith</strong>
                        <span>Khách hàng </span>
                    </div>
                </div>
                <blockquote>
                    <p>Tôi đã sử dụng sản phẩm ở nhiều nơi, nhưng đây là nơi duy nhất khiến tôi thực sự yên tâm và hài lòng.</p>
                </blockquote>
            </div>
        </div>
    </div>
</div>

<div class="counters-section bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-4 count-container">
                <div class="count-wrapper">
                    <span class="count-to" data-from="0" data-to="200" data-speed="2000" data-refresh-interval="50">2000</span>+
                </div>
                <h4 class="count-title"> Khách hàng</h4>
            </div>

            <div class="col-6 col-md-4 count-container">
                <div class="count-wrapper">
                    <span class="count-to" data-from="0" data-to="1800" data-speed="2000" data-refresh-interval="50">1800</span>+
                </div>
                <h4 class="count-title">Thành viên</h4>
            </div>

            <div class="col-6 col-md-4 count-container">
                <div class="count-wrapper line-height-1">
                    <span class="count-to" data-from="0" data-to="24" data-speed="2000" data-refresh-interval="50">24</span><span>h</span>
                </div>
                <h4 class="count-title">Hỗ trợ mỗi ngày</h4>
            </div>

            <div class="col-6 col-md-4 count-container">
                <div class="count-wrapper">
                    <span class="count-to" data-from="0" data-to="265" data-speed="2000" data-refresh-interval="50">2</span>+
                </div>
                <h4 class="count-title">Chi nhánh & đại lý</h4>
            </div>

            <div class="col-6 col-md-4 count-container">
                <div class="count-wrapper line-height-1">
                    <span class="count-to" data-from="0" data-to="99" data-speed="2000" data-refresh-interval="50">99</span><span>%</span>
                </div>
                <h4 class="count-title">Khách hàng hài lòng</h4>
            </div>
        </div>
    </div>
</div>

@endsection
