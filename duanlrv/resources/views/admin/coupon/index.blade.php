@extends('layouts.admin')
@section('css')
 <style>
     .pagination{
         padding: 0;
     }
 </style>
 <style>
     .pagination{
         padding: 0;
     }
     /* You can remove these code below*/
  :root {
    --primary: #08aeea;
    --secondary: #13D2B8;
    --purple: #bd93f9;
    --pink: #ff6bcb;
    --blue: #8be9fd;
    --gray: #333;
    --font: "Poppins", sans-serif;
    --gradient: linear-gradient(40deg, #ff6ec4, #7873f5);
    --shadow: 0 0 15px 0 rgba(0,0,0,0.05);
  }*{box-sizing:border-box;}input,button,textarea{border:0;outline:none;}
  /* Main code */
  
          .pagination {
            display: flex;
            justify-content: left;
          }
          .page-item {
            margin: 0 0.5rem;
            font-size: 1.2rem;
            color: #999;
            cursor: pointer;
            transition: all 0.2s linear;
          }
          .page-item.active .page-link{
            background-image: linear-gradient( 135deg, #90F7EC 10%, #32CCBC 100%);
            background-color:transparent;
            border-radius:5px;
            padding: 5px 10px;
          }
          .pagi-item.is-disabled {
            opacity: 0.5;
            cursor: not-allowed;
          }
          .pagi-item:hover,
          .pagi-item.is-active {
            color: var(--secondary);
          }
          .page-link{
            padding:5px 10px;
            border:none;
          }
 </style>
@endsection
@section('main')
    <div class="content">
        <div class="card cart-bg">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                    <strong class="card-title mt-3">danh sách mã giảm giá</strong>
                    </div>
                    <div class="col-sm-6">
                        <form class="form-inline justify-content-end" action="" method="GET" role="form">
                        <div class="input-group input-group-sm">
                            <input class="form-control" type="search" placeholder="tìm kiếm..." aria-label="Search" name="key">
                            <div class="input-group-append">
                            <button class="btn btn-success" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            <x-alert></x-alert>
            <div class="table-stats order-table ov-h">
                <table class="table ">
                    <thead>
                        <tr>
                            <th class="serial">#</th>
                            <th class="avatar">mã giảm giá</th>
                            <th>code mã giảm giá</th>
                            <th>số lượng</th>
                            <th>giảm giá</th>
                            <th>tình trạng coupon</th>
                            <th>ngày bắt đầu</th>
                            <th>ngày kết thúc</th>
                            <th>trạng thái</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i =1;
                        @endphp
                        @foreach($data as  $dt)
                            <tr>
                                <td id="ids">{{$i++}}</td>
                                <td>
                                    <span>{{$dt->coupon_name}}</span>
                                </td>
                                <td>
                                    <span>{{$dt->coupon_code}}</span>
                                </td>
                                <td>
                                    <span>{{$dt->coupon_qty}}</span>
                                </td>
                                <td>
                                        @if($dt->coupon_condition == 1)
                                        <span>{{$dt->coupon_number}} %</span>
                                        @else
                                        <span>{{$dt->coupon_number}}</span>
                                        @endif
                                </td>
                                <td>
                                    <span>
                                        @if($dt->coupon_condition == 1)
                                         giảm %
                                        @else
                                         giảm tiền
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <span>{{$dt->coupon_date_start}}</span>
                                </td>
                                <td>
                                    <span id="ngayketthuc" data-ngayketthuc="{{$dt->coupon_date_end}}">{{$dt->coupon_date_end}}</span>
                                </td>
                                <td>
                                    @if($dt->id_status == 1)
                                    <a href=""><span class="badge badge-complete">Còn hiệu lực</span></a>
                                    @elseif($dt->id_status == 2)
                                    <a href=""><span class="badge badge-danger">Hết hiệu lực</span></a>
                                    @endif
                                </td>
                                <td style="width:100px">
                                    <a href="{{route('coupon.edit',$dt->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                    <a href="{{route('coupon.destroy',$dt->id)}}" class="btn btn-sm btn-danger btndelete"><i class="fa fa-trash"></i></a>
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
            <div class="">{{$data->appends(request()->all())->links()}}</div>
        </div>
    </div>
@stop()


@section('js')
<script src="{{asset('adm/assets/js/danhsach.js')}}"></script>
<script src="{{asset('adm/assets/js/alertne.js')}}"></script>
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
    <script>
    jQuery(document).ready(function($) {
            var _token = $('input[name="_token"]').val();
            var ketthuc = $('#ngayketthuc').text();
            var ids = $('#ids').text();
            $.ajax({
                url:'{{url('/admin/coupon')}}',
                method:"post",
                dataType:"JSON",
                data:{ids:ids , ketthuc:ketthuc , _token:_token},

                success:function(data)
                {
                    if(data == 'done')
                    {
                        alertify.success('thành công');
                    }
                    else
                    {
                        alertify.error('thất bại');
                    }
                }
            });
    });
    </script>
@stop()