<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index2()
	{
		$this->load->view('welcome_message');
	}

	public function index()
	{
		$this->load->helper('form');
$this->load->library('form_validation');
$data['message']='';
		$this->load->view('login_view',$data);
	}

		public function loginaction()
	{

$this->load->helper('form');
$this->load->library('form_validation');
$this->load->model('admin_model'); 
$msg=' <div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Not Authorised to  login .</div>';

$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
$this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable">', '</div>');

if ($this->form_validation->run()== FALSE)
{
//  echo "nithin";
//echo validation_errors();
	$data['message']='';
$this->load->view('login_view',$data);

}
else {
$data3=$this->admin_model->get_adminlogin($this->input->post('email'),$this->input->post('password'));
if(count($data3)!=0)
{

$this->session->set_userdata('admid', $data3['id']);  

  redirect(base_url().'index.php/category/cat_list/');

}
$data['message']=$msg;
$this->load->view('login_view',$data);
}
		
	}


			public function login()
	{
$data['message']='';
$this->load->helper('form');
$this->load->library('form_validation');
$this->load->view('login_view',$data);
}

			public function dashboard()
	{

if(($this->session->userdata('admid'))) {
$this->load->view('includes/header_view');
$this->load->view('includes/navigation_view');
$this->load->view('dashboard_view');
$this->load->view('includes/footer_view');
}
else
{

	  redirect(base_url().'index.php/admin/login/');	
	}
}



			public function logout()
	{

$this->session->sess_destroy();

	  redirect(base_url().'index.php/admin/login/');	
	
}
}
