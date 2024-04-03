<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'TrangChu';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['admin'] = 'Admin/TrangChu';
$route['admin/doanh-thu-thang'] = 'Admin/TrangChu/sumRevenue';
$route['admin/don-hang-thang'] = 'Admin/TrangChu/sumOrder';

$route['admin/dang-nhap'] = 'Admin/DangNhap/index';
$route['admin/dang-xuat'] = 'Admin/DangXuat/index';

$route['admin/chuyen-muc'] = 'Admin/ChuyenMuc';
$route['admin/chuyen-muc/(:any)/trang'] = 'Admin/ChuyenMuc/page/$1';
$route['admin/chuyen-muc/them'] = 'Admin/ChuyenMuc/add';
$route['admin/chuyen-muc/(:any)/sua'] = 'Admin/ChuyenMuc/update/$1';
$route['admin/chuyen-muc/(:any)/xoa'] = 'Admin/ChuyenMuc/delete/$1';

$route['admin/dong-tien'] = 'Admin/DongTien';
$route['admin/dong-tien/(:any)/trang'] = 'Admin/DongTien/page/$1';
$route['admin/dong-tien/tim-kiem'] = 'Admin/DongTien/search';
$route['admin/dong-tien/tim-kiem/(:any)/trang'] = 'Admin/DongTien/pageSearch/$1';


$route['admin/rut-tien'] = 'Admin/RutTien';
$route['admin/rut-tien/(:any)/trang'] = 'Admin/RutTien/page/$1';
$route['admin/rut-tien/them'] = 'Admin/RutTien/add';
$route['admin/rut-tien/(:any)/sua'] = 'Admin/RutTien/update/$1';
$route['admin/rut-tien/(:any)/xoa'] = 'Admin/RutTien/delete/$1';

$route['admin/rut-tien'] = 'Admin/RutTien';
$route['admin/rut-tien/(:any)/trang'] = 'Admin/RutTien/page/$1';
$route['admin/rut-tien/(:any)/xem'] = 'Admin/RutTien/view/$1';
$route['admin/rut-tien/(:any)/xac-nhan'] = 'Admin/RutTien/accept/$1';
$route['admin/rut-tien/(:any)/huy'] = 'Admin/RutTien/cancel/$1';

$route['admin/cau-hinh'] = 'Admin/CauHinh';

$route['admin/nguoi-dung'] = 'Admin/NguoiDung';
$route['admin/nguoi-dung/(:any)/trang'] = 'Admin/NguoiDung/page/$1';
$route['admin/nguoi-dung/(:any)/xem'] = 'Admin/NguoiDung/view/$1';
$route['admin/nguoi-dung/tim-kiem'] = 'Admin/NguoiDung/search';
$route['admin/nguoi-dung/tim-kiem/(:any)/trang'] = 'Admin/NguoiDung/pageSearch/$1';
$route['admin/nguoi-dung/(:any)/trang-thai'] = 'Admin/NguoiDung/status/$1';
$route['admin/nguoi-dung/(:any)/vi-tien'] = 'Admin/NguoiDung/wallet/$1';
$route['admin/nguoi-dung/vi-tien/tru'] = 'Admin/NguoiDung/subMoney';
$route['admin/nguoi-dung/vi-tien/cong'] = 'Admin/NguoiDung/addMoney';
$route['admin/nguoi-dung/(:any)/dong-tien'] = 'Admin/NguoiDung/cashFlow/$1';
$route['admin/nguoi-dung/(:any)/dong-tien/(:any)/trang'] = 'Admin/NguoiDung/pageCashFlow/$1/$2';


$route['admin/ca-nhan'] = 'Admin/CaNhan';

$route['admin/giao-dien'] = 'Admin/GiaoDien';
$route['admin/giao-dien/(:any)/trang'] = 'Admin/GiaoDien/page/$1';
$route['admin/giao-dien/them'] = 'Admin/GiaoDien/add';
$route['admin/giao-dien/(:any)/sua'] = 'Admin/GiaoDien/update/$1';
$route['admin/giao-dien/(:any)/xoa'] = 'Admin/GiaoDien/delete/$1';

