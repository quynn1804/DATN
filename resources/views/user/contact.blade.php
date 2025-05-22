@extends('user.layouts.master')
@section('title', 'Liên Hệ')

@section('content')
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="demo4.html"><i class="icon-home"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Liên Hệ
                </li>
            </ol>
        </div>
    </nav>



    <div class="container contact-us-container">
        <div class="contact-info">
            <div class="row">
                <div class="col-12">
                    <h2 class="ls-n-25 m-b-1">
                        Thông tin cửa hàng
                    </h2>
                    <div class="map mb-4" style="width: 100%; height: 800px;">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.123456789!2d105.790123456!3d21.035678901!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab1234567890%3A0xabcdef1234567890!2zMTgxIFRy4bqnbiBRdeG7kWMgVuG7pW5nLCBD4bqndSBHaeG6pXksIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1724964755018!5m2!1svi!2s"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <p>
                        Chúng tôi là cửa hàng chuyên cung cấp các sản phẩm chất lượng cao với dịch vụ khách hàng tận tâm.
                        Với đội ngũ giàu kinh nghiệm và hệ thống vận hành chuyên nghiệp, cửa hàng cam kết mang đến cho quý
                        khách trải nghiệm mua sắm tuyệt vời.
                        Chúng tôi luôn nỗ lực không ngừng để cải thiện dịch vụ, cập nhật sản phẩm mới và duy trì giá cả cạnh
                        tranh.
                    </p>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="feature-box text-center">
                        <i class="sicon-location-pin"></i>
                        <div class="feature-box-content">
                            <h3>Địa chỉ </h3>
                            <h5>181 Trần Quốc Vượng, Dịch Vọng Hậu, Cầu Giấy, Hà Nội</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="feature-box text-center">
                        <i class="fa fa-mobile-alt"></i>
                        <div class="feature-box-content">
                            <h3>Thông tin liên hệ </h3>
                            <h5>0367253666</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="feature-box text-center">
                        <i class="far fa-envelope"></i>
                        <div class="feature-box-content">
                            <h3>Địa chỉ email </h3>
                            <h5><a href="https://portotheme.com/cdn-cgi/l/email-protection" class="__cf_email__"
                                    data-cfemail="bcccd3cec8d3fcccd3cec8d3c8d4d9d1d992dfd3d1">[pina@gmail.com]</a>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="feature-box text-center">
                        <i class="far fa-calendar-alt"></i>
                        <div class="feature-box-content">
                            <h3>Thời gian hoạt động</h3>
                            <h5>Thứ 2 - Chủ Nhật / 9:00 AM
                                - 8:00 PM
                            </h5>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <h2 class="mt-6 mb-2">Gửi liên hệ với chúng tôi</h2>

                <form class="mb-0" action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="mb-1" for="name">
                            Họ và tên
                            <span class="required">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" required />
                    </div>

                    <div class="form-group">
                        <label class="mb-1" for="email">
                            Email
                            <span class="required">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" required />
                    </div>

                    <div class="form-group">
                        <label class="mb-1" for="subject">
                            Chủ đề
                            <span class="required">*</span></label>
                        <input type="text" class="form-control" id="subject" name="subject" required />
                    </div>

                    <div class="form-group">
                        <label class="mb-1" for="message">Tin nhắn của bạn
                            <span class="required">*</span></label>
                        <textarea cols="30" rows="1" id="message" class="form-control" name="message" required></textarea>
                    </div>

                    <div class="form-footer mb-0">
                        <button type="submit" class="btn btn-dark font-weight-normal">
                            Gửi
                        </button>
                    </div>
                </form>
            </div>

            <div class="col-lg-6">
                <h2 class="mt-6 mb-1">Câu hỏi thường gặp (FAQ)</h2>
                <div id="accordion">
                    <div class="card card-accordion">
                        <a class="card-header" href="contact.html#" data-toggle="collapse" data-target="#collapseOne"
                            aria-expanded="true" aria-controls="collapseOne">
                            Làm thế nào để liên hệ với bộ phận hỗ trợ?
                        </a>

                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                            <p>Bạn có thể sử dụng biểu mẫu liên hệ ở trên hoặc gửi email trực tiếp đến địa chỉ của chúng
                                tôi.</p>
                        </div>
                    </div>

                    <div class="card card-accordion">
                        <a class="card-header collapsed" href="contact.html#" data-toggle="collapse"
                            data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                            Mất bao lâu để nhận được phản hồi?
                        </a>

                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                            <p>Thông thường, chúng tôi sẽ phản hồi trong vòng 24–48 giờ làm việc.</p>
                        </div>
                    </div>

                    <div class="card card-accordion">
                        <a class="card-header collapsed" href="contact.html#" data-toggle="collapse"
                            data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                            Tôi có thể chỉnh sửa thông tin đã gửi sau khi liên hệ không?
                        </a>

                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                            <p>Nếu bạn cần chỉnh sửa nội dung đã gửi, vui lòng gửi lại tin nhắn mới với ghi chú rõ ràng.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="mb-8"></div>
@endsection
