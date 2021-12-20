@extends('layouts.admin')
@section('main')
<style>
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
          border-radius:5px;
          border: 0;
          color: white;
          background-image: linear-gradient( 135deg, #FEB692 10%, #EA5455 100%);
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
</style>
    <div class="content">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Thông tin : {{Auth::user()->name}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="custom-tab">

                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active show" id="custom-nav-home-tab" data-toggle="tab" href="#custom-nav-home" role="tab" aria-controls="custom-nav-home" aria-selected="true">Thông tin cơ bản</a>
                                    <a class="nav-item nav-link" id="custom-nav-profile-tab" data-toggle="tab" href="#custom-nav-profile" role="tab" aria-controls="custom-nav-profile" aria-selected="false">Đổi mật khẩu</a>
                                </div>
                            </nav>
                            <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                <div class="tab-pane fade active show" id="custom-nav-home" role="tabpanel" aria-labelledby="custom-nav-home-tab">
                                    <form id="formne" enctype="multipart/form-data">
                                        <input type="hidden" id="iduser" value="{{Auth::user()->id}}">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Họ và Tên</label>
                                            <div class="col-sm-10">
                                            <input type="text" id="nameuser" class="form-control" value="{{Auth::user()->name}}" placeholder="Họ và tên">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                            <input type="email" id="emailuser" class="form-control" value="{{Auth::user()->email}}" placeholder="email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Phone</label>
                                            <div class="col-sm-10">
                                            <input type="text" id="phone" class="form-control" value="{{Auth::user()->phone}}" placeholder="phone">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Địa chỉ</label>
                                            <div class="col-sm-10">
                                            <input type="text" id="address" class="form-control" value="{{Auth::user()->address}}" placeholder="địa chỉ">
                                            </div>
                                        </div>
                                        <div class="form-group" style="padding:0.2rem 0; background:white">
                                            <button class="button-effect btn-text-ne" id="submitajax">nhập thông tin <i class="fa fa-long-arrow-right"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="custom-nav-profile" role="tabpanel" aria-labelledby="custom-nav-profile-tab">
                                    <form action="">
                                        <input type="hidden" id="iduser1" value="{{Auth::user()->id}}">
                                        <div class="form-group row">
                                            <label for="inputpass" class="col-sm-2 col-form-label">Mật khẩu cũ</label>
                                            <div class="col-sm-10">
                                            <input type="password" class="form-control" id="passold" placeholder="nhập mật khẩu cũ">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Mật khẩu mới</label>
                                            <div class="col-sm-10">
                                            <input type="password" class="form-control" id="passnew" placeholder="Nhập mật khẩu mới">
                                            </div>
                                        </div>
                                        <div class="form-group" style="padding:0.2rem 0; background:white">
                                            <button class="button-effect btn-text-ne" id="submitpass">Đổi mật khẩu <i class="fa fa-long-arrow-right"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title mb-3">Profile {{Auth::user()->name}}</strong>
                    </div>
                    <div class="card-body">
                        <div class="mx-auto d-block">
                            <img class="rounded-circle mx-auto d-block" src="
                                @if(Auth::user()->avatar == null) 
                                    {{asset('uploads/avatar/Anh-avatar-123123123.jpg')}} 
                                @else 
                                    {{asset('uploads')}}/{{Auth::user()->avatar}}
                                @endif" width="100px" height="100px" alt="Card image cap">
                            <h5 class="text-sm-center mt-2 mb-1">{{Auth::user()->name}}</h5>
                            <div class="location text-sm-center"><i class="fa fa-map-marker"></i> {{Auth::user()->address}}</div>
                            <div class="text-sm-center">Email: {{Auth::user()->email}}</div>    
                            <div class="text-sm-center">Phone: {{Auth::user()->phone}}</div>
                        </div>
                        <hr>
                        <div class="card-text">
                            <!-- <a href="#"><i class="fa fa-facebook pr-1"></i></a>
                            <a href="#"><i class="fa fa-twitter pr-1"></i></a>
                            <a href="#"><i class="fa fa-linkedin pr-1"></i></a>
                            <a href="#"><i class="fa fa-pinterest pr-1"></i></a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop()
@section('js')    
<script>
    jQuery(document).ready(function($) {
        $(document).on('click','#submitajax', function(){
            var id = $('#iduser').val();
            var name = $('#nameuser').val();
            var email = $('#emailuser').val();
            var phone = $('#phone').val();
            var address = $('#address').val();
            var _token = $('input[name="_token"]').val();
            if(id == ''){
                alertify.warning('id không được rỗng !!!');
            }else if(name == ''){
                alertify.warning('name không được rỗng !!!');
            }else if(email == ''){
                alertify.warning('email không được rỗng !!!');
            }else if(phone == ''){
                alertify.warning('phone không được rỗng !!!');
            }else if(address == ''){
                alertify.warning('address không được rỗng !!!');
            }
            $.ajax({
                url:'{{route('updateaccount')}}', 
                method:'post',
                data:{
                    id: id,name: name,email: email,phone: phone,address: address,_token:_token,
                },
                success: function(data) 
                {
                    if(data == 'done')
                    {
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
<!-- đổi mật khẩu -->
<script>
    jQuery(document).ready(function($) {
        $(document).on('click','#submitpass', function(){
            var id = $('#iduser1').val();
            var passold = $('#passold').val();
            var passnew = $('#passnew').val();
            var _token = $('input[name="_token"]').val();
            if(id == ''){
                alertify.warning('id không được rỗng !!!');
            }else if(passold == ''){
                alertify.warning('mật khẩu cũ không được rỗng !!!');
            }else if(passnew == ''){
                alertify.warning('mật khẩu mới không được rỗng !!!');
            }
            $.ajax({
                url:'{{route('updatepass')}}', 
                method:'post',
                data:{
                    id: id,passold: passold,passnew: passnew,_token:_token,
                },
                success: function(data) 
                {
                    if(data == 'done')
                    {
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
@stop
