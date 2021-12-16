@extends('layouts.admin')
@section('css')
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
 <style>
     .form-trum{
        background-image: #fff;
         padding:10px 0px;
         border-radius:10px;
         box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
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
                        <h1>Danh sách quản lý Thú Cưng</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li>
                            <form action="">
                                    @csrf
                                <div class="form-group">
                                    <select name="sort" id="sort" class="form-control btn">
                                        <option value="{{Request::url()}}">Tất cả danh sách</option>
                                    @foreach($danhmuc as $loc)
                                    <option value="{{Request::url()}}?sort_by={{$loc->slug}}">{{$loc->name_nav}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </form>
                            </li>
                            <li><a class="btn bg-flat-color-6" style="color:#fff" id="deleteAllselected">Delete All</a></li>
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
                    <strong class="card-title mt-3">quản lý thú cưng</strong>
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
                            <th ><input type="checkbox" id="checkAll" /></th>
                            <th class="serial">#</th>
                            <th class="avatar">Tên bài đăng</th>
                            <th>slug</th>
                            <th>Trạng thái</th>
                            <th>xem chi tiết</th>
                            <th>Action</th>
                            <!-- <th>Quantity</th> -->
                            <!-- <th>Status</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach($data as $dt)
                            <tr id="sid{{$dt->id}}">
                            <td><input type="checkbox" class="checkboxclass" name="ids" value="{{$dt->id}}"></td>
                                <td class="serial">{{$i++}}</td>
                                <td class="avatar">
                                    <span>{{$dt->title}}</span>
                                </td>
                                <td>
                                    <span>{{$dt->slug_product}}</span>
                                </td>
                                <td>
                                    @if($dt->id_status == 1)
                                        <span class="badge badge-complete">thành công</span>
                                    @elseif ($dt->id_status == 2)
                                        <span class="badge badge-warning">chưa xét duyệt</span>
                                    @else
                                        <span class="badge badge-danger">đã hủy</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-pending" data-toggle="modal" data-target=".bd-example-modal-lg{{$dt->id}}">chi tiết <i class="fa fa-mail-reply"></i></span>
                                </td>
                                <td>
                                    <a href="{{route('qlthucung.edit',$dt->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                    <a href="{{route('qlthucung.destroy',$dt->id)}}" class="btn btn-sm btn-danger btndelete"><i class="fa fa-trash"></i></a>
                                </td>
                                <div class="modal fade bd-example-modal-lg{{$dt->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">chi tiết : {{$dt->id}} - {{$dt->title}}</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group form-gr-img">
                                                        @if(json_decode($dt->image))
                                                            @foreach(json_decode($dt->image) as $anhsp)
                                                            <img src="{{asset('uploads')}}/{{$anhsp}}" alt="" width="100%" height="200px">  
                                                            @endforeach
                                                        @else
                                                            <img src="{{asset('uploads')}}/{{$dt->image}}" alt="" width="100%" height="200px">  
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                    <textarea class="description_t" name="" cols="43" rows="9" disabled>{!! $dt->description !!}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group form-trum">
                                                        <div class="col-12">
                                                            <p><span class="text-info">Danh mục đăng :</span> {{$dt->typepost->name_type}}</p>
                                                            <p><span class="text-info">Thuộc menu :</span> {{$dt->navmenu->name_nav}}</p>
                                                            <p><span class="text-info">loại :</span> {{$dt->category->name}}</p>
                                                        </div>
                                                        <div class="col-12">
                                                            <p><span class="text-info">Giá :</span> {{number_format($dt->price, 0, '.', '.')}} VNĐ</p>
                                                            <p><span class="text-info">giá giảm :</span> {{number_format($dt->discount, 0, '.', '.')}} VNĐ</p>
                                                            <p><span class="text-info">trạng thái đăng :</span> {{$dt->hastrangthai->name_type}}</p>
                                                        </div>
                                                        <div class="col-12">
                                                            <p><span class="text-info">Tình trạng :</span> {{$dt->status}}</p>
                                                            <p><span class="text-info">Độ tuổi :</span> {{$dt->age}}</p>
                                                            <p><span class="text-info">Giống:</span> {{$dt->render}}</p>
                                                            <p><span class="text-info">lượt xem :</span> {{$dt->view}}</p>                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <!-- <button type="button" class="btn btn-primary">lưu</button> -->
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                                </div>
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
    <!-- jquery xóa tất cả -->
    <script>
        jQuery(document).ready(function($) {
            $('#checkAll').click(function(){
                $(".checkboxclass").prop('checked', $(this).prop('checked'));
            });
            $('#deleteAllselected').click(function(e){
                e.preventDefault();
                var allids = [];
                var _token = $('input[name="_token"]').val();
                $('input:checkbox[name=ids]:checked').each(function(){
                    allids.push($(this).val());
                });
                $.ajax({
                    url:'{{route('deletethucung')}}',
                    type:"delete",
                    data:{
                        _token:_token,
                        ids:allids
                    },
                    success:function(data){
                        $.each(allids,function(key,val){
                            $("#sid"+val).remove();
                        });
                    }
                });
            });
        });
    </script>
@stop()