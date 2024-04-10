<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_NguoiDung extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function getById($manguoidung){
		$sql = "SELECT * FROM nguoidung WHERE MaNguoiDung = ?";
		$result = $this->db->query($sql, array($manguoidung));
		return $result->result_array();
	}

	public function insert($hoten,$taikhoan,$matkhau,$sodienthoai,$email,$diachi){
		$sql = "INSERT INTO `nguoidung`(`HoTen`, `TaiKhoan`, `MatKhau`, `SoDienThoai`, `Email`, `DiaChi`) VALUES (?, ?, ?, ?, ?, ?)";
		$result = $this->db->query($sql, array($hoten,$taikhoan,$matkhau,$sodienthoai,$email,$diachi));
		return $result;
	}


	public function getOrderById($manguoidung){
		$sql = "SELECT * FROM hoadon WHERE Manguoidung = ? ORDER BY MaHoaDon DESC";
		$result = $this->db->query($sql, array($manguoidung));
		return $result->result_array();
	}

	public function update($hoten,$matkhau,$sodienthoai,$email,$diachhi,$manguoidung){
		$sql = "UPDATE `nguoidung` SET `HoTen` = ?, `MatKhau` = ?, `SoDienThoai` = ?, `Email` = ?, `DiaChi` = ? WHERE Manguoidung = ?";
		$result = $this->db->query($sql, array($hoten,$matkhau,$sodienthoai,$email,$diachhi,$manguoidung));
		return $result;
	}

	public function getWallet($manguoidung){
		$sql = "SELECT * FROM vitien WHERE MaNguoiDung = ?";
		$result = $this->db->query($sql, array($manguoidung));
		return $result->result_array();
	}

	public function updateMoneyWallet($sotienmoi,$dasudung,$manguoidung){
		$sql = "UPDATE vitien SET SoDuKhaDung = ?, DaSuDung = ? WHERE MaNguoiDung = ?";
		$result = $this->db->query($sql, array($sotienmoi,$dasudung,$manguoidung));
		return $result;
	}

}	

/* End of file Model_nguoidung.php */
/* Location: ./application/models/Model_nguoidung.php */