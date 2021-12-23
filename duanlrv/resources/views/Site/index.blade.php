@extends('layouts.site')

@section('main')

    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="hero-items owl-carousel">
            @foreach($slidene as $slide)
                <div class="single-hero-items set-bg" data-setbg="{{ asset('uploads')}}/{{$slide->image}}">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-5" style="margin-top:-50px">
                                <h1>{{$slide->tieu_de}}</h1>
                                <p>{{$slide->thong_tin}}</p>
                                <a href="{{$slide->link}}" class="primary-btn">Xem ngay</a>
                            </div>
                        </div>
                        <div class="off-card" style="margin-top:10px">
                            <h2>{{$slide->khuyen_mai}}</h2>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Banner Section Begin -->
    <div class="banner-section spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-banner">
                        <img src="{{ asset('uploads/cho2.jpg') }}" alt="" width="400px" height="250px">
                        <div class="inner-text">
                            <h4>Chó</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-banner">
                        <img src="{{ asset('uploads/meo2.jpg') }}" alt="" width="400px" height="250px">
                        <div class="inner-text">
                            <h4>Mèo</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-banner">
                        <img src="{{ asset('uploads/dichvu.jpg') }}" alt="" width="400px" height="250px">
                        <div class="inner-text">
                            <h4>Dịch vụ chăm sóc</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Section End -->

    <!-- Women Banner Section Begin -->
    <section class="women-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="product-large set-bg" data-setbg="{{ asset('uploads/dog.jpg') }}">
                        <h2>Cún yêu</h2>
                        <a href="#">Xem ngay</a>
                    </div>
                </div>
                <div class="col-lg-8 offset-lg-1">
                    <div class="filter-control">
                        <ul class="tabs" >
                            <li class="tab-item active" style="border-bottom:1px solid">Sản phẩm mới</li>
                            <!-- <li class="tab-item" >Vệ sinh</li>
                            <li class="tab-item">Phụ kiện</li>
                            <li class="tab-item">Chuồng</li>
                            <li class="line"></li> -->
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <div class="product-slider owl-carousel">
                                @foreach($products as $items)
                            <div class="product-item" >
                                <div class="pi-pic" >
                                    @if(json_decode($items->image))
                                        <img src="{{ asset('uploads') }}/{{json_decode($items->image)[0]}}" alt=""style="height: 350px">
                                    @else
                                        <img src="{{ asset('uploads') }}/{{$items->image}}" alt=""style="height: 350px">
                                    @endif
                                    <div class="sale">Sale</div>
                                    <div class="icon">
                                        <i class="icon_heart_alt"></i>
                                    </div>
                                    <ul>
                                        <li class="w-icon active"><a href="#" data-url="{{route('addToCart', ['id'=>$items->id])}}" class=" add_to_cart"  ><i class="icon_bag_alt add_to_cart"></i></a></li>
                                        <li class="quick-view"><a href="{{URL::to('chi-tiet-san-pham/'.$items->slug_product)}}">+ Xem chi tiết</a></li>
                                        <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                    </ul>
                                </div>
                                <div class="pi-text">
                                    <div class="catagory-name">Coat</div>
                                    <a href="#">
                                        <h5>{{$items->title}}</h5>
                                    </a>
                                    <div class="product-price">
                                    {{$items->discount}} đ
                                            <span>{{$items->price}}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                            </div>
                        </div>
                        <!-- end -->
                        <div class="tab-pane" >
                            <div class="product-slider owl-carousel">
                            <div class="product-item" >
                                <div class="pi-pic">
                                    <img src="{{ asset('site/img/products/s1.jpg') }}" alt="">
                                    <div class="sale">Sale</div>
                                    <div class="icon">
                                        <i class="icon_heart_alt"></i>
                                    </div>
                                    <ul>
                                        <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                        <li class="quick-view"><a href="#">+ Xem chi tiết</a></li>
                                        <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                    </ul>
                                </div>
                                <div class="pi-text">
                                    <div class="catagory-name">Coat</div>
                                    <a href="#">
                                        <h5>Pure Pineapple</h5>
                                    </a>
                                    <div class="product-price">
                                        $14.00
                                        <span>$35.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item">
                                <div class="pi-pic">
                                    <img src="{{ asset('site/img/products/s2.jpg') }}" alt="">
                                    <div class="icon">
                                        <i class="icon_heart_alt"></i>
                                    </div>
                                    <ul>
                                        <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                        <li class="quick-view"><a href="#">+ Xem chi tiết</a></li>
                                        <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                    </ul>
                                </div>
                                <div class="pi-text">
                                    <div class="catagory-name">Shoes</div>
                                    <a href="#">
                                        <h5>Guangzhou sweater</h5>
                                    </a>
                                    <div class="product-price">
                                        $13.00
                                    </div>
                                </div>
                            </div>
                            <div class="product-item">
                                <div class="pi-pic">
                                    <img src="{{ asset('site/img/products/women-3.jpg') }}" alt="">
                                    <div class="icon">
                                        <i class="icon_heart_alt"></i>
                                    </div>
                                    <ul>
                                        <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                        <li class="quick-view"><a href="#">Xem chi tiết</a></li>
                                        <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                    </ul>
                                </div>
                                <div class="pi-text">
                                    <div class="catagory-name">Towel</div>
                                    <a href="#">
                                        <h5>Pure Pineapple</h5>
                                    </a>
                                    <div class="product-price">
                                        $34.00
                                    </div>
                                </div>
                            </div>
                            <div class="product-item">
                                <div class="pi-pic">
                                    <img src="{{ asset('site/img/products/women-4.jpg') }}" alt="">
                                    <div class="icon">
                                        <i class="icon_heart_alt"></i>
                                    </div>
                                    <ul>
                                        <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                        <li class="quick-view"><a href="#">+ Xem chi tiết</a></li>
                                        <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                    </ul>
                                </div>
                                <div class="pi-text">
                                    <div class="catagory-name">Towel</div>
                                    <a href="#">
                                        <h5>Converse Shoes</h5>
                                    </a>
                                    <div class="product-price">
                                        $34.00
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- end -->
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- Women Banner Section End -->

    <!-- Deal Of The Week Section Begin-->
    <!-- <section class="deal-of-week set-bg spad" data-setbg="{{ asset('site/img/time-bg.jpg') }}">
        <div class="container">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h2>Deal Of The Week</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed<br /> do ipsum dolor sit amet,
                        consectetur adipisicing elit </p>
                    <div class="product-price">
                        $35.00
                        <span>/ HanBag</span>
                    </div>
                </div>
                <div class="countdown-timer" id="countdown">
                    <div class="cd-item">
                        <span>56</span>
                        <p>Days</p>
                    </div>
                    <div class="cd-item">
                        <span>12</span>
                        <p>Hrs</p>
                    </div>
                    <div class="cd-item">
                        <span>40</span>
                        <p>Mins</p>
                    </div>
                    <div class="cd-item">
                        <span>52</span>
                        <p>Secs</p>
                    </div>
                </div>
                <a href="#" class="primary-btn">Shop Now</a>
            </div>
        </div>
    </section> -->
    <!-- Deal Of The Week Section End -->

    <!-- Man Banner Section Begin -->
    <section class="man-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="filter-control">
                        <ul>
                            <li class="active" style="border-bottom:1px solid">Sản phẩm mới</li>
                            <!-- <li>HandBag</li>
                            <li>Shoes</li>
                            <li>Accessories</li> -->
                        </ul>
                    </div>
                    <div class="product-slider owl-carousel">
                        @foreach($products as $items)
                            <div class="product-item" >
                                <div class="pi-pic" >
                                    @if(json_decode($items->image))
                                        <img src="{{ asset('uploads') }}/{{json_decode($items->image)[0]}}" alt=""style="height: 350px">
                                    @else
                                        <img src="{{ asset('uploads') }}/{{$items->image}}" alt=""style="height: 350px">
                                    @endif
                                    <div class="sale">Sale</div>
                                    <div class="icon">
                                        <i class="icon_heart_alt"></i>
                                    </div>
                                    <ul>
                                        <li class="w-icon active"><a href="#" data-url="{{route('addToCart', ['id'=>$items->id])}}" class=" add_to_cart"  ><i class="icon_bag_alt add_to_cart"></i></a></li>
                                        <li class="quick-view"><a href="{{URL::to('chi-tiet-san-pham/'.$items->slug_product)}}">+ Xem chi tiết</a></li>
                                        <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                    </ul>
                                </div>
                                <div class="pi-text">
                                    <div class="catagory-name">Coat</div>
                                    <a href="#">
                                        <h5>{{$items->title}}</h5>
                                    </a>
                                    <div class="product-price">
                                    {{$items->discount}} đ
                                            <span>{{$items->price}}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="product-large set-bg m-large" data-setbg="{{ asset('uploads/meo.jpg') }}">
                        <h2>Mèo</h2>
                        <a href="#">Discover More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Man Banner Section End -->

    <!-- Instagram Section Begin -->
    <!-- <div class="instagram-photo">
        <div class="insta-item set-bg" data-setbg="{{ asset('site/img/insta-1.jpg') }}">
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="#">colorlib_Collection</a></h5>
            </div>
        </div>
        <div class="insta-item set-bg" data-setbg="{{ asset('site/img/insta-2.jpg') }}">
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="#">colorlib_Collection</a></h5>
            </div>
        </div>
        <div class="insta-item set-bg" data-setbg="{{ asset('site/img/insta-3.jpg') }}">
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="#">colorlib_Collection</a></h5>
            </div>
        </div>
        <div class="insta-item set-bg" data-setbg="{{ asset('site/img/insta-4.jpg') }}">
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="#">colorlib_Collection</a></h5>
            </div>
        </div>
        <div class="insta-item set-bg" data-setbg="{{ asset('site/img/insta-5.jpg') }}">
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="#">colorlib_Collection</a></h5>
            </div>
        </div>
        <div class="insta-item set-bg" data-setbg="{{ asset('site/img/insta-6.jpg') }}">
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="#">colorlib_Collection</a></h5>
            </div>
        </div>
    </div> -->
    <!-- Instagram Section End -->

    <!-- Latest Blog Section Begin -->
    <section class="latest-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Cẩm Nang Thú Cưng</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($tintucne as $ttne)
                <div class="col-lg-4 col-md-6">
                    <div class="single-latest-blog">
                        <img src="{{ asset('uploads')}}/{{$ttne->image}}" alt="" width="300px" height="300px">
                        <div class="latest-text">
                            <div class="tag-list">
                                <div class="tag-item">
                                    <i class="fa fa-calendar-o"></i>
                                    {{$ttne->updated_at}}
                                </div>
                                <!-- <div class="tag-item">
                                    <i class="fa fa-comment-o"></i>
                                    5
                                </div> -->
                            </div>
                            <a href="#">
                                <h4>{{$ttne->name_post}}</h4>
                            </a>
                            <p></p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="benefit-items">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img src="{{ asset('site/img/icon-1.png') }}" alt="">
                            </div>
                            <div class="sb-text">
                                <h6>Miễn phí vận chuyển</h6>
                                <!-- <p>For all order over 99$</p> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img src="{{ asset('site/img/icon-2.png') }}" alt="">
                            </div>
                            <div class="sb-text">
                                <h6>Giao hàng đúng hạn</h6>
                                <p>Trả hàn nếu gặp vấn đề</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img src="{{ asset('site/img/icon-1.png') }}" alt="">
                            </div>
                            <div class="sb-text">
                                <h6>Thanh toán an toàn</h6>
                                <p>100% thanh toán an toàn</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Blog Section End -->

    <!-- Partner Logo Section Begin -->

    <!-- Partner Logo Section End -->
  
 <script>
     const $$ = document.querySelector.bind(document);
const $$$ = document.querySelectorAll.bind(document);

const tabs = $$$(".tab-item");
const panes = $$$(".tab-pane");

const tabActive = $$(".tab-item.active");
const line = $$(".tabs .line");

line.style.left = tabActive.offsetLeft + "px";
line.style.width = tabActive.offsetWidth + "px";

tabs.forEach((tab, index) => {
  const pane = panes[index];

  tab.onclick = function () {
    $$(".tab-item.active").classList.remove("active");
    $$(".tab-pane.active").classList.remove("active");

    line.style.left = this.offsetLeft + "px";
    line.style.width = this.offsetWidth + "px";

    this.classList.add("active");
    pane.classList.add("active");
  };
});

 </script>
@endsection