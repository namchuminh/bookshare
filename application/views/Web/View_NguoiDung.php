<?php require(APPPATH.'views/web/layouts/header.php'); ?>
<!-- START SECTION BREADCRUMB -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1><?php echo $fullname; ?></h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Trang Chủ</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url('nguoi-dung/'); ?>">Người Dùng</a></li>
                    <li class="breadcrumb-item active"><?php echo $fullname; ?></li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<div class="section" style="padding: 30px 0;">
    <div class="container">
        <div class="row profile">
            <div class="col-lg-3 col-md-4">
                <div class="profile-sidebar dashboard_menu">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img src="<?php echo $detail[0]['AnhChinh'] ?>" class="img-responsive" alt="">
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            <?php echo $fullname; ?>
                        </div>
                        <div class="profile-usertitle-job">
                            <?php echo $detail[0]['TaiKhoan'] ?>
                        </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->
                    <div class="profile-userbuttons">
                        <button type="button" class="btn btn-fill-out"><i class="fa-solid fa-triangle-exclamation"></i> Tố Cáo</button>
                    </div>
                    <!-- END SIDEBAR BUTTONS -->
                    <!-- SIDEBAR MENU -->
                    <div class="profile-usermenu">
                       Thông Tin
                    </div>
                    <!-- END MENU -->
                   
                    <div class="portlet light bordered">
                        <!-- STAT -->
                        <div class="row list-separated profile-stat">
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <div class="uppercase profile-stat-title"> <?php echo count($book); ?> </div>
                                <div class="uppercase profile-stat-text"> SÁCH </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <div class="uppercase profile-stat-title"> <?php echo $avgRate; ?> </div>
                                <div class="uppercase profile-stat-text"> ĐÁNH GIÁ (<?php echo $avgRate; ?> / 5) </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <div class="uppercase profile-stat-title"> <?php echo $avgReport; ?> </div>
                                <div class="uppercase profile-stat-text"> TỐ CÁO </div>
                            </div>
                        </div>
                        <!-- END STAT -->
                         <div>
                            <h5 class="profile-desc-title">NGÀY THAM GIA</h5>
                            <span class="profile-desc-text"> <?php echo date("d-m-Y H:i:s", strtotime($detail[0]['NgayThamGia'])); ?></span>
                            <div class="margin-top-20 profile-desc-link">
                                <i class="fa-solid fa-phone"></i>
                                <a href="#"><?php echo $detail[0]['SoDienThoai'] ?></a>
                            </div>
                            <div class="margin-top-20 profile-desc-link">
                                <i class="fa-solid fa-envelope"></i>
                                <a href="#"><?php echo $detail[0]['Email'] ?></a>
                            </div>
                        </div>
                    </div>                   
                </div>
                <br>
                <div class="sidebar">
                    <div class="widget">
                        <h5 class="widget_title">Mới Nhất</h5>
                        <ul class="widget_recent_post">
                            <?php foreach ($new as $key => $value): ?>
                                <?php if($key >= 5){ break; } ?>
                                <li>
                                    <div class="post_img">
                                        <a href="<?php echo base_url('sach/'.$value['DuongDan'].'/'); ?>"><img style="height: 100px; width: 100px;" src="<?php echo $value['HinhAnh'] ?>" alt="shop_small1"></a>
                                    </div>
                                    <div class="post_content">
                                        <h6 class="product_title" style="white-space: unset;"><a href="<?php echo base_url('sach/'.$value['DuongDan'].'/'); ?>"><?php echo $value['TenSach']; ?></a></h6>
                                        <div class="product_price">
                                            <span class="price"><?php echo number_format($value['GiaMuon']); ?></span>
                                            <del><?php echo number_format($value['GiaGoc']); ?></del>
                                        </div>
                                        <div class="rating_wrap">
                                            <div class="rating">
                                                <div class="product_rate" style="width:100%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
                <?php if(count($banner1) >= 1){ ?>
                    <div class="widget">
                        <div class="shop_banner">
                            <a href="<?php echo base_url('chuyen-muc/'.$banner1[0]['DuongDan'].'/'); ?>" class="banner_img">
                                <img style="height: 350px;" src="<?php echo $banner1[0]['HinhAnh'] ?>" alt="sidebar_banner_img">
                            </a> 
                        </div>
                    </div>
                <?php } ?>
                <br>
                <div class="widget">
                    <h5 class="widget_title">Phổ Biến</h5>
                    <ul class="widget_recent_post">
                        <?php foreach ($popular as $key => $value): ?>
                            <?php if($key >= 5){ break; } ?>
                            <li>
                                <div class="post_img">
                                    <a href="<?php echo base_url('sach/'.$value['DuongDan'].'/'); ?>"><img style="height: 100px; width: 100px;" src="<?php echo $value['HinhAnh'] ?>" alt="shop_small1"></a>
                                </div>
                                <div class="post_content">
                                    <h6 class="product_title" style="white-space: unset;"><a href="<?php echo base_url('sach/'.$value['DuongDan'].'/'); ?>"><?php echo $value['TenSach']; ?></a></h6>
                                    <div class="product_price">
                                        <span class="price"><?php echo number_format($value['GiaMuon']); ?></span>
                                        <del><?php echo number_format($value['GiaGoc']); ?></del>
                                    </div>
                                    <div class="rating_wrap">
                                        <div class="rating">
                                            <div class="product_rate" style="width:100%"></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 col-md-8">
                <div class="profile-content dashboard_menu" style="box-shadow: 0 0px 4px 0 #ffffff;">
                    <div class="row shop_container list">  
                        <?php if(count($book) <= 0){ ?>        
                            Người Dùng Chưa Đăng Sách!
                        <?php }else{ ?>           
                            <?php foreach ($book as $key => $value): ?>                
                                <div class="col-md-4 col-6">
                                    <div class="product">
                                        <div class="product_img">
                                            <a href="<?php echo base_url("sach/".$value['DuongDan'].'/'); ?>">
                                                <img style="height: 290px;" src="<?php echo $value['AnhChinh']; ?>" alt="<?php echo $value['TenSach']; ?>">
                                            </a>
                                            <div class="product_action_box">
                                                <ul class="list_none pr_action_btn">
                                                    <li class="add-to-cart" value="<?php echo $value['MaSach']; ?>"><a href="#"><i class="icon-basket-loaded"></i> Thêm Giỏ Hàng</a></li>
                                                    <li><a href="#"><i class="icon-heart"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product_info" style="padding: 40px 30px;">
                                            <h6 class="product_title"><a href="<?php echo base_url("sach/".$value['DuongDan'].'/'); ?>"><?php echo $value['TenSach']; ?></a></h6>
                                            <div class="product_price">
                                                <span class="price"><?php echo number_format($value['GiaMuon']); ?></span>
                                                <?php if($value['GiaMuon'] != $value['GiaGoc']){ ?>
                                                    <del><?php echo number_format($value['GiaGoc']); ?></del>
                                                    <?php $phan_tram_khuyen_mai = ($value['GiaGoc'] - $value['GiaMuon']) / $value['GiaGoc'] * 100; ?>
                                                <?php } ?>
                                            </div>
                                            <div class="rating_wrap">
                                                <div class="rating">
                                                    <div class="product_rate" style="width:<?php echo $this->Model_BinhLuan->getRateByIdBook($value['MaSach']); ?>%"></div>
                                                </div>
                                                <span class="rating_num">(<?php echo $this->Model_BinhLuan->getNumberUserRateByIdBook($value['MaSach']); ?>)</span>
                                            </div>
                                            <div class="pr_desc">
                                                <?php 
                                                    echo substr($value['MoTaNgan'], 0, 150);
                                                ?>
                                            </div>
                                            <div class="list_product_action_box">
                                                <ul class="list_none pr_action_btn">
                                                    <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i> Thêm Giỏ Hàng</a></li>
                                                    <li><a href="#"><i class="icon-heart"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php } ?>
                    </div>
                    <div class="row">
                    <div class="col-12">
                        <ul class="pagination mt-3 justify-content-center pagination_style1">
                            <li class="page-item"><a class="page-link" href="http://localhost/book/sach/trang/1/">1</a></li>
                        </ul>
                    </div>
                </div>                
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    /* Profile container */
.profile {
  margin:0;
}

