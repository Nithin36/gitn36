<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {






			public function add()
	{
$this->load->helper('form');
        $this->load->helper('string');
$this->load->library('form_validation');
if(($this->session->userdata('admid'))) {

$this->load->view('includes/header_view');
$this->load->view('includes/navigation_view');
$data['message']='';
$this->load->view('add_category_view',$data);
$this->load->view('includes/footer_view');
}
else
{

	  redirect(base_url().'index.php/admin/login/');	
	}
}


			public function addaction()
	{
		$this->load->helper('form');
$this->load->library('form_validation');
        $this->load->helper('string');
		$this->load->model('category_model'); 


if(($this->session->userdata('admid'))) {

$this->load->view('includes/header_view');
$this->load->view('includes/navigation_view');
$this->load->library('form_validation');
$this->form_validation->set_rules('category', 'Category', 'required|trim|strip_tags');
$this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
if ($this->form_validation->run()== FALSE)
{
    	
         $data['message']='<div class="alert alert-warning alert-dismissable"> Try after sometime <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
$this->load->view('add_category_view',$data);

}
else
{


       $data = array(

'category_name' => $this->input->post('category'),
'user_id' => $this->session->userdata('admid')

);

     if($this->category_model->insert_category($data))
 {
    $data['message']= '<div class="alert alert-info alert-dismissable"> SucessFully Added <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
  $this->load->view('add_category_view',$data);
 }
 else
 {
   $data['message']= '<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
$this->load->view('add_category_view',$data);
 }





//    $data['imageerror'] ="";
//    $cphoto =" ";
//    if($_FILES["cphoto"]["size"]>0) {
//        $flag = 0;
//        $config['upload_path'] = UPLOAD_CATEGORY_URL;
//        $config['allowed_types'] = 'gif|jpg|png';
//        $config['file_name'] = random_string('alnum', 4) . "_" . $_FILES["cphoto"]["name"];
//
//
//        $this->load->library('upload', $config);
//        $this->upload->initialize($config);
//        if (!$this->upload->do_upload('cphoto')) {
//            // $error = array('imageerror' => $this->upload->display_errors());
//            $flag = 1;
//            $data['imageerror'] = $this->upload->display_errors();
//            // $this->load->view('upload_form', $error);
//        } else {
//            $cphoto = $this->upload->data('file_name');
//
//
//        }
//    }
//	  $data = array(
//
//'category_name' => $this->input->post('category'),
//          'image' => $cphoto,
//'user_id' => $this->session->userdata('admid')
//
//);
//
//	   if($this->category_model->insert_category($data))
// {
// 	  $data['message']= '<div class="alert alert-info alert-dismissable"> SucessFully Added <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
// 	$this->load->view('add_category_view',$data);
// }
// else
// {
// 	 $data['message']= '<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
//$this->load->view('add_category_view',$data);
// }

}
$this->load->view('includes/footer_view');
}
else
{

	  redirect(base_url().'index.php/admin/login/');	
	}
}





public function cat_list()
{


$this->load->helper('url');

$this->load->library('pagination');
$this->load->model('category_model'); 


$config['base_url'] = base_url()."index.php/category/cat_list/";
$config['total_rows'] = $this->category_model->count_category();
$config['per_page'] = 50; 
$config['full_tag_open'] = '<ul class="pagination pagination-sm">';
$config['full_tag_close'] = '</ul>';
$config['first_link'] = 'First';
$config['first_tag_open'] = '<li>';
$config['first_tag_close'] = '</li>';

$config['last_link'] = 'Last';
$config['last_tag_open'] = '<li>';
$config['last_tag_close'] = '</li>';

$config['next_link'] = 'Next Page';
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '</li>';

$config['prev_link'] = 'Previous Page';
$config['prev_tag_open'] = '<li >';
$config['prev_tag_close'] = '</li>';


$config['cur_tag_open'] ='<li class="active">';
$config['cur_tag_close'] = '</li>';

$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';



$this->pagination->initialize($config);
if($this->uri->segment(3)){
$page = ($this->uri->segment(3)) ;

}
else{
$page = 0;
}
$data["allcategorys"] = $this->category_model->pagination_select_category($config["per_page"], $page);

$str_links = $this->pagination->create_links();
$data["links"] = $str_links ;

$data['message']='';
$this->load->view('includes/header_view');
$this->load->view('includes/navigation_view');
$this->load->view('list_category_view',$data);
$this->load->view('includes/footer_view');
}




public function delete()
{
$this->load->model('category_model'); 
$status=0;
$id=$this->input->post('id');
    $category=$this->category_model->get_category($id);
 
if($this->category_model->delete_category($id))
{
$status=1;
}
$data = array('status' => $status);
echo json_encode($data);

}




			public function edit($id)
	{
$this->load->model('category_model'); 
$this->load->helper('form');
$this->load->library('form_validation');
$this->load->helper('string');
if(($this->session->userdata('admid'))) {

$this->load->view('includes/header_view');
$this->load->view('includes/navigation_view');

$data2['category']=$this->category_model->get_category($id);
$data2['message']='';
$this->load->view('edit_category_view',$data2);
$this->load->view('includes/footer_view');
}
else
{

	  redirect(base_url().'index.php/admin/login/');	
	}
}



			public function editaction($id)
	{
$this->load->model('category_model'); 
$this->load->helper('form');
$this->load->library('form_validation');
$this->load->helper('string');
if(($this->session->userdata('admid'))) {

$this->load->view('includes/header_view');
$this->load->view('includes/navigation_view');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('category', 'Category', 'required|trim|strip_tags');
    $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
    if ($this->form_validation->run()== FALSE)
    {

        $data['message']='<div class="alert alert-warning alert-dismissable"> Try after sometime <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
        $data['category'] = $this->category_model->get_category($id);
        $this->load->view('edit_category_view', $data);

    }
    else {
        $category = $this->category_model->get_category($id);
      

        $data3 = array(

            'category_name' => $this->input->post('category'),
      
            'user_id' => $this->session->userdata('admid')

        );

        $this->category_model->update_category($data3, $id);

        $data['message'] = '<div class="alert alert-info alert-dismissable"> SucessFully Ediited <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';


        $data['category'] = $this->category_model->get_category($id);
        $this->load->view('edit_category_view', $data);
    }
$this->load->view('includes/footer_view');
}
else
{

	  redirect(base_url().'index.php/admin/login/');	
	}
}

}
