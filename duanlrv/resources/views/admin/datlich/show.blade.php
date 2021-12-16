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
                                    @if($dt->user->avatar == null) 
                                        {{asset('uploads/avatar/Anh-avatar-123123123.jpg')}} 
                                    @else 
                                        {{asset('uploads')}}/{{$dt->user->avatar}} 
                                    @endif">
                                </a>
                                <div class="media-body">
                                    <h2 class="text-white display-6">{{$dt->user->name}}</h2>
                                    <p class="text-light">{{$dt->user->email}}</p>
                                </div>
                            </div>



                        </div>
                        <div class="category-test">
                            <ul>
                            <li class="active">
                                    <h5><i class="fa fa-comment"></i> Name: <span>{{$dt->name}}</span></h5>
                                </li>
                                <li >
                                    <h5><i class="fa fa-phone"></i> Phone: <span>{{$dt->phone}}</span></h5>
                                </li>
                                <li>
                                    <h5><i class="fa fa-envelope-o"></i> Email: <span>{{$dt->email}}</span></h5>
                                </li>
                                <li>
                                    <h5><i class="fa fa-hospital-o"></i> Địa Chỉ: <span>{{$dt->address}}</span></h5>
                                </li>
                            </ul>
                            <hr>
                        </div>
                        <div class="twt-write col-sm-12">
                            <label for="" style="font-weight: bold;">Ghi chú</label>
                            <textarea placeholder="Không có ghi chú của khách hàng" rows="4" class="form-control t-text-area" disabled>{{$dt->ghichu}}</textarea>
                        </div>
                        <footer class="twt-footer">
                            <hr>
                            <!-- <h4 style="font-weight:bold;">
                                <span class="fa fa-money" style="color:#66bb6a"></span> 
                                Tổng tiền thanh toán : 
                                <span></span>
                            </h4> -->
                            <br>
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cơ sở</th>
                                    <th>Dịch vụ</th>
                                    <th>Ngày Khám</th>
                                    <th>Thời gian Khám</th>
                                    <th>Thời gian đặt hàng</th>
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
                                            <span>{{$hd->coso->name_coso}}</span>
                                        </td>
                                        <td>
                                            <span>{{$hd->nhucau->name_dichvu}}</span>
                                        </td>
                                        <td>
                                            <span>{{$hd->date}}</span>
                                        </td>
                                        <td>
                                            <span>{{$hd->hour}}</span>
                                        </td>
                                        <td>
                                            <span>{{$hd->set_time}}</span>
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
                if(confirm('bạn muốn xóa chứ ?')){
                    $('form#form-delete').submit();
                }
            });
        });
    </script>
@stop()