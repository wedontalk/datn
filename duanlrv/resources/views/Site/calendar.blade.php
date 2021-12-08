@extends('layouts.site')

@section('main')
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
.stepwizard-step p {
    margin-top: 10px;
}

.stepwizard-row {
    display: table-row;
}

.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}

.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}

.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;

}

.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}

.btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
}
.form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0rem rgba(0, 123, 255, .25)
        }

        .btn-secondary:focus {
            box-shadow: 0 0 0 0rem rgba(108, 117, 125, .5)
        }

        .close:focus {
            box-shadow: 0 0 0 0rem rgba(108, 117, 125, .5)
        }

        .mt-200 {
            margin-top: 200px
        }

        .calendar {
            width: 370px;
            box-shadow: 0px 0px 35px -16px rgba(0, 0, 0, 0.75);
            font-family: "Roboto", sans-serif;
            padding: 20px 30px;
            color: #363b41;
            display: inline-block;
        }

        .calendar_header {
            border-bottom: 2px solid rgba(0, 0, 0, 0.08);
        }

        .header_copy {
            color: #a39d9e;
            font-size: 20px;
        }

        .calendar_plan {
            margin: 20px 0 40px;
        }

        .cl_plan {
            width: 100%;
            height: 140px;
            background-image: linear-gradient(-222deg, #ff8494, #ffa9b7);
            box-shadow: 0px 0px 52px -18px rgba(0, 0, 0, 0.75);
            padding: 30px;
            color: #fff;
        }

        .cl_copy {
            font-size: 20px;
            margin: 20px 0;
            display: inline-block;
        }

        .cl_add {
            display: inline-block;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #fff;
            cursor: pointer;
            margin: 0 0 0 65px;
            color: #c2c2c2;
            padding: 11px 13px;
        }

        .calendar_events {
            color: #a39d9e;
        }

        .ce_title {
            font-size: 14px;
        }

        .event_item {
            margin: 18px 0;
            padding: 5px;
            cursor: pointer;
        }

        .event_item:hover {
            background-image: linear-gradient(-222deg, #ff8494, #ffa9b7);
            box-shadow: 0px 0px 52px -18px rgba(0, 0, 0, 0.75);
        }

        .event_item:hover .ei_Dot {
            background-color: #fff;
        }

        .event_item:hover .ei_Copy,
        .event_item:hover .ei_Title {
            color: #fff;
        }

        .ei_Dot,
        .ei_Title {
            display: inline-block;
        }

        .ei_Dot {
            border-radius: 50%;
            width: 10px;
            height: 10px;
            background-color: #a39d9e;
            box-shadow: 0px 0px 52px -18px rgba(0, 0, 0, 0.75);
        }

        .dot_active {
            background-color: #ff8494;
        }

        .ei_Title {
            margin-left: 10px;
            color: #363b41;
        }

        .ei_Copy {
            font-size: 12px;
            margin-left: 27px;
        }
</style>
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="#"><i class="fa fa-home"></i> Trang Chủ</a>
                    <span>Dịch Vụ</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
        <h2 style="text-align: center">Đăng Ký Dịch Vụ</h2>
    <div class="container" style="margin-top:50px;margin-bottom:50px">
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                    <p>Bước 1</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                    <p>Bước 2</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                    <p>Bước 3</p>
                </div>
            </div>
        </div>
        <form role="form" method="POST" action="addcalendar">
            @csrf
            <div class="row setup-content" id="step-1">
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <h3> Đăng Ký Thông Tin</h3>
                        <div class="form-group">
                            <label class="control-label">Họ và Tên</label>
                            <input type="text" required="required" class="form-control name" placeholder="Họ và Tên" name="name" onchange="onchange_1()"/>
                        </div> 
                        <div class="row form-group">
                            <div class="col-lg-6">
                              <div class="input-group">
                                  <label for="">Email</label>
                                <input type="text" required="required" class="form-control email" placeholder="Email" name="email" onchange="onchange_2()">
                              </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-6 ">
                              <div class="input-group">
                                <label for="">Số Điện Thoại</label>
                                <input type="text" required="required" class="form-control phone" placeholder="Số Điện Thoại" name="phone" onchange="onchange_3()">
                              </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                          </div><!-- /.row -->
                          <div class="form-group">
                            <label class="control-label">Địa Chỉ</label>
                            <input type="text" required="required" class="form-control address" placeholder="Địa Chỉ" name="address" onchange="onchange_4()"/>
                        </div> 
                        <button class="btn btn-primary nextBtn btn-lg d-flex justify-content-center" style="margin:auto;width:200px"  type="button" >Next</button>
                    </div>
                </div>
            </div>
            <div class="row setup-content" id="step-2">
                <div class="col-xs-12" >
                    <div class="col-md-12">
                        <h3> Chọn Dịch Vụ</h3>
                       
                          <div class="row form-group">
                            <div class="col-lg-6">
                              <div class="input-group">
                                <div class="form-group">
                                    <label for="sel1">Chọn Cơ Sở:</label>
                                    <select class="form-control CS" id="sel1" name="CS" onchange="onchange_5()">
                                        <option>-- Cơ Sở --</option>
                                      @foreach ($CS as $CS)
                                          <option value="{{ $CS['id'] }}">{{ $CS['name_coso'] }}</option>
                                      @endforeach
                                    </select>
                                  </div>
                              </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-6 ">
                              <div class="input-group">
                                <div class="form-group">
                                    <label for="sel1">Chọn Dịch Vụ:</label>
                                    <select class="form-control DV" id="sel1" name="DV" onchange="onchange_6()">
                                        <option>-- Dịch Vụ --</option>
                                        @foreach ($DV as $DV)
                                        <option value="{{ $DV['id'] }}">{{ $DV['name_dichvu'] }}</option>
                                    @endforeach
                                    </select>
                                  </div>
                              </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                          </div><!-- /.row -->
                          <div class="row form-group">
                            <div class="col-lg-6">
                              <div class="input-group">
                                <div class="form-group">
                                    <label for="sel1">Chọn Ngày:</label>
                                    <input type="date" class="form-control date" name="date" onchange="onchange_7()">
                                  </div>
                              </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-6 ">
                              <div class="input-group">
                                <div class="form-group">
                                    <label for="sel1">Chọn Giờ:</label>
                                    <select class="form-control hour" id="sel1" name="hour" onchange="onchange_8()">
                                      <option>-- Giờ --</option>
                                      <option value="8:00 - 8:30">8:00 - 8:30</option>
                                      <option value="8:30 - 9:00">8:30 - 9:00</option>
                                      <option value="9:00 - 9:30">9:00 - 9:30</option>
                                      <option value="9:30 - 10:00">9:30 - 10:00</option>
                                      <option value="0:00 - 10:30">10:00 - 10:30</option>
                                      <option value="10:30 - 11:00">10:30 - 11:00</option>
                                      <option value="13:00 - 13:30">13:00 - 13:30</option>
                                      <option value="13:30 - 14:00">13:30 - 14:00</option>
                                      <option value="14:00 - 14:30">14:00 - 14:30</option>
                                      <option value="14:30 - 15:00">14:30 - 15:00</option>
                                      <option value="15:00 - 15:30">15:00 - 15:30</option>
                                      <option value="15:30 - 16:00">15:30 - 16:00</option>
                                      <option value="16:00 - 16:30">16:00 - 16:30</option>
                                      <option value="16:30 - 17:00">16:30 - 17:00</option>
                                    </select>
                                  </div>
                              </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                          </div><!-- /.row -->
                          <div class="form-group">
                              <label for="">Ghi Chú</label>
                            <textarea class="form-control ghichu" name="ghichu" rows="5" onchange="onchange_9()"></textarea>
                        </div>       
                    </div>
                </div>
                <button class="btn btn-primary nextBtn btn-lg d-flex justify-content-center" style="margin:auto;width:200px"  type="button" >Next</button>
            </div>
            <div class="row setup-content" id="step-3">
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <h3> Xác Nhận Thông Tin</h3>
                            <div class="row form-group">
                            <div class="col-lg-6">
                              <div class="input-group">
                          <p> <strong>  Họ Và Tên: </strong><span id="name"> </span></p> 
                              </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-6 ">
                              <div class="input-group">
                                <p><strong>Email: </strong><span id="email"> </span></p> 
                              </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                          </div><!-- /.row -->
                          <div class="row form-group">
                            <div class="col-lg-6">
                              <div class="input-group">
                              <p><strong>Số Điện Thoại: </strong><span id="phone"> </span></p> 
                              </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-6 ">
                              <div class="input-group">
                                <p><strong>Địa Chỉ: </strong><span id="address"> </span></p> 
                              </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                          </div><!-- /.row -->
                          <div class="row form-group">
                            <div class="col-lg-6">
                              <div class="input-group">
                              <p><strong>Cơ Sở: </strong><span id="CS"> </span></p> 
                              </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-6 ">
                              <div class="input-group">
                                <p><strong>Dịch Vụ:</strong> <span id="DV"> </span></p> 
                              </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                          </div><!-- /.row -->
                          <div class="row form-group">
                            <div class="col-lg-6">
                              <div class="input-group">
                              <p><strong>Ngày: </strong><span id="date"> </span></p> 
                              </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-6 ">
                              <div class="input-group">
                                <p><strong>Thời Gian: </strong><span id="hour"> </span></p> 
                              </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                          </div><!-- /.row -->
                          <div class="form-group">
                            <p><strong>Ghi Chú: </strong><span id="ghichu" style="width: 100%;"> </span></p> 
                        </div> 
                    <br>
                    <input type="hidden" name="id_user" value="{{Auth::user()->id}}"/>
                </div>
                <button class="btn btn-success btn-lg d-flex justify-content-center" style="margin:auto;width:200px" type="submit">Finish!</button>
            </div>
        </form>
        </div>
    </div>

<script>
    function onchange_1(){
        var name = document.querySelector('.name').value;
        document.querySelector('#name').innerText = name;
    }
    function onchange_2(){
        var name = document.querySelector('.email').value;
        document.querySelector('#email').innerText = name;
    }
    function onchange_3(){
        var name = document.querySelector('.phone').value;
        document.querySelector('#phone').innerText = name;
    }
    function onchange_4(){
        var name = document.querySelector('.address').value;
        document.querySelector('#address').innerText = name;
    }
    function onchange_5(){
        var name = document.querySelector('.CS').value;
        document.querySelector('#CS').innerText = name;
    }
    function onchange_6(){
        var name = document.querySelector('.DV').value;
        document.querySelector('#DV').innerText = name;
    }
    function onchange_7(){
        var name = document.querySelector('.date').value;
        document.querySelector('#date').innerText = name;
    }
    function onchange_8(){
        var name = document.querySelector('.hour').value;
        document.querySelector('#hour').innerText = name;
    }
    function onchange_9(){
        var name = document.querySelector('.ghichu').value;
        document.querySelector('#ghichu').innerText = name;
    }

</script>





<script>
    $(document).ready(function () {

var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn');

allWells.hide();

navListItems.click(function (e) {
    e.preventDefault();
    var $target = $($(this).attr('href')),
            $item = $(this);

    if (!$item.hasClass('disabled')) {
        navListItems.removeClass('btn-primary').addClass('btn-default');
        $item.addClass('btn-primary');
        allWells.hide();
        $target.show();
        $target.find('input:eq(0)').focus();
    }
});

allNextBtn.click(function(){
    var curStep = $(this).closest(".setup-content"),
        curStepBtn = curStep.attr("id"),
        nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
        curInputs = curStep.find("input[type='text'],input[type='url']"),
        isValid = true;

    $(".form-group").removeClass("has-error");
    for(var i=0; i<curInputs.length; i++){
        if (!curInputs[i].validity.valid){
            isValid = false;
            $(curInputs[i]).closest(".form-group").addClass("has-error");
        }
    }

    if (isValid)
        nextStepWizard.removeAttr('disabled').trigger('click');
});

$('div.setup-panel div a.btn-primary').trigger('click');
});
</script>
@endsection
