@extends('layouts.site')

@section('main')

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a>
                        <a href="{{route('products')}}">Cửa hàng</a>
                        <span>sản phẩm yêu thích</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <div class="content">
        @include('Site.contentWishlist')


    </div>

    <!-- Shopping Cart Section End -->

  
<script>
    
//Xóa cart
    function deleteCart(event){
        event.preventDefault();
        let urldeleteCart= $('.delete').data('url');
        let id =$(this).data('id');
        alertify.confirm('Bạn có muốn xóa không?', function(result){
            if(result){
                $.ajax({
                    type:"GET",
                    url: urldeleteCart,
                    data: {id: id},
                    success: function (data) {
                            $('.content').html(data.contentCart);
                            $('#ajax_cart').html(data.cartquick);   
                            console.log(data);
                    },
                    error: function () {
                        
                    }
                })
            }
        alertify.success('Xóa Sản phẩm thành công!') 
        }, function(){ alertify.error('Hủy Xóa sản phẩm')});
    }


//các sự kiện
    $(function () {
        $(document).on('click','.cart_update',cartUpdate);
        $(document).on('click','.deleteWishlists',deleteWishlists);

        
    });
   
</script>
@endsection
