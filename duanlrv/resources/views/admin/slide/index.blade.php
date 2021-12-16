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
@endsection
@section('main')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Danh sách quản lý slide website</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a class="btn bg-flat-color-6" style="color:#fff" id="deleteAllselected">Delete All</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="content">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                    <strong class="card-title mt-3">danh sách slide website</strong>
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
                            <th class="avatar">image</th>
                            <th>tiêu đề</th>
                            <th>Thông tin</th>
                            <th>Khuyến mãi</th>
                            <th>link</th>
                            <th>ẩn hiện</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @php
                        $i = 1;
                    @endphp
                    <tbody>
                        @foreach($data as $dt)
                            <tr id="sid{{$dt->id}}">
                                <td><input type="checkbox" class="checkboxclass" name="ids" value="{{$dt->id}}"></td>
                                <td class="serial">{{$i++}}</td>
                                <td class="avatar">
                                    <span><img src="{{asset('uploads')}}/{{$dt->image}}" alt="{{$dt->image}}" height="50px"></span>
                                </td>
                                <td>
                                    <span>{{$dt->tieu_de}}</span>
                                </td>
                                <td>
                                    <span>{{$dt->thong_tin}}</span>
                                </td>
                                <td>
                                    <span>{{$dt->khuyen_mai}}</span>
                                </td>
                                <td>
                                    <span>{{$dt->link}}</span>
                                </td>
                                <td>
                                    @if($dt->hidden == 0)
                                        <span class="badge badge-danger">slide Ẩn</span>
                                    @else
                                        <span class="badge badge-complete">slide Hiện</span>
                                    @endif
                                </td>
                                <td style="width:100px">
                                    <a href="{{route('slide.edit',$dt->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                    <a href="{{route('slide.destroy',$dt->id)}}" class="btn btn-sm btn-danger btndelete"><i class="fa fa-trash"></i></a>
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
                    url:'{{route('deleteslide')}}',
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