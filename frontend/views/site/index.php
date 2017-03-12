<?php
use common\utils\ImagesUtil;

	/* @var $news common/models/News */ 
?>

<div class="col-a1">
<div class="news-default">
	<?= $defaultNews; ?>
</div>

<div class="clear"></div>
<!-- news-cateogry -->
<div class="box-border-shadow m-bottom">
<div class="cat-box-header">
<div class="cat-nav">
<a class="rss" href="vi/news/rss/Dich-vu/index.html">Rss</a>
<a title="Dịch vụ" class="current-cat" href="vi/news/Dich-vu/index.html">Dịch vụ</a>
</div>
</div>
<div class="cat-news bg clearfix">
<div class="lt-news fl ">
<div class="content-box clearfix">
<div class="m-bottom">
<h4><a title="Chữ Ký số và BHXH VNPT" href="vi/news/Dich-vu/Chu-Ky-so-va-BHXH-VNPT-161/index.html">Chữ Ký số và BHXH VNPT</a></h4>
</div>
<p>
Đăng ký VNPT CA để khai báo thuế ,khai báo bhxh cho nhân viên công ty tphcm ổn định chất lượng giá khuyến mãi .Mọi chi tiết liên hệ 0911.61.61.69
</p>
<div class="aright">
<a title="Xem tiếp..." class="more" href="vi/news/Dich-vu/Chu-Ky-so-va-BHXH-VNPT-161/index.html">Xem tiếp...</a>
</div>
</div>
</div>
<div class="ot-news fr">
<ul>
<li><span><a class="tooltip" title="KHO CHỌN SỐ VINA TRẢ SAU" href="vi/news/Dich-vu/KHO-CHON-SO-VINA-TRA-SAU-159/index.html">KHO CHỌN SỐ VINA TRẢ SAU

<span class="sprite icon picture" title=""></span><span class="tip" style="top: 2004.6px; left: 820px; display: none;"><div style="color: #1367A5;font-weight: bold;padding-bottom:5px;">KHO CHỌN SỐ VINA TRẢ SAU</div>
<img alt="" class="tooltip_img margin-right_10 fl" src="files/news/thumb/chon-so-sim-vinaphone_1.png" width="116" height="90" style="margin-right:5px;">
<p align="justify" style="font-size: 13px;">KH CHỌN SỐ TOÀN QUỐC www.chonso.vinaphone.com.vn .hay vào web để chọn số dễ nhớ .Gọi đăng ký 0917.691.661</p>
</span></a></span></li>
</ul>
</div>
<div class="clear">
</div>
</div>
</div>

<?php 
	$newsCategrories = \common\models\NewsCategory::find()->orderBy(['sort' => 'ASC'])->all();
	foreach($newsCategrories as $newsCategrory) :
		$recentlyNews = $newsCategrory->getNews()->orderBy(['created_at' => 'DESC'])->limit(5)->all();
		if(count($recentlyNews) == 0) { continue; }
		$lastNews = $recentlyNews[0];
?>
	<div class="box-border-shadow m-bottom">
<div class="cat-box-header">
<div class="cat-nav">
<a class="rss" href="#">Rss</a>
<a title="Dịch vụ" class="current-cat" href="#"><?= $newsCategrory->name; ?></a>
</div>
</div>
<div class="cat-news bg clearfix">
<div class="lt-news fl ">
<div class="content-box clearfix">
<div class="m-bottom">
<h4><a title="<?= $lastNews->title; ?>" href="#"><?= $lastNews->title; ?></a></h4>
</div>
<p><?= $lastNews->short_content; ?></p>
<div class="aright">
<a title="Xem tiếp..." class="more" href="#">Xem tiếp...</a>
</div>
</div>
</div>
<div class="ot-news fr">
<ul>
<?php 
	for($i = 1; $i < count($recentlyNews); $i++) : 
		$news = $recentlyNews[$i];
