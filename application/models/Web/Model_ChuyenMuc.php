<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_ChuyenMuc extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function checkNumber()
	{
		$sql = "SELECT * FROM chuyenmuc WHERE TrangThai = 1";
		$result = $this->db->query($sql);
		return $result->num_rows();
	}

	public function getAll($start = 0, $end = 10){
		$sql = "SELECT * FROM chuyenmuc WHERE TrangThai = 1 ORDER BY MaChuyenMuc DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($start, $end));
		return $result->result_array();
	}

	public function getAllCategory($start = 0, $end = 6){
		$sql = "SELECT cm.TenChuyenMuc, cm.DuongDan AS DuongDanChuyenMuc, cm.HinhAnh AS HinhAnhChuyenMuc, COUNT(sp.Masach) AS SoLuongSach FROM chuyenmuc cm LEFT JOIN sach sp ON cm.MaChuyenMuc = sp.MaChuyenMuc WHERE cm.TrangThai = 1 GROUP BY cm.TenChuyenMuc, cm.DuongDan ORDER BY cm.MaChuyenMuc DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($start, $end));
		return $result->result_array();
	}

	public function getById($MaChuyenMuc){
		$sql = "SELECT * FROM chuyenmuc WHERE MaChuyenMuc = ? AND TrangThai = 1";
		$result = $this->db->query($sql, array($MaChuyenMuc));
		return $result->result_array();
	}

	public function getBySlug($DuongDan,$start = 0, $end = 9){
		$sql = "SELECT chuyenmuc.TenChuyenMuc, sach.* FROM chuyenmuc, sach WHERE sach.MaChuyenMuc = chuyenmuc.MaChuyenMuc AND chuyenmuc.DuongDan = ? AND chuyenmuc.TrangThai = 1 ORDER BY sach.Masach DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($DuongDan,$start,$end));
		return $result->result_array();
	}

	public function checkNumberProduct($MaChuyenMuc)
	{
		$sql = "SELECT * FROM sach WHERE TrangThai = 1 AND MaChuyenMuc = ?";
		$result = $this->db->query($sql, array($MaChuyenMuc));
		return $result->num_rows();
	}

	public function getCategoryDisplay()
	{
		$sql = "SELECT * FROM chuyenmuc WHERE TrangThai = 1 AND HienThiTrenMenu = 1 ORDER BY MaChuyenMuc DESC";
		$result = $this->db->query($sql);
		return $result->result_array();
	}
}

/* End of file Model_ChuyenMuc.php */
/* Location: ./application/models/Model_ChuyenMuc.php */