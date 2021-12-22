@extends('layouts.site')
@section('main')

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="./index.html"><i class="fa fa-home"></i> Trang chủ</a>
                        <a href="./shop.html">Shop</a>
                        <span>Thanh toán</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->
  
    @if(Route::has('login'))
    @auth
    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad">
        <div class="container">
        <form action="{{URL::to('/save_checkout')}}" method="POST" class="checkout-form" formenctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-lg-6">
                        <!-- <div class="checkout-content">
                            <a href="#" class="content-btn">Click Here To Login</a>
                        </div> -->

                        <h4>Chi tiết thanh toán</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="fir">Họ và Tên<span>*</span></label>
                                <input type="text" id="fir" name="order_name" value="{{Auth::user()->name}}" >
                                @error('order_name')
                                <div class="alert alert-warning" role="alert">
                                {{$message}}
                                </div>
                                @enderror
                            </div>
                           
                         
                    <div class="col-sm-12" >
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                    <label for="fir">Tỉnh - Thành phố<span>*</span></label>
                                        <select class="form-control choose input-sm city" name="id_thanhpho" id="city" >
                                            <option value="{{old('id_thanhpho')}}">-----{{__('Tỉnh - Thành phố')}}-----</option>
                                            @foreach($thanhpho as $t)
                                            <option class="op-text" name="id_thanhpho" value="{{$t->matp}}">{{$t->name_thanhpho}}</option>
                                            @endforeach

                                        </select>
                                        @error('id_thanhpho')
                                        <div class="alert alert-warning" role="alert">
                                        {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label class="">Quận - Huyện</label>
                                        <select class="form-control input-sm choose province" name="id_quanhuyen" id="province" value="{{old('id_quanhuyen')}}">
                                            <option value="{{old('id_quanhuyen')}}" class="op-text" >-----{{__('Chọn quận huyện')}}-----</option>
                                        </select>
                                        @error('id_quanhuyen')
                                        <div class="alert alert-warning" role="alert">
                                        {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label class="">Xã - phường</label>
                                        <select class="form-control input-sm wards" name="id_xaphuong" id="wards" >
                                            <option value="{{old('id_xaphuong')}}" class="op-text">-----{{__('Chọn xã phường')}}-----</option>
                                        </select>
                                        @error('id_xaphuong')
                                        <div class="alert alert-warning" role="alert">
                                        {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label class="">Địa chỉ</label>
                                        <input type="text" class="form-control" name="order_address"  placeholder="địa chỉ cụ thể (địa chỉ nhà)" value="{{old('order_address')}}">
                                        @error('order_address')
                                        <div class="alert alert-warning" role="alert">
                                        {{$message}}
                                        </div> 
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <label for="email">Email <span>*</span></label>
                                <input type="email" id="email" name="order_email" value="{{Auth::user()->email}}">
                                @error('order_email')
                                <div class="alert alert-warning" role="alert">
                                        {{$message}}
                                        </div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="phone">Số điện thoại<span>*</span></label>
                                <input type="text" id="phone" name="order_phone" value="{{Auth::user()->phone}}">
                                @error('order_phone')
                                <div class="alert alert-warning" role="alert">
                                        {{$message}}
                                        </div>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <label for="ghichu">Phương thức thanh toán<span></span></label>
                                <!-- <input class="form-check-input radio" type="radio" name="phuongthuc_thanhtoan" id="flexRadioDefault2" value="1" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Thanh toán khi nhận hàng
                                </label> -->
                                <div class="form-check ">
                                <input class="form-check-input radio" type="radio" name="phuongthuc_thanhtoan" id="exampleRadios1" value="1" checked>
                                <label class="form-check-label" for="exampleRadios1" style="margin-left:50px">
                                    Thanh toán khi nhận hàng
                                </label>
                                </div>
                                <div class="form-check ">
                                <input class="form-check-input radio" type="radio" name="phuongthuc_thanhtoan" id="exampleRadios1" value="2" check>
                                <label class="form-check-label" for="exampleRadios1" style="margin-left:50px">
                                    Thanh toán online
                                </label>
                                </div>

                            </div>
                            <div class="col-lg-12">
                                <label for="ghichu">Ghi chú<span>*</span></label>
                                <textarea name="order_note" id="ghichu" cols="95" rows="10"></textarea>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- <div class="checkout-content">
                            <input type="text" placeholder="Enter Your Coupon Code">
                        </div> -->
                        <div class="place-order">

                            <h4>Đơn hàng</h4>
                            <div class="order-total">
                                <ul class="order-table">
                                    <li>Sản phẩm <span></span></li>
                                    @php 
                            $total = 0;
                            @endphp
                            @if(Session::has('cart')!=null)
                            @foreach($carts as $id => $CartItem)
                            @php 
                            $total += $CartItem['price'] * $CartItem['quantity'];
                            @endphp
                            <li class="fw-normal">{{$CartItem['name']}} x {{$CartItem['quantity']}} <span>{{number_format($CartItem['quantity'] * $CartItem['price']) }}đ</span></li>

                                @endforeach
                                
                                @endif
                              <!-- end cart -->
                              <!-- <li> <span class="mt-3">Tổng:   {{ number_format($total) }} </span></li> -->
                            </ul>
                            <!-- <input type="hidden" name="tong_tien" value="{{ $total }}" readonly> -->
                            
                              
                                  <div class="row">
                                        <div class="col-lg-12">
                                            
                                            <!-- <div class="discount-coupon">
                                                <h6>Mã giảm giá</h6>
                                                <form action="{{url('/check-coupon')}}" method="post" class="coupon-form">
                                                    @csrf
                                                    @if(Session::get('coupon')==null)
                                                    <input type="text" placeholder="Nhập mã giảm giá" name="coupon"style="width:63%; font-size:1vw">
                                                    <button type="submit" class="site-btn coupon-btn">Giảm ngay</button>
                                                    @endif
                                                    @if(Session::get('coupon'))
                                                    <a class="btn btn-warning " style="width:100%; font-size:1vw" href="{{url('/unset-coupon')}}">Xóa mã khuyến mãi</a>
                                                    @endif
                                                </form>
                                                <td>
                                                </td>
                                            </div> -->
                                        </div>
                                         <div class="col-lg-12 offset-lg-12">
                                            <div class="proceed-checkout">
                                                <ul>
                                                
                                                    <li class="cart-total">Tổng  <span> {{number_format($total,0,',','.')}}Đ</span></li>
                                                    <input type="hidden" name="tong_tien" value="{{ $total }}" readonly>

                                                    <li class="subtotal"> 
                                                    @if(Session::get('coupon'))
                                                        <li>
                                                            
                                                                @foreach(Session::get('coupon') as $key => $cou)
                                                                    @if($cou['coupon_condition'] == 1)
                                                                        Mã giảm : {{$cou['coupon_number']}}%
                                                                        <p>
                                                                            @php 
                                                                            $total_coupon = ($total*$cou['coupon_number'])/100;
                                                                            @endphp
                                                                        </p>
                                                                        <li class="cart-total">Tổng  <span> {{number_format($total - $total_coupon,0,',','.')}}Đ</span></li>
                                                                        <input type="hidden" name="tong_tien" value="{{ $total - $total_coupon }}" readonly>

                                                                    @elseif($cou['coupon_condition']==2)
                                                                        Mã giảm : {{number_format($cou['coupon_number'],0,',','.')}}đ
                                                                        <p>
                                                                            @php 
                                                                            $total_coupon = $total - $cou['coupon_number'];
                                                                            @endphp
                                                                        </p>														
                                                                        <li class="cart-total">Thanh toán  <span> {{number_format($total_coupon,0,',','.')}}Đ</span></li>
                                                                        <input type="hidden" name="tong_tien" value="{{ $total_coupon }}" readonly>

                                                                    @endif
                                                                @endforeach
                                                        </li>
                                                    @endif
                                                            
                                                    
                                                    </li>
                                                </ul>
                                                <div class="order-btn">
                                                    <button type="submit" style="width:100%" class="site-btn place-btn ">Thanh toán</button>

                                                </div>
                                                 <!-- <a href="{{route('checkout')}}" class="proceed-btn">Thanh toán</a>  -->
                                            </div>
                                        </div>
                                    </div> 
                                <!-- <div class="order-btn">
                                    <button type="submit" class="site-btn place-btn">Thanh toán</button>

                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
        </div>
    </section>
    @else
    @include('auth.login')
@endauth
@endif
<!-- Shopping Cart Section End -->

<script type="">
    jQuery(document).ready(function($) {
        
    $('.choose').on('change', function() {
        var action = $(this).attr('id');
        var ma_id = $(this).val();
        var _token = $('input[name="_token"]').val();

        var result = '';

        if (action == 'city') {
            result = 'province';
        }
        else {
            result = 'wards';
        }
        $.ajax({
            url: '{{url('/select-thanhpho')}}',
            method: 'post',
            data: {action: action, ma_id: ma_id, _token: _token},
            success: function(data) {
                $('#' + result).html(data);
            }
        });
    });
});
</script>
@endsection