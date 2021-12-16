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
        <center><strong class="card-title"><h3>FORM THÊM CƠ SỞ</h3></strong></center>
    </div>
<form action="{{route('qldichvu.store')}}" method="POST" enctype="multipart/form-data">
@csrf
<div class="row">
<div class="col-7">
    <div class="col-sm-12 " style="background-color:#fff; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border-radius:5px; padding:20px 10px">
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-3 col-form-label">Tên cơ sở</label>
            <div class="col-sm-9">
                <input type="text" class="form-control @error('name_coso') is-invalid @enderror" name="name_coso"  placeholder="Nhập Tên cơ sở">
                @error('name_coso')
                    <small class="form-text text-muted">{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="thoigianhoatdong" class="col-sm-3 col-form-label">Thời gian hoạt động</label>
            <div class="col-sm-9">
                <input type="time" step="3600" min="00:00" max="24:00" class="form-control @error('time_hoatdong') is-invalid @enderror" name="time_hoatdong"  placeholder="nhập thời gian hoạt động">
                @error('time_hoatdong')
                    <small class="form-text text-muted">{{$message}}</small>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="thoigianketthuc" class="col-sm-3 col-form-label">Thời gian kết thúc</label>
            <div class="col-sm-9">
                <input type="time" step="3600" min="00:00" max="24:00" class="form-control @error('time_ketthuc') is-invalid @enderror" name="time_ketthuc"  placeholder="nhập thời gian kết thúc">
                @error('time_ketthuc')
                    <small class="form-text text-muted">{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="thoigianketthuc" class="col-sm-3 col-form-label">Số điện thoại</label>
            <div class="col-sm-9">
                <input type="text" class="form-control @error('phone_coso') is-invalid @enderror" name="phone_coso"  placeholder="nhập số điện thoại" >
                @error('phone_coso')
                    <small class="form-text text-muted">{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Hình ảnh(*)</label>
            <div class="col-sm-9 input-group">
                <input type="text" id="image" name="image" class="form-control @error('image') is-invalid @enderror" placeholder="thêm hình ảnh">
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
            <label class="col-sm-5 col-form-label">Tỉnh - Thành Phố</label>
            <div class="col-sm-7">
                <select class="form-control choose input-sm city @error('id_province') is-invalid @enderror" name="id_province" id="city">
                    <option value="">-----{{__('Tỉnh - Thành phố')}}-----</option>
                    @foreach($thanhpho as $t)
                    <option class="op-text" value="{{$t->matp}}">{{$t->name_thanhpho}}</option>
                    @endforeach
                </select>
                @error('id_province')
                    <small class="form-text text-muted">{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-5 col-form-label">Quận - Huyện</label>
            <div class="col-sm-7">
                <select class="form-control input-sm choose province @error('id_quanhuyen') is-invalid @enderror" name="id_quanhuyen" id="province">
                    <option class="op-text">-----{{__('Chọn quận huyện')}}-----</option>
                </select>
                @error('id_quanhuyen')
                    <small class="form-text text-muted">{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-5 col-form-label">Xã - phường</label>
            <div class="col-sm-7">
                <select class="form-control input-sm wards @error('id_xaphuong') is-invalid @enderror" name="id_xaphuong" id="wards">
                    <option class="op-text">-----{{__('Chọn xã phường')}}-----</option>
                </select>
                @error('id_xaphuong')
                    <small class="form-text text-muted">{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-5 col-form-label">địa chỉ cụ thể</label>
            <div class="col-sm-7">
                <input type="text" class="form-control @error('address_cuthe') is-invalid @enderror" name="address_cuthe"  placeholder="địa chỉ cụ thể (địa chỉ nhà)" >
                @error('address_cuthe')
                    <small class="form-text text-muted">{{$message}}</small>
                @enderror
            </div>
        </div>
    </div>
    <!--mô tả -->
    <br>
    <div class="col-sm-12" style="background-color:#fff; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border-radius:5px;padding:5px 10px">
        <div class="form-group row">
            <div class="col-sm-12">
                <textarea class="form-control" name="description" id="content" rows="2" cols="5"></textarea>
            </div>
        </div>
    </div>
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
            placeholder:'nhập mô tả...',
            height:100,
        });
    });
</script>

<script type="">
jQuery(document).ready(function($) {

    $('.choose').on('change', function() {
        var action = $(this).attr('id');
        var ma_id = $(this).val();
        var _token = $('input[name="_token"]').val();

        var result = '';

        if (action == 'city') {
            result = 'province';
        }
        else {
            result = 'wards';
        }
        $.ajax({
            url: '{{url('/admin/select-thanhpho')}}',
            method: 'post',
            data: {action: action, ma_id: ma_id, _token: _token},
            success: function(data) {
                $('#' + result).html(data);
            }
        });
    });
});
</script>

@stop()