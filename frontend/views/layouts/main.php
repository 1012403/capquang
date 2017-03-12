<?php

use common\components\UrlUtil;
use common\models\Menu;
use common\models\News;
use common\models\Product;
use common\models\ProductCategory;
use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $content string */

AppAsset::register($this);
$webSetting = \common\models\Setting::find()->one();
$this->title = $webSetting->meta_title;
$this->registerMetaTag(['name'=>'description', 'content' => $webSetting->meta_description], 'meta_description');
$this->registerMetaTag(['name'=>'keywords', 'content' => $webSetting->meta_keywords], 'meta_keywords');

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="content-language" content="vi" />
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/vx-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <!-- head -->
    <title>Lặp đặt Internet Cáp Quang VNPT TP.HCM năm 2016,tốc độ 12Mbps 150.000&#x002F;tháng.</title>
    <meta  http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta  http-equiv="content-language" content="vi" />
    <meta  name="description" content="internet cáp quang dành cho gia đình ,doanh nghiệp miễn 100&#x25; phí lắp đặt ,giá siêu rẻ nhiều khuyến mãi và ưu đãi hấp dẫn." />
    <meta  name="keywords" content="lắp đặt cáp quang vnpt,lap dat cap quang vnpt,lap mang vnpt,lắp mạng vnpt,lắp đặt mạng vnpt,lap dat mang vnpt,mạng vnpt,mang vnpt,internet vnpt cap quang,internet vnpt cáp quang lắp mạng cáp quang vnpt,cáp quang vnpt,cap quang vnpt,cáp quang vnpt q" />
    <meta  name="language" content="vietnamese" />
    <meta  name="author" content="Lặp đặt Internet Cáp Quang VNPT TP.HCM năm 2016,tốc độ 12Mbps 150.000/tháng." />
    <meta  name="copyright" content="Lặp đặt Internet Cáp Quang VNPT TP.HCM năm 2016,tốc độ 12Mbps 150.000/tháng. [capquangvnpthcm2@gmail.com]" />
    <meta  name="robots" content="index, archive, follow, noodp" />
    <meta  name="googlebot" content="index,archive,follow,noodp" />
    <meta  name="msnbot" content="all,index,follow" />
    <meta  name="generator" content="NukeViet v3.x" />
    <meta  name="geo.region" content="VN" />
    <meta  name="geo.position" content="10.882502;106.637972" />
    <meta  name="icbm" content="10.882502, 106.637972" />
    <meta  name="dc.title" content="cap quang VNPT" />
    <link rel="canonical" href="index.html" />
    <link rel="alternate" href="vi/news/rss/index.html" title="Tin Tức" type="application/rss+xml" />
    <link rel="alternate" href="vi/news/rss/Dich-vu/index.html" title="Tin Tức - Dịch vụ" type="application/rss+xml" />
    <link rel="alternate" href="vi/news/rss/Vinaphone-so-dep/index.html" title="Tin Tức - Vinaphone số đẹp" type="application/rss+xml" />
    <link rel="alternate" href="vi/news/rss/Khuyen-mai/index.html" title="Tin Tức - Khuyến mãi" type="application/rss+xml" />
    <link rel="alternate" href="vi/news/rss/Bang-gia/index.html" title="Tin Tức - Bảng giá" type="application/rss+xml" />
    <link rel="alternate" href="vi/news/rss/Ho-tro/index.html" title="Tin Tức - Hỗ trợ" type="application/rss+xml" />
    <link rel="alternate" href="vi/news/rss/Tin-tuc/index.html" title="Tin Tức - Tin tức" type="application/rss+xml" />
    <link rel="alternate" href="vi/news/rss/Dang-ky-dich-vu/index.html" title="Tin Tức - Đăng ký dịch vụ" type="application/rss+xml" />
    <link rel="Stylesheet" href="files/css/93d5d9d98f930e6a8c6479679ce91921.opt.css" type="text/css" />

    <div itemprop="rating" itemscope itemtype="http://data-vocabulary.org/Rating">
    </div> 
    <script type="text/javascript">
    //<![CDATA[
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-23429XXX-1']);
    _gaq.push(['_trackPageview']);
    (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
    //]]>
    </script>
</head>
<body>
<?php $this->beginBody() ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5&appId=933112980120316";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?= Alert::widget() ?>

<div class="wrapper">
<div class="">
<div class="top">
<div class="clear">
</div>
</div>
</div>
<div class="header">
<div class="logo">
<h1><a title="<?= $webSetting->meta_title; ?>" href="/"><img  src="images/logo.png" alt="<?= $webSetting->meta_title; ?>" height="50px" alt="dich vu/></a></h1>
</div>
<div class="topadv">
<div style="text-align: right;"> <br /> <span style="color:rgb(255, 255, 255);"><strong><span style="font-size: 20px;"><span style="font-family: arial,helvetica,sans-serif;">CÁP QUANG VNPT-VINAPHONE</span></span></strong></span><br /> <span style="font-size: 22px;"><span style="font-family: arial,helvetica,sans-serif;"><strong><span style="color: rgb(255, 255, 255);"><span style="font-size: 16px;">HotLine:</span></span><span style="color: rgb(255, 255, 0);"> 0916.82.81.82</span></strong></span></span></div>
</div>
<div class="clear">
</div>
</div><script type="text/javascript">
var nv_siteroot="index.html",nv_sitelang="vi",nv_name_variable="nv",nv_fc_variable="op",nv_lang_variable="language",nv_module_name="news",nv_my_ofs=7,nv_my_abbr="ICT",nv_cookie_prefix="capquang_Mcs7m",nv_area_admin=0;
</script>
<div id="ddtopmenubar" class="mattblackmenu">
<ul>
<li><a title="Trang Chủ" href="index.html"  class="current"><strong>Trang Chủ</strong></a></li>
<li><a title="Khuyến mãi" href="#" rel="ddsubmenu1"><strong>Khuyến mãi</strong></a></li>
<li><a title="Internet Cáp quang VNPT" href="news/Khuyen-mai/Internet-Cap-quang-Vnpt-154/index.html" rel="ddsubmenu2"><strong>Internet Cáp quang VNPT</strong></a></li>
<li><a title="Vinaphone trả sau số đẹp" href="#" rel="ddsubmenu3"><strong>Vinaphone trả sau số đẹp</strong></a></li>
<li><a title="Sim 3g Vinaphone" href="news/Vinaphone-so-dep/GOI-CUOC-3G-CHO-KHU-VUC-KO-CO-CAP-INTERNET-VNPT-VA-3G-GTVT-160/index.html" ><strong>Sim 3g Vinaphone</strong></a></li>
<li><a title="Dịch vụ VNPT" href="#" rel="ddsubmenu4"><strong>Dịch vụ VNPT</strong></a></li>
<li><a title="Đăng ký dịch vụ" href="contact/index.html" ><strong>Đăng ký dịch vụ</strong></a></li>
</ul>
</div>

<script src="js/jquery/ddlevelsmenu.js" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
ddlevelsmenu.setup("ddtopmenubar", "topbar")
//]]>
</script>
<div class="main">
</div>
<script type="text/javascript">
//<![CDATA[
function showHideGB(){
var gb = document.getElementById("gb");
var w = gb.offsetWidth;
gb.opened ? moveGB(0, 30-w) : moveGB(20-w, 0);
gb.opened = !gb.opened;
}
function moveGB(x0, xf){
var gb = document.getElementById("gb");
var dx = Math.abs(x0-xf) > 10 ? 5 : 1;
var dir = xf>x0 ? 1 : -1;
var x = x0 + dx * dir;
gb.style.right = x.toString() + "px";
if(x0!=xf){setTimeout("moveGB("+x+", "+xf+")", 10);}
}
//]]>
</script>
<div class="main">

                <?= $content ?>


<div class="navigation ">
<div class="mainnav">
<ul>
<table border="0" cellpadding="0" cellspacing="0" style="width: 100%"> <tbody> <tr> <td> <a href="index.html"><span style="color:rgb(0, 102, 204);"><strong>CÁP QUANG VNPT</strong></span></a></td> <td> <span style="color:rgb(0, 102, 204);"><strong>SIM TRẢ SAU VINAPHONE</strong></span></td> <td> <a href="index.html"><span style="color:rgb(0, 102, 204);"><strong>LẮP ĐẶT INTERNET</strong></span></a></td> <td> <a href="index.html"><span style="color:rgb(0, 102, 204);"><strong>LẮP ĐẶT CÁP QUANG</strong></span></a></td> <td> <a href="index.html"><span style="color:rgb(0, 102, 204);"><strong>INTERNET CÁP QUANG</strong></span></a></td> <td> <a href="index.html"><span style="color:rgb(0, 102, 204);"><strong>INTERNET VNPT</strong></span></a></td> <td> &nbsp;</td> <td> &nbsp;</td> <td> &nbsp;</td> </tr> </tbody></table><br />
</ul>
</div>
</div>
<div>
<table bgcolor="#484848" border="0" cellpadding="0" cellspacing="0" style="width: 950px">
<tbody>
<tr>
<td>
<img  src="images/logo.png" width="350px" alt="" /></td>
<td>
<span style="color:rgb(255, 255, 255);"><span style="font-size: 14px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; VNPT Thành phố Hồ Chí Minh<br />Phòng bán hàng Nam Sài Gòn - Tổ Kinh doanh 2<br />05 Nguyễn Thị Thập, P. Tân Hưng, Quận 07</span></span>
</td>
</tr>
</tbody>
</table>
</div>
<div id="rfloat"> </div>
<div class="clear"> </div>
</div>

<?php $this->endBody() ?>
</body>
<script type="text/javascript" src="js/mudim.js"></script>
<script type="text/javascript">
$(document).ready(function() {
//Tooltips
var tip = null;
$(".tooltip").hover(function(){
//Caching the tooltip and removing it from container; then appending it to the body
tip = $(this).find('.tip').remove();
$('body').append(tip);
tip.show(); //Show tooltip
}, function() {
tip.hide().remove(); //Hide and remove tooltip appended to the body
$(this).append(tip); //Return the tooltip to its original position
}).mousemove(function(e) {
//console.log(e.pageX)
if ( tip == null ) return;
var mousex = e.pageX + 20; //Get X coodrinates
var mousey = e.pageY + 20; //Get Y coordinates
var tipWidth = tip.width(); //Find width of tooltip
var tipHeight = tip.height(); //Find height of tooltip
//Distance of element from the right edge of viewport
var tipVisX = $(window).width() - (mousex + tipWidth);
var tipVisY = $(window).height() - (mousey + tipHeight);
if ( tipVisX < 20 ) { //If tooltip exceeds the X coordinate of viewport
mousex = e.pageX - tipWidth - 20;
$(this).find('.tip').css({  top: mousey, left: mousex });
} if ( tipVisY < 20 ) { //If tooltip exceeds the Y coordinate of viewport
mousey = e.pageY - tipHeight - 20;
tip.css({  top: mousey, left: mousex });
} else {
tip.css({  top: mousey, left: mousex });
}
});
});
</script>
</html>
<?php $this->endPage() ?>
