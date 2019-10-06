<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Magazine extends CI_Controller {



			public function add()
	{
		$this->load->model('category_model');
        $this->load->helper('string');
$this->load->helper('form');
$this->load->library('form_validation');
if(($this->session->userdata('admid'))) {

$this->load->view('includes/header_view');
$this->load->view('includes/navigation_view');
$data['message']='';
$data['fileerror']='';
$data['imageerror']='';
$data['postdata']='';
$data["allcategorys"] = $this->category_model->select_all_category();
$this->load->view('add_magazine_view',$data);
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
        $this->load->helper('string');
$this->load->library('form_validation');
		$this->load->model('category_model'); 
$this->load->model('magazine_model'); 

if(($this->session->userdata('admid'))) {
$data["allcategorys"] = $this->category_model->select_all_category();
 $data['fileerror']='';
$data['imageerror']='';
$this->load->view('includes/header_view');
$this->load->view('includes/navigation_view');
$this->load->library('form_validation');
$this->form_validation->set_rules('category', 'Category', 'required|trim|strip_tags');
$this->form_validation->set_rules('title', 'Title', 'required|trim|strip_tags');
$this->form_validation->set_rules('pid', 'Productid', 'required|trim|strip_tags');
$this->form_validation->set_rules('mdate', 'Date', 'required|trim|strip_tags');
$this->form_validation->set_rules('price_inr', 'Price in rupees', 'required|trim|strip_tags');
$this->form_validation->set_rules('price_dollar', 'Price in dollars', 'required|trim|strip_tags');
$this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
if ($this->form_validation->run()== FALSE)
{
    	
         $data['message']='<div class="alert alert-warning alert-dismissable"> Try after sometime <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
    $data['postdata']=$this->input->post();
$this->load->view('add_magazine_view',$data);

}
else
{
$cphoto =" ";
$flag=0;
	    $config['upload_path']          = UPLOAD_COVERPHOTO_URL;
       $config['allowed_types']        = '*';
        //$config['max_size']             = 100;
            

                $this->load->library('upload', $config);
    $this->upload->initialize($config);
                if ( ! $this->upload->do_upload('cphoto'))
                {
                       // $error = array('imageerror' => $this->upload->display_errors());
                        $flag=1;
$data['imageerror']=$this->upload->display_errors();
                       // $this->load->view('upload_form', $error);
                }
                else
                {
                        $cphoto = $this->upload->data('file_name');

                        
                }

                $pfile =" ";
	    $config2['upload_path']          = UPLOAD_PREVIEW_URL;
        $config2['allowed_types']        = '*';
      //  $config2['max_size']             = 100;
            

                $this->load->library('upload', $config2);
    $this->upload->initialize($config2);
                if ( ! $this->upload->do_upload('pfile'))
                {
                       // $error = array('fileerror' => $this->upload->display_errors());
                        $data['fileerror']=$this->upload->display_errors();
                              $flag=1;
                       // $this->load->view('upload_form', $error);
                }
                else
                {
                         $pfile = $this->upload->data('file_name');

                        
                }


                $mfile =" ";
	    $config3['upload_path']          = UPLOAD_MAGAZINE_URL;
        $config3['allowed_types']        = '*';
        //$config['max_size']             = 100;
            

                $this->load->library('upload', $config3);
    $this->upload->initialize($config3);
                if ( ! $this->upload->do_upload('mfile'))
                {
                       // $error = array('fileerror' => $this->upload->display_errors());
                        $data['fileerror']=$this->upload->display_errors();
                          $flag=1;
                       // $this->load->view('upload_form', $error);
                }
                else
                {
                        $mfile = $this->upload->data('file_name');

                        
                }


if($flag!=1)
{
			
	  $data2 = array(
	
'title' => $this->input->post('title'),
'product_id' => $this->input->post('pid'),
'category_id' => $this->input->post('category'),
'magazine_file' => $mfile,
'cover_image' => $cphoto,
'preview_file' => $pfile,
'date' => $this->input->post('mdate'),
'price_inr' => $this->input->post('price_inr'),
'price_dollar' => $this->input->post('price_dollar'),
'user_id' => $this->session->userdata('admid')
   
);

	   if($this->magazine_model->insert_magazine($data2))
 {
 	  $data['message']= '<div class="alert alert-info alert-dismissable"> SucessFully Added <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
 
 }
 else
 {
 	 $data['message']= '<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';

 }
 $data['fileerror']='';
$data['imageerror']='';
$data['postdata']=$this->input->post();
 $this->load->view('add_magazine_view',$data);
}
else
{
    $data['postdata']=$this->input->post();

	 $data['message']= '<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
	 $this->load->view('add_magazine_view',$data);
}

}


$this->load->view('includes/footer_view');
}
else
{

	  redirect(base_url().'index.php/admin/login/');	
	}
}





public function mag_list()
{


$this->load->helper('url');
$this->load->helper('text');

$this->load->library('pagination');
$this->load->model('magazine_model'); 


$config['base_url'] = base_url()."index.php/magazine/mag_list/";
$config['total_rows'] = $this->magazine_model->count_magazine();
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
$data["allmagazines"] = $this->magazine_model->pagination_select_magazine($config["per_page"], $page);

$str_links = $this->pagination->create_links();
$data["links"] = $str_links ;

$data['message']='';
$this->load->view('includes/header_view');
$this->load->view('includes/navigation_view');
$this->load->view('list_magazine_view',$data);
$this->load->view('includes/footer_view');
}




public function delete()
{
$this->load->helper("file");	
$this->load->model('magazine_model'); 
$status=0;
$id=$this->input->post('id');
$row=$this->magazine_model->get_magazine($id);
if(trim($row['magazine_file'])!=" ")
 unlink(UPLOAD_URL.$row['magazine_file']);
if(trim($row['cover_image'])!=" ")
 unlink(UPLOAD_URL.$row['cover_image']);
if(trim($row['preview_file'])!=" ")
 unlink(UPLOAD_URL.$row['preview_file']);

if($this->magazine_model->delete_magazine($id))
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
if(($this->session->userdata('admid'))) {

$this->load->view('includes/header_view');
$this->load->view('includes/navigation_view');

$data['category']=$this->category_model->get_category($id);
$data['message']='';
$this->load->view('edit_magazine_view',$data);
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
if(($this->session->userdata('admid'))) {

$this->load->view('includes/header_view');
$this->load->view('includes/navigation_view');


$home=" ";
	if(isset($_POST['home']))
	{
$home=$this->input->post('home');
	}
		
	  $data = array(
	
'category_name' => $this->input->post('category'),
'home' => $home,
'user_id' => $this->session->userdata('admid')
   
);

	   $this->category_model->update_category($data,$id);
 
 	  $data['message']= '<div class="alert alert-info alert-dismissable"> SucessFully Ediited <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
 	
 


$data['category']=$this->category_model->get_category($id);
$this->load->view('edit_magazine_view',$data);
$this->load->view('includes/footer_view');
}
else
{

	  redirect(base_url().'index.php/admin/login/');	
	}
}



    function do_upload($path)
    {

        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|png';

        $config['max_size'] = '100';



        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {

            $error = array('error' => $this->upload->display_errors());

            $this->load->view('upload_form', $error);

        }

        else

        {

            $data = array('upload_data' => $this->upload->data());

            //$this->load->view('upload_success', $data);
        }

    }
}
