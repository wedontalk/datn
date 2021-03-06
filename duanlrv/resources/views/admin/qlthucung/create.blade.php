@extends('layouts.admin')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('adm/assets/css/lib/chosen/chosen.min.css')}}">
<style>
    .content{
        background:#fff;
    }
    /* .btn-text-ne{
        position: absolute;
        bottom:10;
        right: 10px;
    } */

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
  
        .button-effect {
          padding: 1rem 2rem;
          border: 0;
          color: white;
          background-image: linear-gradient( 135deg, #90F7EC 10%, #32CCBC 100%);
          background-color: var(--primary);
          text-transform: uppercase;
          transition: padding 0.25s linear;
          text-align: center;
          position: relative;
        }
        .button-effect:hover {
          padding-right: 5rem;
        }
        .button-effect i {
          transition: 0.25s ease;
          opacity: 0;
          position: absolute;
          top: 50%;
          right: 2rem;
          transform: translateY(-50%);
        }
        .button-effect:hover i {
          transform: translateY(-50%);
          opacity: 1;
        }
</style>
@stop()
@section('main')
<div class="content">
    <div class="card-header">
        <center><strong class="card-title"><h3>FORM Thêm Thú Cưng</h3></strong></center>
    </div>
<form action="{{route('qlthucung.store')}}" method="POST" enctype="multipart/form-data">
@csrf
<div class="row">
<div class="col-7">
    <div class="col-sm-12 " style="background-color:#fff; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border-radius:5px; padding:20px 10px">
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-3 col-form-label">Tiêu đề thú cưng</label>
            <div class="col-sm-9">
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="name"  placeholder="Nhập tiêu đề thú cưng">
                @error('title')
                    <small class="form-text text-muted">{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="thoigianhoatdong" class="col-sm-3 col-form-label">Giá thú cưng</label>
            <div class="col-sm-9">
                <input type="text" class="form-control @error('price') is-invalid @enderror" name="price"  placeholder="nhập giá thú cưng">
                @error('price')
                    <small class="form-text text-muted">{{$message}}</small>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="thoigianketthuc" class="col-sm-3 col-form-label">Giá khuyến mãi</label>
            <div class="col-sm-9">
                <input type="text" class="form-control @error('discount') is-invalid @enderror" name="discount"  placeholder="nhập giá khuyến mãi">
                @error('discount')
                    <small class="form-text text-muted">{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="thoigianketthuc" class="col-sm-3 col-form-label">Số lượng thú cưng</label>
            <div class="col-sm-9">
                <input type="text" class="form-control @error('quantity') is-invalid @enderror" name="quantity"  placeholder="nhập số lượng thú cưng" >
                @error('quantity')
                    <small class="form-text text-muted">{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Độ tuổi thú cưng</label>
            <div class="col-sm-9">
                <input type="text" class="form-control @error('age') is-invalid @enderror" name="age"  placeholder="nhập Độ tuổi thú cưng" >
                @error('age')
                    <small class="form-text text-muted">{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Tình trạng sức khỏe</label>
            <div class="col-sm-9">
                <input type="text" class="form-control @error('status') is-invalid @enderror" name="status"  placeholder="nhập Tình trạng sức khỏe" >
                @error('status')
                    <small class="form-text text-muted">{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Giống thú cưng</label>
            <div class="col-sm-9">
                <input type="text" class="form-control @error('render') is-invalid @enderror" name="render"  placeholder="nhập Giống thú cưng" >
                @error('render')
                    <small class="form-text text-muted">{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Hình ảnh(*)</label>
            <div class="col-sm-9 input-group">
                <input type="text" id="image" name="image[]" class="form-control @error('image') is-invalid @enderror" placeholder="thêm hình ảnh">
                <div class="input-group-append">
                    <button class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg" type="button"><i class="fa fa-folder"></i></button>
                </div>
                @error('image')
                    <small class="form-text text-muted">{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="xetduyet" class="col-sm-3 col-form-label">Xét duyệt trạng thái</label>
            <div class="col-sm-9">
                <select class="form-control" name="id_status">
                    @foreach($xetduyet as $xet)
                    <option class="op-text" value="{{$xet->id}}">{{$xet->name_type}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br>
        <div class="form-group" style="padding:0.2rem 0; background:white">
            <button class="button-effect btn-text-ne ">nhập thông tin <i class="fa fa-long-arrow-right"></i></button>
        </div>
    </div>
</div>
<!-- nhập thông tin địa chỉ -->
<div class=" col-5">
    <div class="col-sm-12" style="background-color:#fff; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border-radius:5px; padding:5px 10px">
        <div class="form-group row">
            <label class="col-sm-5 col-form-label">Menu thú cưng</label>
            <div class="col-sm-7">
                <select class="form-control choose input-sm city  @error('id_menu') is-invalid @enderror" name="id_menu" id="city">
                    <option value="">-----{{__('Menu thú cưng')}}-----</option>
                    @foreach($text as $t)
                    <option class="op-text" value="{{$t->id}}">{{$t->name_nav}}</option>
                    @endforeach
                </select>
                @error('id_menu')
                    <small class="form-text text-muted">{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-5 col-form-label">Danh mục thú cưng</label>
            <div class="col-sm-7">
                <select class="form-control input-sm choose province @error('id_category') is-invalid @enderror" name="id_category" id="province">
                    <option class="op-text" value="">-----{{__('Danh mục thú cưng')}}-----</option>
                </select>
                @error('id_category')
                    <small class="form-text text-muted">{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
                <textarea class="form-control" name="description" id="content" rows="2" cols="5"></textarea>
            </div>
        </div>
    </div>
    <!--mô tả -->
</div>
</div>

</form>
</div>

<!-- modal thêm hình -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="max-width:96% !important;">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">danh sách hình ảnh</h5>
        </div>
        <div class="modal-body">
        <iframe src="{{url('/file/dialog.php?field_id=image')}}" width="100%" height="500px" style="over-flow-y:auto" frameborder="0"></iframe>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>


@stop

@section('js')
<script src="{{asset('adm/assets/js/slug.js')}}"></script>

  <!--summernote-->
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>  
  <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
  <script src="{{asset('adm/assets/js/lib/chosen/chosen.jquery.min.js')}}"></script>
<script>
    jQuery(document).ready(function($) {
        // Summernote
        $('#content').summernote({
            height:300,
        });
    });
</script>

<script type="">
jQuery(document).ready(function($) {

    $('.choose').on('change', function() {
        var action = $(this).attr('id');
        var ma_id = $(this).val();
        var _token = $('input[name="_token"]').val();

        // alert(action);
        // alert(ma_id);
        // alert(_token);
        var result = '';

        if (action == 'city') {
            result = 'province';
        }
        //  else {
        //     result = 'wards';
        // }
        $.ajax({
            url: '{{url('/admin/select-delivery')}}',
            method: 'post',
            data: {action: action, ma_id: ma_id, _token: _token},
            success: function(data) {
                $('#' + result).html(data);
            }
        });
    });
});
</script>


<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#file').on('click', function(){
            var error = '';
            var files = $('#file')[0].files;

            if(files.length>1){
                error += '<p style="color:red;">tối đa chọn 5 hình</p>';
            }else if(files.length == ""){
                error += '<p style="color:red;">không được bỏ trống gallery</p>';
            }else if(files.size > 2000000){
                error+='<p style="color:red;">tối đa không quá 2MB</p>';
            }

            if(error == ''){

            }else{
                $('#file').val('');
                $('#error_gallery').html('<strong">'+error+'</strong>');
                return false;
            }

        });
    });
</script>

@stop()