/* Profile sidebar */
.profile-sidebar {
  padding: 20px 0 10px 0;
  background: #fff;
}

.profile-userpic img {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 100px;
  height: 100px;
  -webkit-border-radius: 50% !important;
  -moz-border-radius: 50% !important;
  border-radius: 50% !important;
}

.profile-usertitle {
  text-align: center;
  margin-top: 20px;
}

.profile-usertitle-name {
  color: #5a7391;
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 7px;
}

.profile-usertitle-job {
  text-transform: uppercase;
  color: #5b9bd1;
  font-size: 12px;
  font-weight: 600;
  margin-bottom: 15px;
}

.profile-userbuttons {
  text-align: center;
  margin-top: 10px;
}

.profile-userbuttons .btn {
  text-transform: uppercase;
  font-size: 11px;
  font-weight: 600;
  padding: 6px 15px;
  margin-right: 5px;
}

.profile-userbuttons .btn:last-child {
  margin-right: 0px;
}
    
.profile-usermenu {
  margin-top: 30px;
  color: #93a3b5;
  font-size: 14px;
  font-weight: 400;
  font-size: 14px;
  color: #5b9bd1;
  background-color: #f6f9fb;
  text-align: center;
  font-weight: 500;
  margin-bottom: 5px;
}


.profile-usermenu :hover {
  background-color: #fafcfd;
  color: #5b9bd1;
}


.profile-usermenu ul li.active a {
  color: #5b9bd1;
  background-color: #f6f9fb;
  border-left: 2px solid #5b9bd1;
  margin-left: -2px;
}

/* Profile Content */
.profile-content {
  background: #fff;
  min-height: 100%;
}


.portlet {
    margin-top: 0;
    margin-bottom: 25px;
    padding: 0;
    border-radius: 4px;
}

.portlet.light {
    padding: 12px 20px 15px;
    background-color: #fff;
}

.list-separated {
    margin-top: 10px;
    margin-bottom: 15px;
}
.profile-stat {
    padding-bottom: 20px;
    border-bottom: 1px solid #f0f4f7;
}
.profile-stat-title {
    color: #7f90a4;
    font-size: 25px;
    text-align: center;
}
.uppercase {
    text-transform: uppercase!important;
}

.profile-stat-text {
    color: #5b9bd1;
    font-size: 10px;
    font-weight: 600;
    text-align: center;
}
.profile-desc-title {
    color: #7f90a4;
    font-size: 17px;
    font-weight: 600;
}
.profile-desc-text {
    color: #7e8c9e;
    font-size: 14px;
}
.margin-top-20 {
    margin-top: 20px!important;
}
[class*=" fa-"]:not(.fa-stack), [class*=" glyphicon-"], [class*=" icon-"], [class^=fa-]:not(.fa-stack), [class^=glyphicon-], [class^=icon-] {
    display: inline-block;
    line-height: 14px;
    -webkit-font-smoothing: antialiased;
}
.profile-desc-link i {
    width: 22px;
    font-size: 19px;
    color: #abb6c4;
    margin-right: 5px;
}

</style>

<?php require(APPPATH.'views/web/layouts/footer.php'); ?>
