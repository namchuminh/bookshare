<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MuonSach extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('taikhoan')){
			return redirect(base_url('admin/dang-nhap/'));
		}

		$this->load->model('Admin/Model_MuonSach');
	}

	public function index()
	{
		$totalRecords = $this->Model_MuonSach->checkNumber();
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		$data['totalPages'] = $totalPages;
		$data['list'] = $this->Model_MuonSach->getAll();
		$data['title'] = "Danh sách đang mượn";
		return $this->load->view('Admin/View_MuonSach', $data);
	}

	public function page($trang){
		$data['title'] = "Danh sách hóa đơn";
		$totalRecords = $this->Model_MuonSach->checkNumber();
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		if($trang < 1){
			return redirect(base_url('admin/muon-sach/'));
		}

		if($trang > $totalPages){
			return redirect(base_url('admin/muon-sach/'));
		}

		$start = ($trang - 1) * $recordsPerPage;


		if($start == 0){
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_MuonSach->getAll();
			return $this->load->view('Admin/View_MuonSach', $data);
		}else{
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_MuonSach->getAll($start);
			return $this->load->view('Admin/View_MuonSach', $data);
		}
	}

	public function status($mamuonsach){
		if(count($this->Model_MuonSach->getById($mamuonsach)) <= 0){
			$this->session->set_flashdata('error', 'Thông tin mượn sách không tồn tại!');
			return redirect(base_url('admin/muon-sach/'));
		}

		$data['detail'] = $this->Model_MuonSach->getById($mamuonsach);
		$data['title'] = "Trạng thái mượn sách";

		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$trangthai = $this->input->post('trangthai');

			if(($trangthai != 0) && ($trangthai != 1) && ($trangthai != 2) && ($trangthai != 3) && ($trangthai != 4)){
				$this->session->set_flashdata('error', 'Trạng thái mượn sách không hợp lệ!');
				return redirect(base_url('admin/muon-sach/'.$mamuonsach.'/trang-thai/'));
			}

			$this->Model_MuonSach->status($trangthai,$mamuonsach);
			
			$data['detail'] = $this->Model_MuonSach->getById($mamuonsach);
			$this->session->set_flashdata('success', 'Cập nhật trạng thái mượn sách thành công!');
			return $this->load->view('Admin/View_TrangThaiMuon', $data);
		}
		return $this->load->view('Admin/View_TrangThaiMuon', $data);
	}

	public function pay($mahoadon)
	{
		if(count($this->Model_MuonSach->getById($mahoadon)) <= 0){
			$this->session->set_flashdata('error', 'Hóa đơn không tồn tại!');
			return redirect(base_url('admin/muon-sach/'));
		}

		$detail = $this->Model_MuonSach->getById($mahoadon);

		if(($detail[0]['ThanhToan'] != 1) && ($detail[0]['TrangThai'] != 0) && ($detail[0]['TrangThai'] != 4)){
			$this->Model_MuonSach->updatePay($mahoadon);
			$this->session->set_flashdata('success', 'Xác nhận thanh toán thành công!');
			return redirect(base_url('admin/muon-sach/'.$mahoadon.'/xem/'));
		}else{
			$this->session->set_flashdata('error', 'Không được phép thực hiện!');
			return redirect(base_url('admin/muon-sach/'.$mahoadon.'/xem/'));
		}
	}


	public function cancel($mahoadon){
		if(count($this->Model_MuonSach->getById($mahoadon)) <= 0){
			$this->session->set_flashdata('error', 'Hóa đơn không tồn tại!');
			return redirect(base_url('admin/muon-sach/'));
		}

		$detail = $this->Model_MuonSach->getById($mahoadon);

		if(($detail[0]['TrangThai'] <= 2) && ($detail[0]['TrangThai'] != 0) && ($detail[0]['TrangThai'] != 4)){
			$this->Model_MuonSach->cancel($mahoadon);

			$detailOrder = $this->Model_MuonSach->getDetailById($mahoadon);

			foreach ($detailOrder as $key => $value) {
				$soluongmoi = $this->Model_MuonSach->getProductById($value['MaSanPham'])[0]['SoLuong'] + $value['SoLuong'];
				$this->Model_MuonSach->updateNumberProduct($soluongmoi,$value['MaSanPham']);
			}

			$this->session->set_flashdata('success', 'Hủy đơn hàng thành công!');
			return redirect(base_url('admin/muon-sach/'.$mahoadon.'/xem/'));
		}else{
			$this->session->set_flashdata('error', 'Không được phép thực hiện!');
			return redirect(base_url('admin/muon-sach/'.$mahoadon.'/xem/'));
		}
	}


	public function search()
	{
		if(!isset($_POST['madonhang']) && !isset($_POST['thanhtoan']) && !isset($_POST['trangthai'])){
			return redirect(base_url('admin/muon-sach/'));
		}

		$madonhang = $this->input->post('madonhang');
		$trangthai = $this->input->post('trangthai');
		$thanhtoan = $this->input->post('thanhtoan');

		if(empty($madonhang) && empty($trangthai) && empty($thanhtoan)){
			return redirect(base_url('admin/muon-sach/'));
		}

		
		$data['post'] = array(
			'madonhang' => $madonhang,
			'trangthai' => $trangthai,
			'thanhtoan' => $thanhtoan,
		);

		if($thanhtoan == -1){
			$thanhtoan = 0;
		}

		if($trangthai == -1){
			$trangthai = 0;
		}

		if(empty($_POST['thanhtoan']) || !isset($_POST['thanhtoan'])){
			$thanhtoan = -1;
		}

		if(empty($_POST['trangthai']) || !isset($_POST['trangthai'])){
			$trangthai = -1;
		}


		$totalRecords = $this->Model_MuonSach->checkNumberSearch($madonhang,$thanhtoan,$trangthai);
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		$data['totalPages'] = $totalPages;
		$data['list'] = $this->Model_MuonSach->search($madonhang,$thanhtoan,$trangthai);
		$data['title'] = "Danh sách hóa đơn";
		return $this->load->view('Admin/View_MuonSachTimKiem', $data);

	}


	public function pageSearch($trang){
		if(!isset($_GET['madonhang']) && !isset($_GET['thanhtoan']) && !isset($_GET['trangthai'])){
			return redirect(base_url('admin/muon-sach/'));
		}

		$madonhang = $this->input->get('madonhang');
		$trangthai = $this->input->get('trangthai');
		$thanhtoan = $this->input->get('thanhtoan');

		if(empty($madonhang) && empty($trangthai) && empty($thanhtoan)){
			return redirect(base_url('admin/muon-sach/'));
		}

		
		$data['post'] = array(
			'madonhang' => $madonhang,
			'trangthai' => $trangthai,
			'thanhtoan' => $thanhtoan,
		);

		if($thanhtoan == -1){
			$thanhtoan = 0;
		}

		if($trangthai == -1){
			$trangthai = 0;
		}

		if(empty($_GET['thanhtoan']) || !isset($_GET['thanhtoan'])){
			$thanhtoan = -1;
		}

		if(empty($_GET['trangthai']) || !isset($_GET['trangthai'])){
			$trangthai = -1;
		}


		$data['title'] = "Danh sách hóa đơn";
		$totalRecords = $this->Model_MuonSach->checkNumberSearch($madonhang,$thanhtoan,$trangthai);
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		if($trang < 1){
			return redirect(base_url('admin/muon-sach/'));
		}

		if($trang > $totalPages){
			return redirect(base_url('admin/muon-sach/'));
		}

		$start = ($trang - 1) * $recordsPerPage;


		if($start == 0){
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_MuonSach->search($madonhang,$thanhtoan,$trangthai);
			return $this->load->view('Admin/View_MuonSachTimKiem', $data);
		}else{
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_MuonSach->search($madonhang,$thanhtoan,$trangthai,$start);
			return $this->load->view('Admin/View_MuonSachTimKiem', $data);
		}
	}

	public function type(){
		if(!isset($_GET['type'])){
			return redirect(base_url('admin/muon-sach/'));
		}

		$type = $this->input->get('type');

		if(($type != "thang") && ($type != "tuan")){
			return redirect(base_url('admin/muon-sach/'));
		}

		$data['post'] = array(
			"type" => $type
		);

		$totalRecords = $this->Model_MuonSach->checkNumberType($type);
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		$data['totalPages'] = $totalPages;
		$data['list'] = $this->Model_MuonSach->getType($type);
		$data['title'] = "Danh sách hóa đơn";
		return $this->load->view('Admin/View_MuonSachThongKe', $data);
	}

	public function pageType($trang){
		if(!isset($_GET['type'])){
			return redirect(base_url('admin/muon-sach/'));
		}

		$type = $this->input->get('type');

		if(($type != "thang") && ($type != "tuan")){
			return redirect(base_url('admin/muon-sach/'));
		}

		$data['post'] = array(
			"type" => $type
		);

		$data['title'] = "Danh sách hóa đơn";
		$totalRecords = $this->Model_MuonSach->checkNumberType($type);
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		if($trang < 1){
			return redirect(base_url('admin/muon-sach/'));
		}

		if($trang > $totalPages){
			return redirect(base_url('admin/muon-sach/'));
		}

		$start = ($trang - 1) * $recordsPerPage;


		if($start == 0){
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_MuonSach->getType($type);
			return $this->load->view('Admin/View_MuonSachThongKe', $data);
		}else{
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_MuonSach->getType($type,$start);
			return $this->load->view('Admin/View_MuonSachThongKe', $data);
		}
	}
}

/* End of file ChuyenMuc.php */
/* Location: ./application/controllers/ChuyenMuc.php */