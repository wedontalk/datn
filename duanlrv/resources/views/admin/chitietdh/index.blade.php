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
                                        h??nh th???c giao h??ng:
                                            @if($dt->phuongthuc_giaohang = 1)
                                                <span>Giao h??ng nhanh</span>
                                            @elseif($dt->phuongthuc_giaohang = 2)
                                                <span>Giao h??ng ti???t ki???m</span>
                                            @elseif($dt->phuongthuc_giaohang = 3)
                                                <span>VIETEL POST</span>
                                            @else
                                                <span>ninja V???n</span>
                                            @endif
                                    </h5>
                                </li>
                                <li>
                                    <h5><i class="ti-credit-card"></i> 
                                        H??nh th???c thanh to??n: 
                                            @if($dt->phuongthuc_thanhtoan = 1)
                                                <span>chuy???n kho???n</span>
                                            @else
                                                <span>thanh to??n tr???c ti???p</span>
                                            @endif
                                    </h5>
                                </li>
                            </ul>
                            <hr>
                        </div>
                        <div class="twt-write col-sm-12">
                            <label for="" style="font-weight: bold;">Ghi ch??</label>
                            <textarea placeholder="Kh??ng c?? ghi ch?? c???a kh??ch h??ng" rows="4" class="form-control t-text-area" disabled>{{$dt->order_note}}</textarea>
                        </div>
                        <footer class="twt-footer">
                            <p><i class="fa fa-map-marker"></i> {{$dt->thanhpho->name_thanhpho}} - {{$dt->quanhuyen->name_quanhuyen}} - {{$dt->xaphuong->name_xaphuong}} - {{$dt->order_address}}</p>
                            <hr>
                            <h4 style="font-weight:bold;">
                                <span class="fa fa-money" style="color:#66bb6a"></span> 
                                T???ng ti???n thanh to??n : 
                                <span>{{number_format($dt->donhang->tong_tien, 0, '.', '.')}} VN??</span>
                            </h4>
                            <br>
                        </footer>
                    </section>
                @endforeach
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Danh s??ch s???n ph???m</strong>
                    </div>
                    <div class="table-stats order-table ov-h">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>m?? ????n h??ng</th>
                                    <th>coupon</th>
                                    <th>T??n s???n ph???m</th>
                                    <th>gi?? s???n ph???m</th>
                                    <th>s??? l?????ng</th>
                                    <th>T???ng ti???n</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                            $i = 1;
                            @endphp
                                @foreach($sanpham as $hd)
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
                                                    kh??ng c?? coupon
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            <span>{{$hd->product_name}}</span>
                                        </td>
                                        <td>
                                            <span>{{number_format($hd->product_price, 0, '.', '.')}} VN??</span>
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
                if(confirm('b???n mu???n x??a ch??? ?')){
                    $('form#form-delete').submit();
                }
            });
        });
    </script>
@stop()