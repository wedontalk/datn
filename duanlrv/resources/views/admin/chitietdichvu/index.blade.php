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
                                <h1>Danh sách quản lý dịch vụ</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a data-toggle="modal" class="btn bg-flat-color-1" style="color:#fff" data-target="#exampleModal" active>Thêm dịch vụ</a></li>
                                </ol>
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
                        <strong class="card-title mt-3">Danh sách dịch vụ</strong>
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
                <table id="loadjs" class="table">
                    <thead>
                        <tr>
                            <th class="serial">#</th>
                            <th class="serial">Tên dịch vụ</th>
                            <th>Trạng thái</th>
                            <th style="width:100px;">Action</th>
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
                                <td class="edit_name" contenteditable data-id='{{$dt['id']}}' style="width:800px">
                                    <span>{{$dt['name_dichvu']}}</span>
                                </td>
                                <td>
                                    @if($dt['id_status'] == 1)
                                        <span class="badge badge-complete">thành công</span>
                                    @elseif ($dt['id_status'] == 2)
                                        <span class="badge badge-warning">đợi xét duyệt</span>
                                    @else
                                        <span class="badge badge-danger">đã hủy</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('chitietdichvu.destroy',$dt['id'])}}" class="btn btn-sm btn-danger btndelete"><i class="fa fa-trash"></i> Xóa</a>
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


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><strong class="modal-title" id="exampleModalLabel">form thêm dịch vụ cơ sở</strong></center>
        <form id="formne" method="POST" enctype="multipart/form-data">
      </div>
      <div class="modal-body">
            <div class="form-group">
                <label>nhập tên dịch vụ</label>
                <input type="text"  name="name_dichvu" id="name_dichvu" class="form-control" placeholder="tên dịch vụ">
                @error('name_dichvu')
                    <small class="form-text text-muted">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>trạng thái</label>
                <select class="form-control" name="id_status" id="id_status">
                    <option value='1'>Thành công</option>
                    <option value='2'>Đợi xét duyệt</option>
                    <option value='3'>Đã Hủy</option>
                </select>
            </div>
      </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
            <button type="button" class="btn btn-primary" id="submitajax">Lưu</button>
        </div>
      </form>
    </div>
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
        $(document).on('click', '#submitajax', function(){
            var name = $('#name_dichvu').val();
            var trangthai = $('#id_status').val();
            var dis = $(this).data('dismiss');
            var _token = $('input[name="_token"]').val();  
            $.ajax({
                url:'{{route('chitietdichvu.store')}}', 
                method:'post',
                data:{
                    name: name,trangthai: trangthai,dis:dis,_token:_token,
                },
                success: function(data) 
                {
                    if(data == 'done')
                    {
                        alertify.success('thành công !');
                        window.location.reload(true);
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
    
    <script>
    jQuery(document).ready(function($) {
        // $('.edit_name').dblclick(function(){
        //    var test = $(this).attr('contenteditable');
        //    if (test == 'false') {
        //         $(this).attr('contenteditable','true');
        //     }
        //     else {
        //         $(this).attr('contenteditable','false');
        //     }
        // });
        $(document).on('blur','.edit_name', function(){
            var id = $(this).data('id');
            var text_dichvu = $(this).text();
            var _token = $('input[name="_token"]').val();
            if(text_dichvu == ''){
                alertify.warning('không được rỗng !!!');
            }
            $.ajax({
                url:'{{url('/admin/updateajax')}}', 
                method:'post',
                data:{
                    id: id,text_dichvu: text_dichvu,_token:_token,
                },
                success: function(data) 
                {
                    if(data == 'done')
                    {
                        $(".content").load();
                        alertify.success('cập nhật thành công !');
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