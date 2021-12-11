@extends('layouts.admin')
@section('css')
 <style>
     .form-trum{
        background-image: linear-gradient( 135deg, #CE9FFC 10%, #7367F0 100%);
         padding:10px 0px;
         border-radius:10px;
         box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
     }
     .category-test{
         padding: 10px;
         list-style: none;
     }
     .category-test ul{
         padding: 5px;
         list-style: none;
     }
     .category-test ul li{
         padding: 5px 0px;
         list-style: none;
     }
     .category-test h5{
         font-weight: bold;
         color: #f07067;
     }
     .category-test span{
         color: #1f1f1f;
         font-weight: 100;
     }
     .category-test i{
         color:#1f1f1f  ;
         font-weight: 100;
     }
     .twt-footer{
         color: #1f1f1f;
     }
     .badge-warning{
        border-radius:25px;
     }
 </style>
@endsection
@section('main')
<style>
    .themedep{
        background-image: url({{asset('uploads/themes/themenendep.png')}});
    }
</style>
    <div class="content">
        <div class="row">
            <div class="col-md-4">
                @foreach($chitiet as $dt)
                    <section class="card">
                        <div class="twt-feed themedep">
                            <div class="corner-ribon black-ribon">
                                <i class="fa fa-twitter"></i>
                            </div>
                            <div class="fa fa-twitter wtt-mark"></div>
                            <div class="media">
                                <a href="#">
                                    <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="
                                    @if($dt->dsuser->avatar == null) 
                                        {{asset('uploads/avatar/Anh-avatar-123123123.jpg')}} 
                                    @else 
                                        {{asset('uploads')}}/{{$dt->dsuser->avatar}} 
                                    @endif">
                                </a>
                                <div class="media-body">
                                    <h2 class="text-white display-6">{{$dt->order_name}}</h2>
                                    <p class="text-light">{{$dt->order_email}}</p>
                                </div>
                            </div>



                        </div>
                        <div class="category-test">
                            <ul>
                                <li class="active">
                                    <h5><i class="fa fa-phone"></i> Phone: <span>{{$dt->order_phone}}</span></h5>
                                </li>
                                <li>
                                    <h5><i class="fa fa-envelope-o"></i> Email: <span>{{$dt->order_email}}</span></h5>
                                </li>
                                <li>
                                    <h5><i class="fa fa-truck"></i> 
                                        hình thức giao hàng:
                                            @if($dt->phuongthuc_giaohang = 1)
                                                <span>Giao hàng nhanh</span>
                                            @elseif($dt->phuongthuc_giaohang = 2)
                                                <span>Giao hàng tiết kiệm</span>
                                            @elseif($dt->phuongthuc_giaohang = 3)
                                                <span>VIETEL POST</span>
                                            @else
                                                <span>ninja Vận</span>
                                            @endif
                                    </h5>
                                </li>
                                <li>
                                    <h5><i class="ti-credit-card"></i> 
                                        Hình thức thanh toán: 
                                            @if($dt->phuongthuc_thanhtoan = 1)
                                                <span>chuyển khoản</span>
                                            @else
                                                <span>thanh toán trực tiếp</span>
                                            @endif
                                    </h5>
                                </li>
                                <hr>
                                <li>
                                    <h4 style="font-weight:bold;">
                                        <span class="fa fa-money" style="color:#66bb6a"></span> 
                                        Tổng tiền thanh toán : 
                                        <span>{{$dt->donhang->tong_tien}} VNĐ</span>
                                    </h4>
                                </li>
                            </ul>
                        </div>
                        <div class="twt-write col-sm-12">
                            <label for="" style="font-weight: bold;">Ghi chú</label>
                            <textarea placeholder="Không có ghi chú của khách hàng" rows="4" class="form-control t-text-area" disabled>{{$dt->order_note}}</textarea>
                        </div>
                        <footer class="twt-footer">
                            <a href="#"><i class="fa fa-map-marker"></i></a>
                            {{$dt->thanhpho->name_thanhpho}} - {{$dt->quanhuyen->name_quanhuyen}} - {{$dt->xaphuong->name_xaphuong}} - {{$dt->order_address}}
                        </footer>
                    </section>
                @endforeach
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Danh sách sản phẩm</strong>
                    </div>
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
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
                            $total = 0;  
                            @endphp
        
                                @foreach($sanpham as $hd)
        
                                @php
                                        $subtotal = $hd->product_price*$hd->product_quantity;
                                        $total += $subtotal;
                                @endphp
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>
                                            <span>{{$hd->order_code}}</span>
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
                        <!-- <div class="col-sm-6">
                            <div class="form-group">
                                <strong>Tổng tiền thanh toán: <span style="color:#fff">{{number_format($total, 0, '.', '.')}} VNĐ</span></strong>
                            </div>
                        </div> -->
                        <form method="POST" action="" id="form-delete">
                        @method('DELETE')
                        @csrf
                        </form>
                    </div> <!-- /.table-stats -->
                    <div class="">{{$chitiet->appends(request()->all())->links()}}</div>
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