?>
<li><span><a class="tooltip" title="<?= $news->title; ?>" href="#"><?= $news->title; ?>
<span class="sprite icon picture" title=""></span><span class="tip" style="top: 2004.6px; left: 820px; display: none;"><div style="color: #1367A5;font-weight: bold;padding-bottom:5px;"><?= $news->title; ?></div>
<img alt="" class="tooltip_img margin-right_10 fl" src="<?= ImagesUtil::getImageUrl($news->image); ?>" width="116" height="90" style="margin-right:5px;">
<p align="justify" style="font-size: 13px;"><?= $news->short_content; ?></p>
</span></a></span></li>
<?php endfor; ?>
</ul>
</div>
<div class="clear">
</div>
</div>
</div>
<?php endforeach; ?>

&nbsp;
<div class="clear">
</div>
<div class="box-border m-bottom">
<div class="header-block1">
<h3><span>CHẤP NHẬN THANH TOÁN</span></h3>
</div>
<div class="content-box">
<br /><img  alt="" src="uploads/2ac8b679-5ace-4766-873d-70e136d611b4_1.png" style="width: 650px; height: 69px;" />
</div>
</div>
</div>
<div class="col-a2 last">
<div class="col-bottom fl">
<div class="col-mid fl">
<div class="col-top fl">
<div class="col-content">
<div class="box-border m-bottom">
<div class="header-block1">
<h3><span>Hỗ trợ trực tuyến</span></h3>
</div>
<div class="content-box">
<div class="support" style=" font-family:Tahoma; font-size:11pt;; color:#333; width:230px;  border-left:1px solid #FFF; border-top:10px">
<ul style="padding:8px">
<li class="clearfix" style="padding-bottom:7px;">
<div class="fl">
<span><b>HOTLINE - 0911.616169</b></span>
</div>
<div class="fl" style="margin-right:5px">
<a href="skype:0916828182?chat"> <img  alt="" src="themes/default/skype.png" width="80" /> </a>
</div>
</li>
<li class="clearfix" style="padding-bottom:7px;">
<div class="fl">
<span><b>HOTLINE - 0917.691661</b></span>
</div>
<div class="fl" style="margin-right:5px">
<a href="skype:0916828182?chat"> <img  alt="" src="themes/default/skype.png" width="80" /> </a>
</div>
</li>
<li class="clearfix" style="padding-bottom:7px;">
<div class="fl">
<span><b>BÁO HƯ - 08.800126</b></span>
</div>
<div class="fl" style="margin-right:5px">
<a href="skype:0917691661?chat"> <img  alt="" src="themes/default/skype.png" width="80" /> </a>
</div>
</li>
</ul>

