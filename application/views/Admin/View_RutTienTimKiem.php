<?php require(APPPATH.'views/admin/layouts/header.php'); ?>
<div class="content-wrapper" style="min-height: 1203.31px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản Lý Rút Tiền</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/'); ?>">Trang Chủ</a></li>
              <li class="breadcrumb-item active">Quản Lý Rút Tiền</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <form class="row" action="<?php echo base_url('admin/rut-tien/tim-kiem/') ?>"> 
                  <div class="col-sm-2">
                    <label>Tài Khoản</label>
                    <input type="text" name="taikhoan" class="form-control" placeholder="Tài khoản" value="<?php echo $post['taikhoan']; ?>">
                  </div>
                  <div class="col-sm-2">
                    <label>Trạng Thái</label>
                    <select class="form-control" name="trangthai">
                      <option value selected>Chọn Trạng Thái</option>
                      <option value="-1" <?php if($post['trangthai'] == -1){ echo "selected"; } ?>>Đã Hủy Rút Tiền</option>
                      <option value="1" <?php if($post['trangthai'] == 1){ echo "selected"; } ?>>Chờ Admin Duyệt</option>
                      <option value="2" <?php if($post['trangthai'] == 2){ echo "selected"; } ?>>Đã Rút Tiền</option>
                    </select>
                  </div>
                  <div class="col-sm-2">
                    <label style="visibility:hidden;">Tìm Kiếm</label>
                    <br>
                    <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
                  </div>
                </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Hình Ảnh</th>
                      <th>Tài Khoản</th>
                      <th>Số Tiền Rút</th>
                      <th>Thực Nhận</th>
                      <th>Thời Gian</th>
                      <th>Trạng Thái</th>
                      <th>Xử Lý Rút Tiền</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php foreach ($list as $key => $value): ?>
	                    <tr>
	                      <td><?php echo $key + 1; ?></td>
	                       <td>
                          <img src="<?php echo $value['AnhChinh']; ?>" style="width: 100px; height: 100px;">
                        </td>
                        <td><a href="<?php echo base_url('admin/nguoi-dung/'.$value['MaNguoiDung'].'/vi-tien/') ?>"><?php echo $value['TaiKhoan']; ?></a></td>
	                      <td><?php echo number_format($value['SoTienRut']); ?> VND</td>
                        <td><?php
                          echo number_format($value['SoTienRut'] * (1 - ($phiruttien / 100))); 
                        ?> VND</td>
	                      <td>
	                      	<?php echo $value['ThoiGian']; ?>
	                      </td>
                        <td>
                          <?php if($value['TrangThai'] == 0){ ?>
                            Đã Hủy Rút Tiền
                          <?php }else if($value['TrangThai'] == 1){ ?>
                            Chờ Admin Duyệt
                          <?php }else if($value['TrangThai'] == 2){ ?>
                            Đã Rút Tiền
                          <?php } ?>
                        </td>
	                      <td>
	                      	<a href="<?php echo base_url('admin/rut-tien/'.$value['MaRutTien'].'/xem/'); ?>" class="btn btn-primary" style="color: white;">
	                      		<i class="fa-solid fa-money-bills"></i>
                            	<span>XỬ LÝ RÚT TIỀN</span>
                          </a>
	                      </td>
	                    </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
              <div class="card-footer clearfix">
                <a href="<?php echo base_url('admin/rut-tien/') ?>" class="btn btn-success">Quay Lại</a>
                <ul class="pagination pagination-sm m-0 float-right">
                	<?php for($i = 1; $i <= $totalPages; $i++){ ?>
                  		<li class="page-item"><a class="page-link" href="<?php echo base_url('admin/rut-tien/tim-kiem/'.$i.'/trang/?taikhoan='.$post['taikhoan'].'&trangthai='.$post['trangthai']) ?>"><?php echo $i; ?></a></li>
                  	<?php } ?>      
                </ul>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<?php require(APPPATH.'views/admin/layouts/footer.php'); ?>