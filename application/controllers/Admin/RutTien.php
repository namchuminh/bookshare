<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RutTien extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('taikhoan')){
			return redirect(base_url('admin/dang-nhap/'));
		}

		$this->load->model('Admin/Model_RutTien');
		$this->load->model('Admin/Model_NguoiDung');
	}

	public function index()
	{
		$totalRecords = $this->Model_RutTien->checkNumber();
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		$data['totalPages'] = $totalPages;
		$data['list'] = $this->Model_RutTien->getAll();
		$data['title'] = "Danh sách yêu cầu rút tiền";
		return $this->load->view('Admin/View_RutTien', $data);
	}

	public function page($trang){
		$data['title'] = "Danh sách yêu cầu rút tiền";
		$totalRecords = $this->Model_RutTien->checkNumber();
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		if($trang < 1){
			return redirect(base_url('admin/rut-tien/'));
		}

		if($trang > $totalPages){
			return redirect(base_url('admin/rut-tien/'));
		}

		$start = ($trang - 1) * $recordsPerPage;


		if($start == 0){
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_RutTien->getAll();
			return $this->load->view('Admin/View_RutTien', $data);
		}else{
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_RutTien->getAll($start);
			return $this->load->view('Admin/View_RutTien', $data);
		}
	}

	public function view($maruttien){
		if(count($this->Model_RutTien->getById($maruttien)) <= 0){
			$this->session->set_flashdata('error', 'Yêu cầu rút tiền không tồn tại!');
			return redirect(base_url('admin/rut-tien/'));
		}

		$data['detail'] = $this->Model_RutTien->getById($maruttien);
		$data['wallet'] = $this->Model_NguoiDung->getWallet($this->Model_RutTien->getById($maruttien)[0]['MaNguoiDung']);
		$data['title'] = "Thông tin yêu cầu rút tiền";
		return $this->load->view('Admin/View_XemRutTien', $data);
	}


	public function accept($maruttien)
	{
		if(count($this->Model_RutTien->getById($maruttien)) <= 0){
			$this->session->set_flashdata('error', 'Yêu cầu rút tiền không tồn tại!');
			return redirect(base_url('admin/rut-tien/'));
		}

		if($this->Model_RutTien->getById($maruttien)[0]['TrangThai'] != 1){
			$this->session->set_flashdata('error', 'Không được phép thực hiện!');
			return redirect(base_url('admin/rut-tien/'.$maruttien.'/xem/'));
		}

		$manguoidung = $this->Model_RutTien->getById($maruttien)[0]['MaNguoiDung'];

		$sotientru = $this->Model_RutTien->getById($maruttien)[0]['SoTienRut'];
		$noidung = "Admin trừ tiền rút ".number_format($sotientru)." VND của tài khoản!";

		$sotiencu = $this->Model_NguoiDung->getWallet($manguoidung)[0]['SoDuKhaDung'];

		if($sotientru > $sotiencu){
			$this->session->set_flashdata('error', 'Số tiền rút không được lớn hơn số dư khả dụng!');
			return redirect(base_url('admin/rut-tien/'.$maruttien.'/xem/'));
		}

		$sotienmoi = $sotiencu - $sotientru;

		$this->Model_NguoiDung->updateMoneyWallet($sotienmoi,$manguoidung);

		$this->Model_NguoiDung->insertCashFlow($manguoidung,$sotiencu,$sotientru,$sotienmoi,$noidung);

		$this->Model_RutTien->accept($maruttien);
		$this->session->set_flashdata('success', 'Xác nhận rút '.number_format($sotientru).' cho người dùng thành công!');
		return redirect(base_url('admin/rut-tien/'.$maruttien.'/xem/'));
	}

	public function cancel($maruttien)
	{
		if(count($this->Model_RutTien->getById($maruttien)) <= 0){
			$this->session->set_flashdata('error', 'Yêu cầu rút tiền không tồn tại!');
			return redirect(base_url('admin/rut-tien/'));
		}

		if($this->Model_RutTien->getById($maruttien)[0]['TrangThai'] != 1){
			$this->session->set_flashdata('error', 'Không được phép thực hiện!');
			return redirect(base_url('admin/rut-tien/'.$maruttien.'/xem/'));
		}

		$this->Model_RutTien->cancel($maruttien);

		$this->session->set_flashdata('success', 'Hủy yêu cầu rút tiền của người dùng thành công!');
		return redirect(base_url('admin/rut-tien/'.$maruttien.'/xem/'));
	}
}

/* End of file RutTien.php */
/* Location: ./application/controllers/RutTien.php */