<?php 

use yii\widgets\ActiveForm;
    
/* @var boolean $checkoutSuccessful */
?>

<ul class="category-name">
    <li>
        <a href="/">Trang chủ</a>
    </li>
    <li>
        Thanh Toán
    </li>
</ul>
<div id="news-container">
    <?php if(isset($checkoutSuccessful) && $checkoutSuccessful) : ?>
        <p>
            <img src="/img/login_icon.jpg" style="vertical-align: middle" height="32">
            Thanh toán thành công. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất. Cảm ơn bạn rất nhiều!
        </p>
        <p><a href="/"><u>Bấm vào đây</u></a> để quay về trang chủ.</p>
    <?php else : ?>
    <p>
        <img src="/img/login_icon.jpg" style="vertical-align: middle" height="32">
        <!--Mời quý khách <a class="hidden-xs" href="#login-form" style="color: blue" id="ajax-login">Đăng nhập</a><a class="visible-xs-inline" href="/user/login" style="color: blue">Đăng nhập</a> nếu là thành viên hoặc điền đầy đủ thông bên dưới để chúng tôi giao hàng-->
        Mời quý khách điền đầy đủ thông bên dưới để chúng tôi liên hệ và giao hàng
    </p>
    <div class="form">
            <?php 
                $form = ActiveForm::begin(); 
                $cities = ["Lai Châu","An Giang","Bà Rịa Vũng Tàu","Bạc Liêu","Bắc Cạn","Bắc Giang","Bắc Ninh","Bến Tre","Bình Dương","Bình Định","Bình Phước","Bình Thuận","Cà Mau","Cao Bằng","Cần Thơ","Đà Nẵng","Đắk Lắk","Đắk Nông","Điện Biên","Đồng Nai","Đồng Tháp","Gia Lai","Hà Giang","Hà Nội","Hà Nam","Hà Tĩnh","Hải Dương","Hậu Giang","Hải Phòng","Hòa Bình","Hưng Yên","Khánh Hòa","Kiên Giang","Kon Tum","Lạng Sơn","Lào Cai","Lâm Đồng","Long An","Nam Định","Nghệ An","Ninh Bình","Ninh Thuận","Phú Thọ","Phú Yên","Quảng Bình","Quảng Nam","Quảng Ngãi","Quảng Ninh","Quảng Trị","Sóc Trăng","Sơn La","TP HCM","Tây Ninh","Thái Bình","Thái Nguyên","Thanh Hóa","Thừa Thiên Huế","Tiền Giang","Trà Vinh","Tuyên Quang","Vĩnh Long","Vĩnh Phúc","Yên Bái"];
            ?>
            <div style="font-size: larger; margin-bottom: 10px"><b>1. Thông tin giao hàng</b></div>

            <?= $form->field($model, 'name')->textInput(); ?>
            <?= $form->field($model, 'phone')->textInput(); ?>
            <?= $form->field($model, 'address')->textInput(); ?>
            <?= $form->field($model, 'city')->dropDownList(array_combine($cities, $cities), ['prompt' => 'None']); ?>
            <?= $form->field($model, 'email')->textInput(); ?>
            <?= $form->field($model, 'description')->textArea(['rows' => 5, 'cols' => 40]); ?>
            <br>
            <div class="row hidden-xs">
                <div style="font-weight: bold; font-size: larger; line-height: 40px"><b>2. Phương thức thanh toán</b></div>
                <table width="100%" class="table-responsive">
                    <tbody>
                        <tr>
                            <td colspan="3">Vui lòng lựa chọn phương thức thanh toán phù hợp</td>
                        </tr>
                        <tr>
                            <td style="width: 120px">
                                <input id="1" name="Cart[payment_method]" value="Tiền mặt" type="radio" checked="checked">
                                <label style="width : auto " for="1">Tiền mặt</label>
                            </td>
                            <td width="10">:</td>
                            <td style="text-align: justify">
                                Quý khách thanh toán tiền mặt trực tiếp cho nhân viên giao hàng ngay sau khi nhận hàng.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input id="2" name="Cart[payment_method]" value="Chuyển khoản" type="radio">
                                <label style="width :auto " for="2">Chuyển khoản</label>
                            </td>
                            <td>:</td>
                            <td style="text-align: justify">
                                Quý khách chuyển tiền vào tài khoản ngân hàng
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div>
                                    <p><img alt="" src="/img/vietcombank-logo.jpg" style="height:110px; line-height:1.6em; opacity:0.9; padding:5px 10px 0px 0px; width:210px; float:left"></p>
                                </div>
                                <div class="bank vietcom" style="border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(204, 204, 204);">
                                    <h3>Ngân hàng TMCP Ngoại thương Việt Nam - Vietcombank</h3>

                                    <p><strong>Tên tài khoản :&nbsp;TRANG NGỌC THẮNG</strong></p>

                                    <p><strong>Số tài khoản :&nbsp;</strong>01810 0344 3286</p>

                                    <p><strong>Chi nhánh:&nbsp;</strong>Hồ Chí Minh</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
<!--            <div style="background-color: #fff; padding: 5px; border: 1px solid #ddd;">
                <input type="checkbox" id="dieukhoan" checked="checked"> Tôi đồng ý với <a style="color: blue" href="/dieu-khoan-su-dung.html#dam-bao-an-toan-giao-dich" target="_blank">Chính sách và quy định đặt hàng trực tuyến</a>
            </div>-->
            <div class="row" style="margin-top: 10px; text-align: center">
                <button class="confirm" type="submit" id="">Hoàn tất</button>
            </div>
            <?php ActiveForm::end(); ?>
    </div> 
    <?php endif;?>
</div>

