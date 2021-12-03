<section class="shopping-cart spad delete" data-url="{{ route('deleteCart') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cart-table">
                    <table class="update_cart_url" data-url="{{ route('updateCart') }}">
                        <thead>
                            <tr>
                                <th>Hình ảnh</th>
                                <th class="p-name">Sản phẩm</th>
                                <th>Đơn giá</th>
                              
                                {{-- <th><a href="#" class="removeCart">Xóa Giỏ Hàng</a> ({{ $count }})</th> --}}
                            </tr>
                        </thead>
                        <!-- cart -->
                        @php
                            $total = 0;
                        @endphp
                        @if (Session::has('cart') != null)
                            @foreach ($Wishlists as $id => $CartItem)
                              
                                <tbody>
                                    <tr>
                                      
                                        <td class="cart-pic first-row"><img
                                                src="{{ asset('uploads') }}/{{ $CartItem['images'] }}" width="150px"
                                                alt=""></td>
                                        <td class="cart-title first-row">
                                            <h5>{{ $CartItem['name'] }}</h5>
                                        </td>
                                        <td class="p-price first-row">{{ number_format($CartItem['price']) }}đ</td>
                                        {{-- <td class="qua-col first-row">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    {{-- <input type="number" value="{{ $CartItem['quantity'] }}" min="1"
                                                        class="quatity"> --}}
                                                    {{-- <span class="dec qtybtn">-</span> --}}
                                                    {{-- <input type="number" value="{{ $CartItem['quantity'] }}" min="1"
                                                    class="quatity"> --}}
                                                    {{-- <span class="inc qtybtn">+</span> --}}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="close-td first-row"><i data-id='{{ $id }}'
                                                class="ti-close deleteCart"></i></td>
                                    </tr>
                                </tbody>
                            @endforeach

                        @endif
                        <!-- end cart -->

                    </table>
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
        proQty.on('click', '.qtybtn', function() {
            var $button = $(this);
            var oldValue = $button.parent().find('input').val();
            if ($button.hasClass('inc')) {
                var newVal = parseFloat(oldValue) + 1;
            } else if ($button.hasClass('dec')) {
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
