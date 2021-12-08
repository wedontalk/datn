@extends('layouts.site')
@section('main')
  <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="./home.html"><i class="fa fa-home"></i> Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>Detail</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad page-details">
    @foreach($detail_product as $val)
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="filter-widget">
                        <h4 class="fw-title">Danh mục</h4>
                        @foreach($danhmuc as $dm)
                        <ul class="filter-catagories">
                            <li><a href="#">{{$dm->name_nav}}</a></li>
                        </ul>
                        @endforeach
                    </div>
                    
                    
                    
                    
                </div>
                <div class="col-lg-9">
                    <div class="row">
                       
                        <div class="col-lg-6">
                            <div class="product-pic-zoom">
                                <img class="product-big-img form-group" src="{{asset('uploads')}}/{{$val->image[0]}}" width="100%" height="250px">
                                <div class="zoom-icon">
                                    <i class="fa fa-search-plus"></i>
                                </div>
                            </div>
                            <div class="product-thumbs">
                                <div class="product-thumbs-track ps-slider owl-carousel">
                            @foreach($val->image as $img1)
                                    <div class="pt active" data-imgbigurl="{{asset('uploads')}}/{{$img1}}">
                                        <img src="{{asset('uploads')}}/{{$img1}}" alt="" height="100px" width="100%">
                                    </div>
                            @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-details">
                                <div class="pd-title">
                                    <span>{{$val->category->name}}</span>
                                    <h3>{{$val->title}}</h3>
                                    <a href="#" class="heart-icon"><i class="icon_heart_alt"></i></a>
                                </div>
                            @if(Route::has('login'))
                            @auth
                                <div id="rateYo"></div>
                                <form action="{{URL::to('/account-rating')}}" method="post" class="form-inline" role="form" id="formRating">
                                @csrf
                                   
                                        <input type="hidden" class="form-control" name="rating_star" id="rating_star">
                                        <input type="hidden" class="form-control" name="product_id" value="{{$val->slug_product}}">
                                        <input type="hidden" class="form-control" name="account_id" value="{{Auth::user()->id}}">
                                    
                                </form>
                            
                            @else
                                <div id="rateYo1"></div>
                            @endif
                            @endif
                                
                                <div class="pd-desc">
                                    <!-- <p>{{$val->description}}</p> -->
                                    <hr>
                                    <h4>{{number_format($val->price,0,',','.')}}VND</h4>
                                </div>
                                
                                
                                <div class="quantity">
                                    
                                    <a href="#" class="primary-btn pd-cart">Thêm vào giỏ hàng</a>
                                </div>
                                
                                <ul class="pd-tags">
                                    <li><span>Danh mục</span>:{{$val->category->name}}</li>
                                    
                                </ul>
                                <?php
                                    if($val->render == Null){?>
                                    
                                    <p class="card-text">Thuong Hieu: {{$val->brand}}</p>
                                    <?php }else{ ?>
                                        <p class="card-text">Giới tính: {{$val->render}}</p>
                                        <?php } ?>
                                
                                        <?php
                                    if($val->render == Null){?>
                                    
                                    <p class="card-text">So Luong: {{$val->quantity}}</p>
                                    <?php }else{ ?>
                                        <p class="card-text">Tuổi:{{$val->age}}</p>
                                        <?php } ?>
                                
                                <p class="card-text">Tình trạng:{{$val->status}}</p>
                                <p class="card-text">Vận chuyển: có phí</p>
                                
                                <p class="card-text">Mô tả thêm: {{$val->description}}</p>
                               
                            </div>
                        </div>
                        
                    </div>
                    <div class="product-tab">
                        <div class="tab-item">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="active" data-toggle="tab" href="#tab-1" role="tab">Mô Tả</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-2" role="tab">Thông số</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-3" role="tab">Nhận xét</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-item-content">
                            <div class="tab-content">
                                <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                                    <div class="product-content">
                                        <div class="row">
                                            <div class="col-lg-7">
                                                @foreach($detail_product as $detail)
                                                <p>{!!$detail->description!!}</p>
                                                @endforeach
                                                <!-- <h5>Mô tả sản phẩm</h5>
                                                <p>
                                                    
                                                </p> -->
                                            </div>
                                            <div class="col-lg-5">
                                                <img src="img/product-single/tab-desc.jpg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-2" role="tabpanel">
                                    <div class="specification-table">
                                        <table>
                                            <tr>
                                                <td class="p-catagory">Customer Rating</td>
                                                <td>
                                                    <div class="pd-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <span>(5)</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Price</td>
                                                <td>
                                                    <div class="p-price">$495.00</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Add To Cart</td>
                                                <td>
                                                    <div class="cart-add">+ add to cart</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Availability</td>
                                                <td>
                                                    <div class="p-stock">22 in stock</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Weight</td>
                                                <td>
                                                    <div class="p-weight">1,3kg</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Size</td>
                                                <td>
                                                    <div class="p-size">Xxl</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Color</td>
                                                <td><span class="cs-color"></span></td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Sku</td>
                                                <td>
                                                    <div class="p-code">00012</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="tab-3" role="tabpanel">
                                    <div class="customer-review-option">
                                    <h4>2 Comments</h4>
                                        <form>
                                            @csrf
                                            <input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$val->id}}">
                                            <div class="comment_show"></div>

                                        </form>
                                        <div class="leave-comment">
                                            <h4>Viết đánh giá của bạn</h4>
                                            <form action="#" class="comment-form">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <input type="text" placeholder="Tên bình luận" class="comment_name">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <input type="text" placeholder="Email">
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <textarea placeholder="Nội dung bình luận" class="comment_content"></textarea>
                                                        <button type="submit" class="site-btn send-comment">Gửi bình luận</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </section>
    <!-- Product Shop Section End -->

    <!-- Related Products Section End -->
    <div class="related-products spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Sản phẩm khác</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="img/products/women-1.jpg" alt="">
                            <div class="sale">Sale</div>
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="#">+ Quick View</a></li>
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
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="img/products/women-2.jpg" alt="">
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="#">+ Quick View</a></li>
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
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="img/products/women-3.jpg" alt="">
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="#">+ Quick View</a></li>
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
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="img/products/women-4.jpg" alt="">
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="#">+ Quick View</a></li>
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
        </div>
    </div>
    <!-- Related Products Section End -->
    @section('js')
<script>
    jQuery(document).ready(function($){
 
        
        let ratingAVG = '{{$ratingAVG}}'
        $("#rateYo").rateYo({
                  rating: ratingAVG,
                  nomalFill:"#A0A0A0",
                ratedFill:"#ffff00",
            }).on("rateyo.set", function (e, data) {
                $('#rating_star').val(data.rating);
            //alert("The rating is set to " + data.rating + "!");
            $('#formRating').submit();
        });
        $("#rateYo1").rateYo({
                  rating: ratingAVG,
                  nomalFill:"#A0A0A0",
                ratedFill:"#ffff00",
            }).on("rateyo.set", function (e, data) {
                alert("Bạn chưa đăng nhập, vui lòng đăng nhập để đánh giá!");
                });

});
</script>
@stop()