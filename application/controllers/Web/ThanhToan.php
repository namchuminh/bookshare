<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ThanhToan extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('cart')){
			return redirect(base_url('gio-hang/'));
		}

		if(!$this->session->userdata('khachhang')){
			$newdata = array(
				'thanhtoan' => TRUE
			);
			$this->session->set_userdata($newdata);
			$this->session->set_flashdata('redirect', 'Vui lòng đăng nhập để thanh toán!');
			return redirect(base_url('dang-nhap/'));
		}

		$array_items = array('thanhtoan');
        $this->session->unset_userdata($array_items);

        $this->load->model('Web/Model_HoaDon');
        $this->load->model('Web/Model_CauHinh');
        $this->load->model('Web/Model_Sach');
        $this->load->model('Web/Model_MuonSach');
	}

	public function index()
	{
		$data['title'] = "Thanh toán";
		$cart = $this->session->userdata('cart');
        $data['list'] = $cart;
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
        	$config = $this->Model_CauHinh->getAll();
        	$makhachhang = $this->session->userdata('makhachhang');
        	$diachi = $this->input->post('diachi').", ".$this->input->post('xa').", ".$this->input->post('huyen').", ".$this->input->post('tinh');
        	$thoigiantra = $this->input->post('thoigiantra');

        	if(empty($thoigiantra)){
        		$this->session->set_flashdata('error', 'Vui lòng chọn ngày trả sách!');
        		return redirect('thanh-toan/');
        	}

        	if($thoigiantra <= date('Y-m-d')){
        		$this->session->set_flashdata('error', 'Thời gian trả sách phải khác ngày mượn!');
        		return redirect('thanh-toan/');
        	}

        	$tongtien = 0;
        
        	foreach($cart as $key => $value){
        		$tongtien = $value['number'] * $value['price_root'];
        		$this->Model_MuonSach->insert($value['id'],$this->session->userdata('makhachhang'),$tongtien,$thoigiantra,$diachi,$value['number']);
        	}

        	if (isset($_SESSION['saleCode'])) {
                unset($_SESSION['saleCode']);
            }

            if (isset($_SESSION['idSaleCode'])) {
                unset($_SESSION['idSaleCode']);
            }

            unset($_SESSION['cart']);
            unset($_SESSION['sumCart']);
            unset($_SESSION['numberCart']);
        	
        	return $this->load->view('Web/View_ThanhToanThanhCong', $data);
        }
		return $this->load->view('Web/View_ThanhToan', $data);
	}

}

/* End of file ThanhToan.php */
/* Location: ./application/controllers/ThanhToan.php */