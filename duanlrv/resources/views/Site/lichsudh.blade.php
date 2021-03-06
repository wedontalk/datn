@extends('layouts.site')

@section('main')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css">
<style>
    body {
    background-color: #f9f9fa
}

 .flex {
     -webkit-box-flex: 1;
     -ms-flex: 1 1 auto;
     flex: 1 1 auto
 }

 @media (max-width:991.98px) {
     .padding {
         padding: 1.5rem
     }
 }

 @media (max-width:767.98px) {
     .padding {
         padding: 1rem
     }
 }

 .padding {
     padding: 5rem
 }

.padding {
    padding: 3rem !important
}

.user-card-full {
    overflow: hidden
}

.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    border: none;
    margin-bottom: 30px
}

.m-r-0 {
    margin-right: 0px
}

.m-l-0 {
    margin-left: 0px
}

.user-card-full .user-profile {
    border-radius: 5px 0 0 5px
}

.bg-c-lite-green {
    background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
    background: linear-gradient(to right, #ee5a6f, #f29263)
}

.user-profile {
    padding: 20px 0
}

.card-block {
    padding: 1.25rem
}

.m-b-25 {
    margin-bottom: 25px
}

.img-radius {
    border-radius: 5px
}

h6 {
    font-size: 14px
}

.card .card-block p {
    line-height: 25px
}

@media only screen and (min-width: 1400px) {
    p {
        font-size: 14px
    }
}

.card-block {
    padding: 1.25rem
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0
}

.m-b-20 {
    margin-bottom: 20px
}

.p-b-5 {
    padding-bottom: 5px !important
}

.card .card-block p {
    line-height: 25px
}

.m-b-10 {
    margin-bottom: 10px
}

.text-muted {
    color: #919aa3 !important
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0
}

.f-w-600 {
    font-weight: 600
}

.m-b-20 {
    margin-bottom: 20px
}

.m-t-40 {
    margin-top: 20px
}

.p-b-5 {
    padding-bottom: 5px !important
}

.m-b-10 {
    margin-bottom: 10px
}

.m-t-40 {
    margin-top: 20px
}

.user-card-full .social-link li {
    display: inline-block
}

.user-card-full .social-link li a {
    font-size: 20px;
    margin: 0 10px 0 0;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out
}
</style>
<br>
<div class="container">
    <div class="row d-flex justify-content-left">
        <div class="col-xl-5 col-md-12">
            <div class="card user-card-full">
                <div class="row m-l-0 m-r-0">
                    <div class="col-sm-4 bg-c-lite-green user-profile">
                        <div class="card-block text-center text-white">
                            <div class="m-b-25" style="border-radius:50%;">
                            @if(Auth::user()->avatar)
                            <img src="{{asset('uploaduser')}}/{{auth::user()->avatar}}" class="img-radius" alt="User-Profile-Image">
                            @else
                            <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image">
                            @endif
                        </div>
                            <h6 class="f-w-600">admin</h6>
                            <p>0369242446</p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="card-block">
                            <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Th??ng tin c?? b???n</h6>
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="m-b-10 f-w-600">Email</p>
                                    <h6 class="text-muted f-w-400">{{Auth::user()->email}}</h6>
                                </div>
                                <div class="col-sm-12">
                                    <p class="m-b-10 f-w-600">Phone</p>
                                    <h6 class="text-muted f-w-400">{{Auth::user()->phone}}</h6>
                                </div>
                            </div>
                            <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">?????a ch??? c?? nh??n</h6>
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="m-b-10 f-w-600">?????a ch???</p>
                                    <h6 class="text-muted f-w-400">{{Auth::user()->address}}</h6>
                                </div>
                                <hr>
                                <div class="col-sm-12">
                                    <p class="m-b-10 f-w-600">?????i m???t kh???u</p>
                                    <input type="hidden" id="iduser1" value="{{Auth::user()->id}}">
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" class="form-control" id="passold" name="password" >    
                                    </div>
                                    <div class="form-group">
                                        <label for="">Confirm Password</label>
                                        <input type="password" class="form-control" id="passnew" name="confirm_password">
                                    </div>
                                    <button type="submit" id="submitpass" class="btn btn-primary">?????i m???t kh???u</button>
                                </div>
                            </div>
                            <!-- <ul class="social-link list-unstyled m-t-40 m-b-10">
                                <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true"><i class="mdi mdi-facebook feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="mdi mdi-twitter feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="mdi mdi-instagram feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                            </ul> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-7 col-md-12">
                <div class="b-b b-theme nav-active-theme mb-3">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li><a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Th??ng Tin</a></li>
                        <li><a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">????n h??ng</a></li>
                    </ul>
                </div>
                <div class="tab-content mb-4">
                    <div class="tab-pane fade show active in" id="home" role="tabpanel" aria-labelledby="home-tab">
                        
                        <div class="wrapper row3">
                            <main class="hoc container clear">
                                <section>
                                <form action="{{route('account.update', Auth::user()->id)}}" method="post" id="upload-image-form" enctype="multipart/form-data">
                                    @csrf @method('PUT')
                                    <input type="hidden" id="iduser" value="{{Auth::user()->id}}">
                                        <div class="row">
                                            <div class="col-sm-6">                                        
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <input type="text" class="form-control" name="name" value="{{auth::user()->name}}">
                                            </div>
                                        </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="text" class="form-control" name="email" value="{{auth::user()->email}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">SDT</label>
                                            <input type="number" class="form-control" name="phone" value="{{auth::user()->phone}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Dia Chi</label>
                                            <input type="text" class="form-control" name="address" value="{{auth::user()->address}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Image</label>
                                            <input type="file" name="file_upload" class="form-control" value="">
                                        </div>
                                        <button type="submit" id="submitajax" class="btn btn-primary">Luu thong tin</button>
                                </form>
                                    </section>
                            </main>
                        </div>

















                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header with-border">
                                   <center><h4 class="box-title">tr???ng th??i ????n h??ng</h4></center>
                                   <br>
                                </div> <!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>m?? ????n h??ng</th>
                                                <th>ng??y ?????t h??ng</th>
                                                <th>Tr???ng th??i</th>
                                                <th style="width: 40px">action</th>
                                                <th style="width: 60px">action</th>
                                            </tr>
                                            @php
                                            $i = 1;
                                            @endphp
                                            @foreach($donhang as $dh)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$dh->order_code}}</td>
                                                <td>{{$dh->order_date}}</td>
                                                <td>
                                                @if($dh->id_status == 1)
                                                <label  style="font-size:11px; padding:3px" class="badge badge-success">th??nh c??ng</label>
                                                @elseif($dh->id_status == 2)
                                                <label style="font-size:11px; padding:3px" class="badge badge-info">??ang giao h??ng</label>
                                                @elseif($dh->id_status == 3)
                                                <label style="font-size:11px; padding:3px" class="badge badge-warning">ch??? x??t duy???t</label>
                                                @else
                                                <label style="font-size:11px; padding:3px" class="badge badge-danger">???? h???y</label>
                                                @endif
                                                </td>
                                                <td><a id="huydonhang" data-id="{{$dh->order_id}}" data-status="{{$dh->id_status}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
                                                <td>  
                                                    <a href="{{URL::to('/chi-tiet-dh/'.$dh->order_id)}}">Chi ti???t</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> <!-- /.box-body -->
                                <div class="box-footer clearfix">
                                <div class="pull-right">{{ $donhang->appends(request()->query())->links() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

@stop()
@section('js')
<!-- ?????i pass -->
<script>
    jQuery(document).ready(function($) {
        $(document).on('click','#submitpass', function(){
            var id = $('#iduser1').val();
            var passold = $('#passold').val();
            var passnew = $('#passnew').val();
            var _token = $('input[name="_token"]').val();
            if(id == ''){
                alertify.warning('id kh??ng ???????c r???ng !!!');
            }else if(passold == ''){
                alertify.warning('m???t kh???u c?? kh??ng ???????c r???ng !!!');
            }else if(passnew == ''){
                alertify.warning('m???t kh???u m???i kh??ng ???????c r???ng !!!');
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
                        alertify.success('c???p nh???t th??nh c??ng !');
                    }
                    else
                    {
                        alertify.error('kh??ng th??nh c??ng !');

                    }
                }
            });
        });
    });
</script>
<script>
    jQuery(document).ready(function($) {
        $(document).on('click', '#huydonhang', function(){
            var idhuy = $(this).data('id');
            var status = $(this).data('status');
            var _token = $('input[name="_token"]').val();
                // alert(idhuy);
                // alert(status);
                // alert(_token);
            $.ajax({
                url:'{{route('updatedonhang')}}', 
                method:'post',
                data:{
                    idhuy: idhuy,status:status,_token:_token,
                },
                success: function(data) 
                {
                    if(data == 'done')
                    {
                        alertify.success('c???p nh???t th??nh c??ng !');
                    }
                    else if(data == 'loi')
                    {
                        alertify.error('kh??ng th??nh c??ng !');
                    }
                    window.location.reload(true);
                }
            });
        });
    });
</script>
@stop()