</div>
</div>
</div>
<div class="box-border m-bottom">
<div class="header-block1">
<h3><span>TIN TỨC MỚI</span></h3>
</div>
<div class="content-box">
<div class="box-border m-bottom">
<div class="box-inside" id="tabs_top">
<ul class="list-tab clearfix">
<li>
<a href="#topviews" class="current">Tiêu điểm</a>
</li>
<li>
<a href="#topcomment">Bình luận mới</a>
</li>
</ul>
<div class="clear"></div>
<div class="box-border" id="topviews">
<div class="content-box">
<ul class="list-number">
<li>
<span class="small">Hỗ trợ</span>
<br />
<a href="vi/news/Ho-tro/Huong-dan-cau-hinh-Bridge-Mode-cho-thiet-bi-DrayTek-134/index.html">Hướng dẫn cấu hình Bridge Mode cho thiết bị DrayTek</a>
</li>
<li>
<span class="small">Khuyến mãi</span>
<br />
<a href="vi/news/Khuyen-mai/Cap-quang-danh-cho-ho-gia-dinh-155/index.html">Cáp quang dành cho hộ gia đình</a>
</li>
<li>
<span class="small">Khuyến mãi</span>
<br />
<a href="vi/news/Khuyen-mai/Internet-Cap-quang-Vnpt-154/index.html">Internet Cáp quang Vnpt</a>
</li>
<li>
<span class="small">Vinaphone số đẹp</span>
<br />
<a href="vi/news/Vinaphone-so-dep/GOI-CUOC-3G-CHO-KHU-VUC-KO-CO-CAP-INTERNET-VNPT-VA-3G-DOANH-NGHIEP-160/index.html">GÓI CƯỚC 3G CHO KHU VỰC KO CÓ CÁP INTERNET VNPT VÀ 3G DÀNH CHO DOANH NGHIỆP</a>
</li>
<li>
<span class="small">Khuyến mãi</span>
<br />
<a href="vi/news/Khuyen-mai/TRUYEN-HINH-MYTV-HD-158/index.html">TRUYỀN HÌNH MYTV HD</a>
</li>
<li>
<span class="small">Khuyến mãi</span>
<br />
<a href="vi/news/Khuyen-mai/GOI-CUOC-VINAPHONE-TRA-SAU-157/index.html">GÓI CƯỚC VINAPHONE TRẢ SAU</a>
</li>
<li>
<span class="small">Khuyến mãi</span>
<br />
<a href="vi/news/Khuyen-mai/Cap-Quang-danh-cho-doanh-nghiep-156/index.html">Cáp Quang dành cho doanh nghiệp</a>
</li>
</ul>
</div>
</div>
<div class="box-border" id="topcomment">
<div class="content-box">
<ul class="list-number">
<li>
<a title="Sim trả trước có đang ký gói ez90 được không bạn" href="vi/news/Vinaphone-so-dep/GOI-CUOC-3G-CHO-KHU-VUC-KO-CO-CAP-INTERNET-VNPT-VA-3G-DOANH-NGHIEP-160/index.html">Sim trả trước có đang ký gói ez90 được không bạn</a>
</li>
<li>
<a title="Cho em hỏi giá cước của gói trả trước 12 hoặc 24 tháng là bao nhiu vậy ?" href="vi/news/Khuyen-mai/Cap-quang-danh-cho-ho-gia-dinh-155/index.html">Cho em hỏi giá cước của gói trả trước 12 hoặc 24 tháng là bao nhiu vậy ?</a>
</li>
<li>
<a title="Tôi muốn nâng cấp gói cước đang sử dụng lên gói EzCom 90." href="vi/news/Vinaphone-so-dep/GOI-CUOC-3G-CHO-KHU-VUC-KO-CO-CAP-INTERNET-VNPT-VA-3G-DOANH-NGHIEP-160/index.html">Tôi muốn nâng cấp gói cước đang sử dụng lên gói EzCom 90.</a>
</li>
<li>
<a title="INternet tệ quá rớt mạng liên tục không dùng được gì cả nên xem lại đi dịch vụ tệ quá tệ ko còn từ..." href="vi/news/Khuyen-mai/Internet-Cap-quang-Vnpt-154/index.html">INternet tệ quá rớt mạng liên tục không dùng được gì cả nên xem lại đi dịch vụ tệ quá tệ ko còn từ...</a>
</li>
</ul>
</div>
</div>		
</div>
</div>
</div>
</div>
<div class="box-border m-bottom">
<div class="header-block1">
<h3><span>Quảng cáo</span></h3>
</div>
<div class="content-box">
<a href="index.html"><img  alt="" src="uploads/fibervnn-01.jpg" style="width: 225px; height: 155px;" /></a><br /><br /><a href="index.html"><img  alt="" src="uploads/mytv.jpg" style="width: 225px; height: 155px;" /></a><br /><a href="index.html"><img  alt="" src="uploads/vinaphone.jpg" style="width: 225px; height: 155px;" /></a><br /><a href="index.html" target="_blank"><img  alt="" src="uploads/standeescoop-03-banner-web.jpg" style="width: 225px; height: 204px;" /></a><br /><br />
</div>
</div>
<div class="box-border m-bottom">
<div class="header-block1">
<h3><span>THỐNG KẾ</span></h3>
</div>
<div class="content-box">
<div class="block-stat">
<ul>
<li class="online">
Đang truy cập: <strong>2</strong>
</li>
<li class="today">
Hôm nay: <strong>44</strong>
</li>
<li class="month">
Tháng hiện tại: <strong>2564</strong>
</li>
<li class="statistics">
Tổng lượt truy cập: <strong>277113</strong>
</li>
</ul>
</div>
</div>
</div>
</div>
<div class="clear"></div>
</div>
</div>
</div>
</div>
<div class="clear">
</div>
</div>
﻿
