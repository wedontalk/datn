@extends('layouts.admin')
@section('main')
<div class="content" style="background:#fff;">
    <div class="col-sm-12" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border-radius:15px">
        <div class="card-header">
            <center><strong class="card-title">form sửa mã giảm giá</strong></center>
        </div>
        <form action="{{route('coupon.update',$coupon->id)}}" method="POST" enctype="multipart/form-data">
         @csrf 
         @method('PUT')
         <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Tên mã giảm giá</label>
                    <input type="text" class="form-control @error('coupon_name') is-invalid @enderror" name="coupon_name" value="{{$coupon->coupon_name}}" placeholder="Nhập Tên mã giảm giá">
                    @error('coupon_name')
                        <small class="form-text text-muted">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>ngày bắt đầu</label>
                    <input type="date" class="form-control @error('coupon_date_start') is-invalid @enderror" name="coupon_date_start" value="{{$coupon->coupon_date_start}}" placeholder="Nhập Tên danh mục">
                    @error('coupon_date_start')
                        <small class="form-text text-muted">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>ngày Kết thúc</label>
                    <input type="date" class="form-control @error('coupon_date_end') is-invalid @enderror" name="coupon_date_end" value="{{$coupon->coupon_date_end}}" placeholder="Nhập Tên danh mục">
                    @error('coupon_date_end')
                        <small class="form-text text-muted">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>số lượng</label>
                    <input type="text" class="form-control @error('coupon_qty') is-invalid @enderror" name="coupon_qty" value="{{$coupon->coupon_qty}}" placeholder="Nhập Tên danh mục">
                    @error('coupon_qty')
                        <small class="form-text text-muted">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group col-sm-6">
                <label for="exampleFormControlSelect1">giảm theo</label>
                <select class="form-control @error('coupon_condition') is-invalid @enderror" id="exampleFormControlSelect1" name="coupon_condition">
                <option value="1">theo %</option>
                <option value="2">theo giá tiền</option>
                </select>
                @error('coupon_condition')
                    <small class="form-text text-muted">{{$message}}</small>
                @enderror
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>số giảm</label>
                    <input type="text" class="form-control @error('coupon_number') is-invalid @enderror" name="coupon_number" value="{{$coupon->coupon_number}}" placeholder="Nhập Tên danh mục">
                    @error('coupon_number')
                        <small class="form-text text-muted">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>code coupon</label>
                    <input type="text" class="form-control @error('coupon_code') is-invalid @enderror" name="coupon_code" value="{{$coupon->coupon_code}}" placeholder="Nhập Tên danh mục">
                    @error('coupon_code')
                        <small class="form-text text-muted">{{$message}}</small>
                    @enderror
                </div>
            </div>

         </div>
         <div class="form-group">
            <label for="exampleFormControlSelect1">Trạng thái xét duyệt</label>
            <select class="form-control" id="exampleFormControlSelect1" name="id_status">
            <option value="1">xét duyệt</option>
            <option value="2">Đợi xét duyệt</option>
            <option value="3">hủy xét duyệt</option>
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
@stop