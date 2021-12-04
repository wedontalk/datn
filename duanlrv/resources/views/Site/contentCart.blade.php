
<section class="shopping-cart spad delete" data-url="{{route('deleteCart')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                @if(session()->has('message'))
			                    <div class="alert alert-success">
			                        {!! session()->get('message') !!}
			                    </div>
			                @elseif(session()->has('error'))
			                     <div class="alert alert-danger">
			                        {!! session()->get('error') !!}
			                    </div>
			                @endif
                    <div class="cart-table">
                        <table class="update_cart_url" data-url="{{route('updateCart')}}" >
                            <thead>
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th class="p-name">Sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng</th>
                                    @php 
                                    $count=0;
                                    @endphp  
                                    @if(session('cart')==true)
                                    @foreach(session('cart') as $CartItem)
                                    @php 
                                    $count += $CartItem['quantity'];
                                    @endphp 
                                    @endforeach
                                    @endif 
                                    <th><a href="#" class="removeCart">Xóa Giỏ Hàng</a> ({{$count}})</th>
                                </tr>
                            </thead>
                            <!-- cart -->
                            @php 
                            $total = 0;
                            @endphp
                            @if(Session::has('cart')!=null)
                            @foreach($carts as $id => $CartItem)
                            @php 
                            $total += $CartItem['price'] * $CartItem['quantity'];
                            @endphp
                            <tbody>
                                <tr>
                                    <!-- <td class="cart-pic first-row"><img src="Site/img/products/{{$CartItem['images']}}" width="150px"alt=""></td> -->
                                    <td class="cart-pic first-row"><img src="{{asset('uploads')}}/{{$CartItem['images']}}" width="150px"alt=""></td>
                                    <td class="cart-title first-row">
                                        <h5>{{$CartItem['name']}}</h5>
                                    </td>
                                    <td class="p-price first-row">{{number_format($CartItem['price'])}}đ</td>
                                    <td class="qua-col first-row">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <!-- <input type="number" value="{{$CartItem['quantity']}}" min="1" class="quatity"> -->
                                                <span class="dec qtybtn">-</span>
                                                <input type="text" value="{{$CartItem['quantity']}}" min="1" class="quatity" disabled>
                                                <span class="inc qtybtn">+</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="total-price first-row">{{number_format($CartItem['quantity'] * $CartItem['price']) }}đ</td>
                                    <td class="close-td first-row"><i class="cart_update ti-save" data-id='{{ $id }}' onclick=""></i></td>
                                    <td class="close-td first-row"><i data-id='{{ $id }}' class="ti-close deleteCart"></i></td>
                                </tr>
                            </tbody>
                                @endforeach
                                
                                @endif
                              <!-- end cart -->
                                
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="cart-buttons">
                                <a href="{{route('products')}}" class="primary-btn continue-shop">Mua tiếp</a>
                                <!-- <a href="#" class="primary-btn up-cart">Cập nhật giỏ hàng</a> -->
                            </div>
                            <div class="discount-coupon">
                                <h6>Mã giảm giá</h6>
                                <form action="{{url('/check-coupon')}}" method="post" class="coupon-form">
                                    @csrf
                                    @if(Session::get('coupon')==null)
                                    <input type="text" placeholder="Nhập mã giảm giá" name="coupon">
                                    <button type="submit" class="site-btn coupon-btn">Giảm ngay</button>
                                    @endif
                                </form>
                                <td>
                                    @if(Session::get('coupon'))
                                    <a class="btn btn-warning " style="width:100%; font-size:1vw" href="{{url('/unset-coupon')}}">Xóa mã khuyến mãi</a>
                                    @endif
                                </td>
                            </div>
                        </div>
                        <div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                
                                    <li class="cart-total">Tổng  <span> {{number_format($total,0,',','.')}}Đ</span></li>
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
													@elseif($cou['coupon_condition']==2)
														Mã giảm : {{number_format($cou['coupon_number'],0,',','.')}}đ
														<p>
															@php 
															$total_coupon = $total - $cou['coupon_number'];
															@endphp
														</p>														
                                                        <li class="cart-total">Tổng  <span> {{number_format($total_coupon,0,',','.')}}Đ</span></li>
													@endif
												@endforeach
										</li>
									@endif
                                            
                                       
                                    </li>
                                </ul>
                                <a href="{{route('checkout')}}" class="proceed-btn">Thanh toán</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  
<script>
    jQuery(document).ready(function($) {
        var proQty = $('.pro-qty');
        proQty.addClass('dec qtybtn');
        proQty.addClass('inc qtybtn');
        proQty.on('click', '.qtybtn', function () {
            var $button = $(this);
            var oldValue = $button.parent().find('input').val();
            if ($button.hasClass('inc')) {
                var newVal = parseFloat(oldValue) + 1;
            } else if($button.hasClass('dec')){
                // Don't allow decrementing below zero
                if (oldValue > 1) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 1;
                }
            }
            $button.parent().find('input').val(newVal);
        });
    });
</script>