$route['admin/muon-sach'] = 'Admin/MuonSach';
$route['admin/muon-sach/(:any)/trang'] = 'Admin/MuonSach/page/$1';
$route['admin/muon-sach/(:any)/trang-thai'] = 'Admin/MuonSach/status/$1';
$route['admin/muon-sach/(:any)/thanh-toan'] = 'Admin/MuonSach/pay/$1';
$route['admin/muon-sach/(:any)/huy'] = 'Admin/MuonSach/cancel/$1';
$route['admin/muon-sach/(:any)/trang-thai'] = 'Admin/MuonSach/status/$1';
$route['admin/muon-sach/tim-kiem'] = 'Admin/MuonSach/search';
$route['admin/muon-sach/tim-kiem/(:any)/trang'] = 'Admin/MuonSach/pageSearch/$1';


$route['admin/sach'] = 'Admin/Sach';
$route['admin/sach/(:any)/trang'] = 'Admin/Sach/page/$1';
$route['admin/sach/them'] = 'Admin/Sach/add';
$route['admin/sach/(:any)/sua'] = 'Admin/Sach/update/$1';
$route['admin/sach/(:any)/xoa'] = 'Admin/Sach/delete/$1';
$route['admin/sach/(:any)/trang-thai'] = 'Admin/Sach/status/$1';


$route['admin/binh-luan'] = 'Admin/BinhLuan';
$route['admin/binh-luan/(:any)/trang'] = 'Admin/BinhLuan/page/$1';
$route['admin/binh-luan/(:any)/xem'] = 'Admin/BinhLuan/view/$1';
$route['admin/binh-luan/(:any)/xoa'] = 'Admin/BinhLuan/delete/$1';


$route['san-pham'] = 'Web/SanPham/index';
$route['san-pham/(:any)'] = 'Web/SanPham/detail/$1';
$route['san-pham/trang/(:any)'] = 'Web/SanPham/page/$1';

$route['tin-tuc'] = 'Web/TinTuc/index';
$route['tin-tuc/(:any)'] = 'Web/TinTuc/detail/$1';
$route['tin-tuc/trang/(:any)'] = 'Web/TinTuc/page/$1';

$route['chuyen-muc'] = 'Web/ChuyenMuc/index';
$route['chuyen-muc/(:any)'] = 'Web/ChuyenMuc/detail/$1';
$route['chuyen-muc/trang/(:any)'] = 'Web/ChuyenMuc/page/$1';
$route['chuyen-muc/(:any)/trang/(:any)'] = 'Web/ChuyenMuc/detailPage/$1/$2';

$route['lien-he'] = 'Web/LienHe';
$route['dang-nhap'] = 'Web/DangNhap';
$route['dang-xuat'] = 'Web/DangXuat';
$route['dang-ky'] = 'Web/DangNhap/register';

$route['gio-hang'] = 'Web/GioHang';
$route['gio-hang/sua/(:any)/(:any)'] = 'Web/GioHang/updateNumber/$1/$2';
$route['gio-hang/them/(:any)/(:any)'] = 'Web/GioHang/add/$1/$2';
$route['gio-hang/xoa/(:any)'] = 'Web/GioHang/delete/$1';
$route['gio-hang/giam-gia/(:any)'] = 'Web/GioHang/code/$1';

$route['thanh-toan'] = 'Web/ThanhToan';

$route['khach-hang'] = 'Web/KhachHang';
$route['khach-hang/sua'] = 'Web/KhachHang/update';
$route['khach-hang/don-hang/(:any)/xem'] = 'Web/KhachHang/order/$1';
$route['khach-hang/don-hang/(:any)/huy'] = 'Web/KhachHang/cancel/$1';



