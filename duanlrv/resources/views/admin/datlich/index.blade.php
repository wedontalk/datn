@extends('layouts.admin')
@section('layout.css')
 <style>
     .namedm{
         font-size:15px;
         font-weight: bold;
         color: blue;
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
<div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Danh sách quản lý Đặt lịch</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <!-- <ol class="breadcrumb text-right">
                                    <li><a data-toggle="modal" class="btn bg-flat-color-1" style="color:#fff" data-target="#exampleModal" active>Thêm dịch vụ</a></li>
                                </ol> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="content">
        <div class="card cart-bg">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                        <strong class="card-title mt-3">Danh sách đặt lịch</strong>
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
                <table class="table">
                    <thead>
                        <tr>
                            <th class="serial">#</th>
                            <th class="serial">Tên người đặt</th>
                            <th class="serial">Tên cơ sở</th>
                            <th>Nhu cầu</th>
                            <th>thời gian đặt lịch</th>
                            <th>Trạng thái</th>
                            <th style="width:100px;">Chi Tiết</th>
                            <!-- <th style="width:100px;">Action</th> -->
                            <!-- <th>Quantity</th> -->
                            <!-- <th>Status</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach($data as $dt)
                            <tr>
                                <td class="serial">{{$i++}}</td>
                                <td>
                                    <span>{{$dt->user->name}}</span>
                                </td>
                                <td class="edit_name">
                                    <span>{{$dt->coso->name_coso}}</span>
                                </td>
                                <td>
                                    <span>{{$dt->nhucau->name_dichvu}}</span>
                                </td>
                                <td>
                                    <span>{{$dt->set_time}}</span>
                                </td>
                                <td>
                                    <select class="trangthai badge" data-id="{{$dt->id}}" 
                                        @if($dt->id_status == 1)
                                            style="background-image: linear-gradient( 135deg, #81FBB8 10%, #28C76F 100%);"
                                        @elseif($dt->id_status == 2)
                                            style="background-image: linear-gradient( 135deg, #97ABFF 10%, #123597 100%);"
                                        @else
                                            style="background-image: linear-gradient( 135deg, #F05F57 10%, #360940 100%);"
                                        @endif>
                                        @foreach($xetduyet as $xd)
                                            <option name="id_status" style="background: #000;" {{($xd->id == $dt->id_status) ? 'selected':'' }} id="item" value="{{$xd->id}}">{{$xd->name_type}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <a href="{{route('datlich.destroy',$dt->id)}}" class="badge badge-pending">chi tiết <i class="fa fa-mail-reply"></i></a>
                                </td>
                                <!-- <td>
                                    <a href="{{route('datlich.destroy',$dt->id)}}" class="btn btn-sm btn-danger btndelete"><i class="fa fa-trash"></i> Xóa</a>
                                </td> -->
                                
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

<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

<script>
    jQuery(document).ready(function($) {
        $('.btndelete').click(function(ev) {
            ev.preventDefault();
            var _href = $(this).attr('href');
            $('form#form-delete').attr('action',_href);
            alertify.confirm('Thông báo', 'Bạn có muốn xóa', function(confirm_xoa){ 
            if(confirm_xoa){
                $('form#form-delete').submit();
            }
            alertify.success('Bạn đã xóa') }
            , function(){ alertify.error('Bạn đã không xóa')});
        });
    });
</script>

<script>
        jQuery(document).ready(function($) {
            $(document).on('change', '.trangthai', function(){
                var id =$(this).data('id');
                var id_status = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:'{{route('updatedatlich')}}',
                    method:'post',
                    data:{id:id, id_status:id_status, _token: _token},
                    success: function(data) 
                    {
                        if(data == 'done')
                        {
                            alertify.success('bạn đã thay đổi trạng thái');
                        }
                        else
                        {
                            alertify.error('gặp lỗi rồi !');
                        }
                    }
                });
            });
        });
    </script>
@stop()