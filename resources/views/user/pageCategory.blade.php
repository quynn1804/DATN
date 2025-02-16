@extends('user.layouts.main')
@section('content')
    <!-- Begin Kenne's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <h2>Trang sản phẩm</h2>
            <ul>
                <li><a href="index.html">Trang chủ</a></li>
                <li class="active">sản phẩm</li>
            </ul>
        </div>
    </div>
</div>
<!-- Kenne's Breadcrumb Area End Here -->

<!-- Begin Kenne's Content Wrapper Area -->
<div class="kenne-content_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 order-2 order-lg-1">
                <div class="kenne-sidebar-catagories_area">

                    <div class="kenne-sidebar_categories category-module">
                        <div class="kenne-categories_title">
                            <h5>Danh mục sản phẩm</h5>
                        </div>
                        <div class="sidebar-categories_menu">
                            <ul>
                                    <li>
                                        <a href="#"> IPHONE</a>
                                    </li>
                                    <li>
                                       <a href="#"> HUAWEI</a>
                                   </li>
                                   <li>
                                       <a href="#"> OPPO</a>
                                    </li>
                                    <li>
                                       <a href="#"> SAMSUNG</a>
                                    </li>
                            </ul>
                        </div>
                    </div>
                    <div class="kenne-sidebar_categories category-module">
                        <div class="kenne-categories_title">
                            <h5>DUNG LƯỢNG</h5>
                        </div>
                        
                        <div class="sidebar-categories_menu">
                            <ul>
                                {{-- // Lọc các kích thước duy nhất --}}
 
                                    <li>
                                        <a href="#">32GB</a>
                                    </li>
                                    <li>
                                       <a href="#">64GB</a>
                                   </li>
                                   <li>
                                       <a href="#">128GB</a>
                                    </li>
                                    <li>
                                       <a href="#">256GB</a>
                                   </li>
                            </ul>
                        </div>
                    </div>


                </div>
            </div>
            <div class="col-xl-9 col-lg-8 order-1 order-lg-2">
                <div class="shop-toolbar">
                    <div class="product-view-mode">
                        <a class="active grid-3" data-target="gridview-3" data-toggle="tooltip" data-placement="top" title="Grid View"><i class="fa fa-th"></i></a>
                        <a class="list" data-target="listview" data-toggle="tooltip" data-placement="top" title="List View"><i class="fa fa-th-list"></i></a>
                    </div>


                </div>
                <div class="shop-product-wrap grid gridview-3 row">
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="product-item" >
                                <div class="single-product" style="width: 255px; height: 360px; ">
                                    <div class="product-img" style="width: 213.4px; height: 213.4px; ">
                                        <a href="#">
                                            <img class="primary-img" src="{{ asset('assets/images/product/1-2.jpg')}}" alt="Kenne's Product Image">
                                            <img class="secondary-img" src="{{ asset('assets/images/product/1-2.jpg')}}" alt="Kenne's Product Image">
                                        </a>


                                        <!-- <div class="add-actions">
                                            <ul>
                                                <li class="quick-view-btn" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><a href="#" data-bs-toggle="tooltip" data-placement="right" title="Quick View"><i class="ion-ios-search"></i></a>
                                                </li>
                                                <li><a href="wishlist.html" data-bs-toggle="tooltip" data-placement="right" title="Add To Wishlist"><i
                                                            class="ion-ios-heart-outline"></i></a>
                                                </li>
                                                <li><a href="compare.html" data-bs-toggle="tooltip" data-placement="right" title="Add To Compare"><i
                                                            class="ion-ios-reload"></i></a>
                                                </li>
                                                <li><a href="cart.html" data-bs-toggle="tooltip" data-placement="right" title="Add To cart"><i class="ion-bag"></i></a>
                                                </li>
                                            </ul>
                                        </div> -->
                                    </div>
                                    <div class="product-content">
                                        <div class="product-desc_info">
                                            <h3 class="product-name"><a href="#"> Tên Tên SP</a></h3>
                                            <div class="price-box">
                                                    <span class="new-price">1.222.222đ</span>
                                                    <span class="old-price"><del>1.111.111đ</del></span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="list-product_item">
                                <div class="single-product" >
                                    <div class="product-img">
                                        <a href="single-product.html">
                                            <img src="{{ asset('assets/images/product/1-2.jpg')}}" alt="Kenne's Product Image">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-desc_info">
                                            <div class="price-box">
                                                <span class="new-price">1.222.222đ</span>
                                                <span class="old-price">1.111.111đ</span>
                                            </div>
                                            <h6 class="product-name"><a href="single-product.html"> Tên sản phẩm </a></h6>
                                            <div class="product-short_desc">
                                                <p> Sản Phẩm mô tả </p>
                                            </div>
                                        </div>
                                        <div class="add-actions">
                                            <ul>
                                                <li class="quick-view-btn" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><a href="#" data-bs-toggle="tooltip" data-placement="top" title="Quick View"><i class="ion-ios-search"></i></a>
                                                </li>
                                                <li><a href="wishlist.html" data-bs-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                            class="ion-ios-heart-outline"></i></a>
                                                </li>
                                                <li><a href="compare.html" data-bs-toggle="tooltip" data-placement="top" title="Add To Compare"><i class="ion-ios-reload"></i></a>
                                                </li>
                                                <li><a href="cart.html" data-bs-toggle="tooltip" data-placement="top" title="Add To cart"><i class="ion-bag"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="kenne-paginatoin-area">
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="kenne-pagination-box primary-color">
                                        <!-- Phân trang các trang số -->

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Kenne's Content Wrapper Area End Here -->




<!-- Begin Brand Area -->
<div class="brand-area pt-90">
    <div class="container">
        <div class="brand-nav border-top border-bottom">
            <div class="row">
                <div class="col-lg-12">
                    <div class="kenne-element-carousel brand-slider slider-nav" data-slick-options='{
                                "slidesToShow": 6,
                                "slidesToScroll": 1,
                                "infinite": false,
                                "arrows": false,
                                "dots": false,
                                "spaceBetween": 30
                                }' data-slick-responsive='[
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
                                  <img src="{{ asset('assets/images/brand/1.png')}}" alt="Brand Images">
                              </a>
                          </div>
                          <div class="brand-item">
                              <a href="#">
                                  <img src="{{ asset('assets/images/brand/2.png')}}" alt="Brand Images">
                              </a>
                          </div>
                          <div class="brand-item">
                              <a href="#">
                                  <img src="{{ asset('assets/images/brand/3.png')}}" alt="Brand Images">
                              </a>
                          </div>
                          <div class="brand-item">
                              <a href="#">
                                  <img src="{{ asset('assets/images/brand/4.png')}}" alt="Brand Images">
                              </a>
                          </div>
                          <div class="brand-item">
                              <a href="#">
                                  <img src="{{ asset('assets/images/brand/5.png')}}" alt="Brand Images">
                              </a>
                          </div>
                          <div class="brand-item">
                              <a href="#">
                                  <img src="{{ asset('assets/images/brand/6.png')}}" alt="Brand Images">
                              </a>
                          </div>
                          <div class="brand-item">
                              <a href="#">
                                  <img src="{{ asset('assets/images/brand/1.png')}}" alt="Brand Images">
                              </a>
                          </div>
                          <div class="brand-item">
                              <a href="#">
                                  <img src="{{ asset('assets/images/brand/2.png')}}" alt="Brand Images">
                              </a>
                          </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Brand Area End Here -->




<!-- Mirrored from htmldemo.net/kenne/kenne/index-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Nov 2023 10:13:37 GMT -->

</html>
@endsection