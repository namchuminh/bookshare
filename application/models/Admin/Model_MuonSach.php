<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_MuonSach extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function checkNumber()
	{	
		$sql = "SELECT * FROM muonsach";
		$result = $this->db->query($sql);
		return $result->num_rows();
	}

	public function getAll($start = 0, $end = 10){
		$sql = "SELECT muonsach.*, nguoidung.MaNguoiDung AS MNDMuon, nguoidung.TaiKhoan, sach.TenSach, sach.MaSach, sach.AnhChinh, sach.MaNguoiDung AS MNDSach FROM muonsach, sach, nguoidung WHERE muonsach.MaSach = sach.MaSach AND muonsach.MaNguoiDung = nguoidung.MaNguoiDung ORDER BY muonsach.MaMuonSach DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($start, $end));
		return $result->result_array();
	}

	public function getUserBook($mangoidung){
		$sql = "SELECT * FROM nguoidung WHERE MaNguoiDung = ?";
		$result = $this->db->query($sql, array($mangoidung));
		return $result->result_array();
	}

	public function getById($MaMuonSach){
		$sql = "SELECT muonsach.*, nguoidung.MaNguoiDung AS MNDMuon, nguoidung.TaiKhoan, sach.TenSach, sach.MaSach, sach.AnhChinh, sach.MaNguoiDung AS MNDSach FROM muonsach, sach, nguoidung WHERE muonsach.MaSach = sach.MaSach AND muonsach.MaNguoiDung = nguoidung.MaNguoiDung AND muonsach.MaMuonSach = ?";
		$result = $this->db->query($sql, array($MaMuonSach));
		return $result->result_array();
	}


	public function status($trangthai,$MaMuonSach){
		$sql = "UPDATE muonsach SET TrangThai = ? WHERE MaMuonSach = ?";
		$result = $this->db->query($sql, array($trangthai,$MaMuonSach));
		return $result;
	}

	public function getProductById($masanpham){
		$sql = "SELECT * FROM sanpham WHERE MaSanPham = ?";
		$result = $this->db->query($sql, array($masanpham));
		return $result->result_array();
	}

	public function updateNumberProduct($soluong,$masanpham){
		$sql = "UPDATE sanpham SET SoLuong = ? WHERE MaSanPham = ?";
		$result = $this->db->query($sql, array($soluong,$masanpham));
		return $result;
	}

	public function checkNumberSearch($madonhang,$thanhtoan,$trangthai){
		$sql = "SELECT khachhang.HoTen, khachhang.MaKhachHang, hoadon.MaHoaDon, hoadon.MaKhachHang, hoadon.TongTien, hoadon.ThoiGian, hoadon.ThanhToan, COALESCE(magiamgia.GiaTriGiam, 0) AS GiaTriGiam, hoadon.SoLuong, hoadon.DiaChi, hoadon.TrangThai FROM hoadon INNER JOIN khachhang ON hoadon.MaKhachHang = khachhang.MaKhachHang LEFT JOIN magiamgia ON hoadon.MaGiamGia = magiamgia.MaGiamGia WHERE hoadon.MaHoaDon = ? OR hoadon.ThanhToan = ? OR hoadon.TrangThai = ? ORDER BY hoadon.MaHoaDon";
		$result = $this->db->query($sql, array($madonhang,$thanhtoan,$trangthai));
		return $result->num_rows();
	}

	public function search($madonhang,$thanhtoan,$trangthai,$start = 0, $end = 10){
		$sql = "SELECT khachhang.HoTen, khachhang.MaKhachHang, hoadon.MaHoaDon, hoadon.MaKhachHang, hoadon.TongTien, hoadon.ThoiGian, hoadon.ThanhToan, COALESCE(magiamgia.GiaTriGiam, 0) AS GiaTriGiam, hoadon.SoLuong, hoadon.DiaChi, hoadon.TrangThai FROM hoadon INNER JOIN khachhang ON hoadon.MaKhachHang = khachhang.MaKhachHang LEFT JOIN magiamgia ON hoadon.MaGiamGia = magiamgia.MaGiamGia WHERE hoadon.MaHoaDon = ? OR hoadon.ThanhToan = ? OR hoadon.TrangThai = ? ORDER BY hoadon.MaHoaDon DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($madonhang,$thanhtoan,$trangthai,$start,$end));
		return $result->result_array();
	}

	public function checkNumberType($type){
		if($type == "thang"){
			$sql = "SELECT khachhang.HoTen, khachhang.MaKhachHang, hoadon.MaHoaDon, hoadon.MaKhachHang, hoadon.TongTien, hoadon.ThoiGian, hoadon.ThanhToan, COALESCE(magiamgia.GiaTriGiam, 0) AS GiaTriGiam, hoadon.SoLuong, hoadon.DiaChi, hoadon.TrangThai FROM hoadon INNER JOIN khachhang ON hoadon.MaKhachHang = khachhang.MaKhachHang LEFT JOIN magiamgia ON hoadon.MaGiamGia = magiamgia.MaGiamGia WHERE MONTH(hoadon.ThoiGian) = ? AND YEAR(hoadon.ThoiGian) = YEAR(CURDATE()) ORDER BY hoadon.MaHoaDon DESC";
			$result = $this->db->query($sql, array(date('m')));
			return $result->num_rows();
		}else if($type == "tuan"){
			$sql = "SELECT khachhang.HoTen, khachhang.MaKhachHang, hoadon.MaHoaDon, hoadon.MaKhachHang, hoadon.TongTien, hoadon.ThoiGian, hoadon.ThanhToan, COALESCE(magiamgia.GiaTriGiam, 0) AS GiaTriGiam, hoadon.SoLuong, hoadon.DiaChi, hoadon.TrangThai FROM hoadon INNER JOIN khachhang ON hoadon.MaKhachHang = khachhang.MaKhachHang LEFT JOIN magiamgia ON hoadon.MaGiamGia = magiamgia.MaGiamGia WHERE hoadon.ThoiGian BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() + 1 ORDER BY hoadon.MaHoaDon DESC";
			$result = $this->db->query($sql, array(date('m')));
			return $result->num_rows();
		}
	}

	public function getType($type,$start = 0,$end = 10){
		if($type == "thang"){
			$sql = "SELECT khachhang.HoTen, khachhang.MaKhachHang, hoadon.MaHoaDon, hoadon.MaKhachHang, hoadon.TongTien, hoadon.ThoiGian, hoadon.ThanhToan, COALESCE(magiamgia.GiaTriGiam, 0) AS GiaTriGiam, hoadon.SoLuong, hoadon.DiaChi, hoadon.TrangThai FROM hoadon INNER JOIN khachhang ON hoadon.MaKhachHang = khachhang.MaKhachHang LEFT JOIN magiamgia ON hoadon.MaGiamGia = magiamgia.MaGiamGia WHERE MONTH(hoadon.ThoiGian) = ? AND YEAR(hoadon.ThoiGian) = YEAR(CURDATE()) ORDER BY hoadon.MaHoaDon DESC LIMIT ?, ?";
			$result = $this->db->query($sql, array(date('m'), $start, $end));
			return $result->result_array();
		}else if($type == "tuan"){
			$sql = "SELECT khachhang.HoTen, khachhang.MaKhachHang, hoadon.MaHoaDon, hoadon.MaKhachHang, hoadon.TongTien, hoadon.ThoiGian, hoadon.ThanhToan, COALESCE(magiamgia.GiaTriGiam, 0) AS GiaTriGiam, hoadon.SoLuong, hoadon.DiaChi, hoadon.TrangThai FROM hoadon INNER JOIN khachhang ON hoadon.MaKhachHang = khachhang.MaKhachHang LEFT JOIN magiamgia ON hoadon.MaGiamGia = magiamgia.MaGiamGia WHERE hoadon.ThoiGian BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() + 1 ORDER BY hoadon.MaHoaDon DESC LIMIT ?, ?";
			$result = $this->db->query($sql, array($start, $end));
			return $result->result_array();
		}
	}

}

/* End of file Model_ChuyenMuc.php */
/* Location: ./application/models/Model_ChuyenMuc.php */