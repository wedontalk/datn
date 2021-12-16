@extends('layouts.admin')
@section('main')
<div class="content" style="background:#fff;">
    <div class="col-sm-12" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border-radius:15px">
        <div class="card-header">
            <center><strong class="card-title">form Thêm menu</strong></center>
        </div>
        <form action="{{route('slide.update',$slide->id)}}" method="POST" role="form" enctype="multipart/form-data">
         @csrf @method('PUT')
        <div class="form-group">
            <label>Tên tiêu đề</label>
            <input type="text" class="form-control @error('tieu_de') is-invalid @enderror" name="tieu_de" value="{{$slide->tieu_de}}" placeholder="Nhập tên tiêu đề">
            @error('tieu_de')
                <small class="form-text text-muted">{{$message}}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>thông tin</label>
            <input type="text" class="form-control @error('thong_tin') is-invalid @enderror" name="thong_tin" value="{{$slide->thong_tin}}" placeholder="Nhập thông tin">
            @error('thong_tin')
                <small class="form-text text-muted">{{$message}}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>khuyến mãi</label>
            <input type="text" class="form-control @error('khuyen_mai') is-invalid @enderror" name="khuyen_mai" value="{{$slide->khuyen_mai}}" placeholder="Nhập khuyến mãi">
            @error('khuyen_mai')
                <small class="form-text text-muted">{{$message}}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>link giảm giá</label>
            <input type="text" class="form-control" name="link" value="{{$slide->link}}" placeholder="Nhập link khuyến mãi">
        </div>
        <div class="form-group">
            <label>Hình ảnh (*)</label>
            <div class="input-group mt-1">
                <input type="text" id="image" name="image" value="{{$slide->image}}" class="form-control @error('image') is-invalid @enderror" placeholder="nhập hình ảnh sản phẩm">
                <div class="input-group-append">
                    <button class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg" type="button"><i class="fa fa-folder"></i></button>
                </div>
                @error('image')
                    <small class="form-text text-muted">{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio"
            {{($slide->hidden == 0) ? 'checked':'' }}
            name="hidden" id="radio0" value="0">
            <label class="form-check-label" >Ẩn</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio"
            {{($slide->hidden == 1) ? 'checked':'' }}
            name="hidden" id="radio1" value="1">
            <label class="form-check-label" >Hiện</label>
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
@stop()




@section('js')
<script src="{{asset('adm/assets/js/slug.js')}}"></script>
@stop