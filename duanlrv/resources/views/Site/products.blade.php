@extends('layouts.site')

@section('main')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<style>
    .page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
    font-size: 18px;
}
.pagination .disabled{
    font-size:18px;
}
</style>
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
                    <div class="filter-widget">
                        <h4 class="fw-title">Danh mục</h4>
                        <ul class="filter-catagories">
                            @foreach ($categoryNav as $cate)
                            <li><a href="{{URL::to('/danh-muc-san-pham/'.$cate->slug)}}">{{$cate->name_nav}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="filter-widget">
                        <h4 class="fw-title">Giá</h4>
                        <form action="{{route('locgia')}}" method="get">
                            @csrf
                        <div class="filter-range-wrap">
                            <div class="range-slider">
                                <div class="price-input">
                                    <input type="text" id="minamount" name="minamount">
                                    <input type="text" id="maxamount" name="maxamount">
                                </div>
                            </div>
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                data-min="0" data-max="2000000">
                                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            </div>
                        </div>
                        
                        <button type="submit" class="filter-btn">Lọc</button>
                        </form>
                    </div>
                    <div class="filter-widget">
                        <h4 class="fw-title">Thương hiệu</h4>
                        <div class="fw-brand-check">
                            <div class="bc-item">
                                <label for="bc-calvin">
                                    Calvin Klein
                                    <input type="checkbox" id="bc-calvin">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="bc-item">
                                <label for="bc-diesel">
                                    Diesel
                                    <input type="checkbox" id="bc-diesel">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="bc-item">
                                <label for="bc-polo">
                                    Polo
                                    <input type="checkbox" id="bc-polo">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="bc-item">
                                <label for="bc-tommy">
                                    Tommy Hilfiger
                                    <input type="checkbox" id="bc-tommy">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="filter-widget">
                        <!-- <h4 class="fw-title">Tags</h4>
                        <div class="fw-tags">
                            <a href="#">Towel</a>
                            <a href="#">Shoes</a>
                            <a href="#">Coat</a>
                            <a href="#">Dresses</a>
                            <a href="#">Trousers</a>
                            <a href="#">Men's hats</a>
                            <a href="#">Backpack</a>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="product-show-option">
                        <div class="row">
                            <div class="col-lg-7 col-md-7">
                                <div class="select-option">
                                    <select class="c-show" name="sort" id="sort">
                                        @foreach($category_by_id as $key =>$cate_id)
                                            <a href="{{URL::to('/show-category/'.$cate_id->slug)}}">
                                            <option value="{{Request::url()}}?locsp={{$cate_id->slug}}">{{$cate_id->name}}</option>
                                            </a>
                                        @endforeach
                                        <option value="{{Request::url()}}" selected>-- phân loại --</option>
                                    </select>
                                    <select class="p-show" style="display:none">
                                        <option value="">Show:</option>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-lg-5 col-md-5 text-right">
                                <p>Hiển thị 01- 09 trong 36 sản phẩm</p>
                            </div> -->
                        </div>
                    </div>
                    <div class="product-list">
                        <div class="row">
                            <!-- products -->
                            @foreach($products as $product)
                            <div class="col-lg-4 col-sm-6">
                                <div class="product-item">
                                    <div class="pi-pic">
                                        @if(json_decode($product->image))
                                            <img src="{{ asset('uploads') }}/{{json_decode($product->image)[0]}}" height="250px" alt="">
                                        @else
                                            <img src="{{ asset('uploads') }}/{{$product->image}}" height="250px" alt="">
                                        @endif
                                        <div class="sale pp-sale">Sale</div>
                                        <div class="icon">
                                            <a href="{{URL::to('addToWishlist/'.$product->id)}}"><i class="far fa-heart" style="color:#fff;font-size:25px"></i></a>
                                        </div>
                                        @if($product->quantity>0)
                                        <ul>
                                            <li class="w-icon active"><a href="#"  data-url="{{route('addToCart', ['id'=>$product->id])}}" class=" add_to_cart"  ><i class="icon_bag_alt add_to_cart"></i></a></li>
                                            <!-- <li class="quick-view add_to_cart"><a href="{{URL::to('chi-tiet-san-pham/'.$product->slug_product)}}">Xem chi tiết</a></li> -->
                                            <li class="quick-view"><a href="{{URL::to('chi-tiet-san-pham/'.$product->slug_product)}}">Xem chi tiết</a></li>
                                            <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                        </ul>
                                        @else
                                        <ul>
                                          
                                            <li class="quick-view" style="width:98%; margin:2px"><a href="">Hết hàng</a></li>
                                            
                                        </ul>
                                        @endif

                                    </div>
                                    <div class="pi-text">
                                        <div class="catagory-name"></div>
                                        <!-- <div class="catagory-name">{{$product->id}}</div> -->
                                        <a href="{{URL::to('chi-tiet-san-pham/'.$product->slug_product)}}">
                                            <h5>{{$product-> title}}</h5>
                                        </a>
                                        <div class="product-price">
                                        {{$product-> discount}} đ
                                            <span>{{$product-> price}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                    <div class="loading-more">
                        <!-- <i class="icon_loading"></i> -->
                        {{$products->appends(request()->all())->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->

@endsection
@section('js')
    <script>
        jQuery(document).ready(function($) {
        $('#sort').on('change', function() {
            var url = $(this).val();
            // alert(url);
            if(url){
                window.location = url;
            }
            return false;
        });
        locdanhsach();
        function locdanhsach() {
            var url = window.location.href;

            $('select[name="sort"]').find('option[value="'+url+'"]').attr("selected",true);
        }
    });
</script>
@stop()