@extends('layouts.admin')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
@section('main')
<script>
        // jquery lấy ngày tháng năm
        jQuery(document).ready(function($) {    
            $( function() {
                $( "#datepickerbatdau" ).datepicker({
                    minDate: '0',
                    prevText:"Tháng trước",
                    nextText:"Tháng sau",
                    dateFormat:"yy-mm-dd",
                    dayNamesMin:["thứ 2", "thứ 3", "thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật"],
                });
            });
            $( function() {
                $( "#datepickerketthuc" ).datepicker({
                    minDate: '0',
                    prevText:"Tháng trước",
                    nextText:"Tháng sau",
                    dateFormat:"yy-mm-dd",
                    dayNamesMin:["thứ 2", "thứ 3", "thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật"],
                });
            });
        });
    </script>
<div class="content" style="background:#fff;">
    <div class="col-sm-12" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border-radius:15px">
        <div class="card-header">
            <center><strong class="card-title">form Thêm mã giảm giá</strong></center>
        </div>
        <form action="{{route('coupon.update',$coupon->id)}}" method="POST" role="form">
        @csrf @method('PUT')
         <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Tên mã giảm giá</label>
                    <input type="text" class="form-control @error('coupon_name') is-invalid @enderror" value="{{$coupon->coupon_name}}" name="coupon_name" placeholder="Nhập Tên danh mục">
                    @error('coupon_name')
                        <small class="form-text text-muted">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>ngày bắt đầu</label>
                    <input type="text" class="form-control @error('coupon_date_start') is-invalid @enderror" value="{{$coupon->coupon_date_start}}" id="datepickerbatdau" name="coupon_date_start" placeholder="Nhập ngày bắt đầu">
                    @error('coupon_date_start')
                        <small class="form-text text-muted">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>ngày Kết thúc</label>
                    <input type="text" class="form-control @error('coupon_date_end') is-invalid @enderror" value="{{$coupon->coupon_date_end}}" id="datepickerketthuc" name="coupon_date_end" placeholder="Nhập ngày kết thúc">
                    @error('coupon_date_end')
                        <small class="form-text text-muted">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>số lượng</label>
                    <input type="number" class="form-control @error('coupon_qty') is-invalid @enderror" value="{{$coupon->coupon_qty}}" name="coupon_qty" placeholder="Nhập số lượng coupon">
                    @error('coupon_qty')
                        <small class="form-text text-muted">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group col-sm-6">
                <label for="selecttien">giảm theo</label>
                <select class="form-control @error('coupon_condition') is-invalid @enderror"  id="selecttien" name="coupon_condition">
                <option value="0">-- Giảm giá theo -- </option>
                <option value="1" {{($coupon->coupon_condition == 1) ? 'selected':''}}>theo %</option>
                <option value="2" {{($coupon->coupon_condition == 2) ? 'selected':''}}>theo giá tiền</option>
                </select>
                @error('coupon_condition')
                    <small class="form-text text-muted">{{$message}}</small>
                @enderror
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>số giảm</label>
                    <input type="number" class="form-control sogiam @error('coupon_number') is-invalid @enderror" value="{{$coupon->coupon_number}}" name="coupon_number" placeholder="nhập số tiền cần giảm">
                    @error('coupon_number')
                        <small class="form-text text-muted">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>code coupon</label>
                    <input type="text" class="form-control @error('coupon_code') is-invalid @enderror" value="{{$coupon->coupon_code}}" name="coupon_code" placeholder="Nhập code coupon">
                    @error('coupon_code')
                        <small class="form-text text-muted">{{$message}}</small>
                    @enderror
                </div>
            </div>

         </div>
         <div class="form-group">
            <label for="exampleFormControlSelect1">Trạng thái phê duyệt</label>
            <select class="form-control" id="exampleFormControlSelect1" name="id_status">
                <option value="1" {{($coupon->id_status == 1) ? 'selected':''}}>Thành công</option>
                <option value="2" {{($coupon->id_status == 2) ? 'selected':''}}>chưa xét duyệt</option>
            </select>
        </div>
        <br>
        <br>
        <div class="form-group">
            <button type="submit" class="btn btn-outline-success btn-sm form-control"><i class="fa fa-magic"></i>&nbsp; submit</button>
        </div>
        <br>
        </form>
    </div>
</div>
@stop()

@section('js')
<script src="{{asset('adm/assets/js/slug.js')}}"></script>
<script>
    jQuery(document).ready(function($){
        $('#selecttien').on('change', function(){
            var select = $(this).val();
            if(select == 0){
                var sogiam = $('.sogiam').attr('disabled', true);
            }else if(select == 1){
                var sogiam = $('.sogiam').attr('placeholder', 'giảm theo %');
                var sogiam = $('.sogiam').attr('disabled', false);
            }else{
                var sogiam = $('.sogiam').attr('placeholder', 'giảm theo giá tiền');
                var sogiam = $('.sogiam').attr('disabled', false);  
            }
        })
    });
</script>
@stop