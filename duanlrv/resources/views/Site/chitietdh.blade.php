@extends('layouts.site')
@section('main')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css">
<style>
    body {
    background-color: #f9f9fa
}

 .flex {
     -webkit-box-flex: 1;
     -ms-flex: 1 1 auto;
     flex: 1 1 auto
 }

 @media (max-width:991.98px) {
     .padding {
         padding: 1.5rem
     }
 }

 @media (max-width:767.98px) {
     .padding {
         padding: 1rem
     }
 }

 .padding {
     padding: 5rem
 }

.padding {
    padding: 3rem !important
}

.user-card-full {
    overflow: hidden
}

.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    border: none;
    margin-bottom: 30px
}

.m-r-0 {
    margin-right: 0px
}

.m-l-0 {
    margin-left: 0px
}

.user-card-full .user-profile {
    border-radius: 5px 0 0 5px
}

.bg-c-lite-green {
    background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
    background: linear-gradient(to right, #ee5a6f, #f29263)
}

.user-profile {
    padding: 20px 0
}

.card-block {
    padding: 1.25rem
}

.m-b-25 {
    margin-bottom: 25px
}

.img-radius {
    border-radius: 5px
}

h6 {
    font-size: 14px
}

.card .card-block p {
    line-height: 25px
}

@media only screen and (min-width: 1400px) {
    p {
        font-size: 14px
    }
}

.card-block {
    padding: 1.25rem
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0
}

.m-b-20 {
    margin-bottom: 20px
}

.p-b-5 {
    padding-bottom: 5px !important
}

.card .card-block p {
    line-height: 25px
}

.m-b-10 {
    margin-bottom: 10px
}

.text-muted {
    color: #919aa3 !important
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0
}

.f-w-600 {
    font-weight: 600
}

.m-b-20 {
    margin-bottom: 20px
}

.m-t-40 {
    margin-top: 20px
}

.p-b-5 {
    padding-bottom: 5px !important
}

.m-b-10 {
    margin-bottom: 10px
}

.m-t-40 {
    margin-top: 20px
}

.user-card-full .social-link li {
    display: inline-block
}

.user-card-full .social-link li a {
    font-size: 20px;
    margin: 0 10px 0 0;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out
}
</style>
    <div class="container" >
    <br>
    <center><h3>Chi tiết đơn hàng của bạn</h3></center>
    <hr>
        <div class="row">
        <div class="col-md-5">
            <div class="card user-card-full">
                <div class="row m-l-0 m-r-0">
                    <div class="col-sm-4 bg-c-lite-green user-profile">
                        <div class="card-block text-center text-white">
                            <div class="m-b-25" style="border-radius:50%;">
                            @if(Auth::user()->avatar)
                            <img src="{{asset('uploaduser')}}/{{auth::user()->avatar}}" class="img-radius" alt="User-Profile-Image">
                            @else
                            <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image">
                            @endif
                        </div>
                            <h6 class="f-w-600">admin</h6>
                            <p>0369242446</p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                        </div>
                    </div>
                    <div class="col-sm-8">
                    @foreach($donhang as $dt)
                        <div class="card-block">
                            <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Thông tin cơ bản</h6>
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="m-b-10 f-w-600">Email</p>
                                    <h6 class="text-muted f-w-400">{{$dt->order_email}}</h6>
                                </div>
                                <div class="col-sm-12">
                                    <p class="m-b-10 f-w-600">Phone</p>
                                    <h6 class="text-muted f-w-400">{{$dt->order_phone}}</h6>
                                </div>
                                <hr>
                                    <div class="col-sm-12"> 
                                        <p class="m-b-10 f-w-600"><i class="fa fa-truck"></i>hình thức giao hàng:</p>
                                            @if($dt->phuongthuc_giaohang = 1)
                                                <h6 class="m-b-10 f-w-600">Giao hàng nhanh</h6>
                                            @elseif($dt->phuongthuc_giaohang = 2)
                                                <h6 class="m-b-10 f-w-600">Giao hàng tiết kiệm</h6>
                                            @elseif($dt->phuongthuc_giaohang = 3)
                                                <h6 class="m-b-10 f-w-600">VIETEL POST</h6>
                                            @else
                                                <h6 class="m-b-10 f-w-600">ninja Vận</h6>
                                            @endif
                                    </div>
                                    <div class="col-sm-12 m-b-10 f-w-600">
                                         <p class="m-b-10 f-w-600"><i class="ti-credit-card"></i> Hình thức thanh toán: </p>
                                            @if($dt->phuongthuc_thanhtoan = 1)
                                                <h6 class="m-b-10 f-w-600">chuyển khoản</h6>
                                            @else
                                                <h6 class="m-b-10 f-w-600">thanh toán trực tiếp</h6>
                                            @endif
                                    </div>
                            </div>
                            <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Địa chỉ cá nhân</h6>
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="m-b-10 f-w-600">địa chỉ</p>
                                    <h6 class="text-muted f-w-400">{{$dt->thanhpho->name_thanhpho}} - {{$dt->quanhuyen->name_quanhuyen}} - {{$dt->xaphuong->name_xaphuong}} - {{$dt->order_address}}</h6>
                                </div>
                                <hr>    
                            </div>
                            <!-- <ul class="social-link list-unstyled m-t-40 m-b-10">
                                <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true"><i class="mdi mdi-facebook feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="mdi mdi-twitter feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="mdi mdi-instagram feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                            </ul> -->
                        </div>
                        <hr>
                            <h4 class="social-link list-unstyled m-t-40 m-b-10">
                                <span class="fa fa-money" style="color:#66bb6a; font-size:20px; font-weight:bold">
                                    thanh toán : 
                                    <span>{{number_format($dt->donhang->tong_tien, 0, '.', '.')}} Đ</span>
                                </span> 
                            </h4>
                    @endforeach
                    </div>
                </div>
            </div>























            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Danh sách sản phẩm</strong>
                    </div>
                    
                    <div class="table-stats order-table ov-h">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>mã đơn hàng</th>
                                    <th>coupon</th>
                                    <th>Tên sản phẩm</th>
                                    <th>giá sản phẩm</th>
                                    <th>số lượng</th>
                                    <th>Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                            $i = 1;
                            @endphp
                                @foreach($chitiet as $hd) 
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>
                                            <span>{{$hd->donhang->order_code}}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-warning">
                                                @if($hd->product_coupon != null)
                                                    {{$hd->product_coupon}}
                                                @else
                                                    không có coupon
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            <span>{{$hd->product_name}}</span>
                                        </td>
                                        <td>
                                            <span>{{number_format($hd->product_price, 0, '.', '.')}} VNĐ</span>
                                        </td>
                                        <td>
                                            <span>{{$hd->product_quantity}}</span>
                                        </td>
                                        <td>
                                            <span>{{number_format($hd->product_price * $hd->product_quantity, 0, '.', '.')}}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <form method="POST" action="" id="form-delete">
                        @method('DELETE')
                        @csrf
                        </form>
                    </div> <!-- /.table-stats -->
                    
                </div>
            </div>
        </div>
    </div>
@stop()


@section('js')
<script src="{{asset('adm/assets/js/danhsach.js')}}"></script>


    <script>
        jQuery(document).ready(function($) {
            $('.btndelete').click(function(ev) {
                ev.preventDefault();
                var _href = $(this).attr('href');
                $('form#form-delete').attr('action',_href);
                if(confirm('bạn muốn xóa chứ ?')){
                    $('form#form-delete').submit();
                }
            });
        });
    </script>
@stop()