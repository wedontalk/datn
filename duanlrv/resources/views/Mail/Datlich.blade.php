<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    
</head>
<body>
   
    <h2> được gửi tới từ: PetShop.vn </h2>
    <table border="0" width="100%" cellpadding="0" style="border-collapse: collapse" bgcolor="4C4E4E">
        <tr>
            <td style="padding:30px;">
                <div align="center">
                    <table border="0" width="600" cellpadding="0" style="border-collapse: collapse" bgcolor="4C4E4E">
                        <tr>
                            <td style="border-top-left-radius: 8px; border-top-right-radius: 8px;" height="40" bgcolor="1c4a8a">
                                <table border="0" width="100%" cellpadding="0" style="border-collapse: collapse">
                                    <tr>
                                        <td style="padding-left: 10px">
                                            <font color=" #FFFFFF ">Gửi đến từ : Petshop.vn
                                            </font>
                                        </td>
                                        <td style="padding-right: 20px; " align="right ">
                                            <font color="#FFFFFF ">Hotline: 028 9999 8844</font>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        
                        <tr>
                            <td style="padding:20px; " bgcolor="#ECECEC ">
    
    
                                <table border="0 " width="100% ">
                                    <tr>
                                        <td bgcolor="#FFFFFF " style="padding:15px; ">
                                            <br>
                                            <h2 style="text-align: center ">THÔNG TIN ĐẶT LỊCH</h2>
                                            <p style="text-align: left ">
                                                <hr> Họ và tên : {{$name}}
                                                <hr> Email: {{$email}}
                                                <hr> Số điện thoại : {{$phone}}
                                                <hr> Địa chỉ : {{$address}} 
                                                <hr> Dịch vụ : {{$nhucau}} 
                                                <hr> Cơ sở : {{$coso}}

                                                <hr> Ngày hẹn : {{date('d/m/Y',strtotime($date));}} 

                                                <hr> Giờ hẹn : {{$time}} 
                                                <hr> Mã Đặt lịch : {{$makh}}

                                                <hr> Ghi chú Khách hàng : {{$note}}
                                            </p>
                                            <p>&nbsp;</p>

                                            <p align=center>

    
    
                                                <br>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
    
                            </td>
                        </tr>
                       
    
                        <tr>
                            <td style="padding:20px; color: #1c4a8a " bgcolor="ECECEC " ; height="60 ">Petshop.vn<br> Địa chỉ: 74 Nguyễn Cửu Đàm, P. Tân Sơn Nhì, Q.Tân Phú, HCM
    
    
                                <br> Hotline : 028 9999 8844<br> website : <a href="http://127.0.0.1:8000/">Petshop.vn</a></td>
    
                        </tr>
                        <tr>
                            <td style="border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; " height="40 " bgcolor="1c4a8a " align="center ">
                                <font color="#FFFFFF ">PetShop.vn </font>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    <style>
        table .logo {
            font-size: 33px;
        }
    </style>
</body>
</html>