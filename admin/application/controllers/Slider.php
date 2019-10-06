<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends CI_Controller {



			public function add()
	{
		$this->load->model('slider_model');
        $this->load->helper('string');
$this->load->helper('form');
$this->load->library('form_validation');

if(($this->session->userdata('admid'))) {
    $this->load->view('includes/header_view');
    $this->load->view('includes/navigation_view');
    $this->form_validation->set_rules('sliderurl', 'Slider Url', 'required|trim');

    $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
    if ($this->form_validation->run()== FALSE)
    {
        $data['postdata']=$this->input->post();
        $data['imageerror'] = '';
        $data['message']='';
        $this->load->view('add_slider_view',$data);

    }
    else {
        $data['message']='';
        $data['imageerror']='';
        $this->load->view('add_slider_view',$data);
    }


$this->load->view('includes/footer_view');
}
else
{

	  redirect(base_url().'index.php/admin/login/');	
	}
}
//$youtubechannelarray= explode('/',$this->input->post('youtubechannelurl'));
//$youtubechannel=end($youtubechannelarray);

			public function addaction()
	{

		$this->load->helper('form');
        $this->load->helper('string');
$this->load->library('form_validation');
	
$this->load->model('slider_model'); 

if(($this->session->userdata('admid'))) {

$data['imageerror']='';
$this->load->view('includes/header_view');
$this->load->view('includes/navigation_view');
    $this->form_validation->set_rules('sliderurl', 'Title', 'required|trim');

    $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
    if ($this->form_validation->run()== FALSE)
    {
        $data['postdata']=$this->input->post();
        $data['imageerror'] = '';
        $data['message']='<div class="alert alert-warning alert-dismissable"> Try after sometime <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
        $this->load->view('add_slider_view',$data);

    }
    else {
        $data['message']='';
        $data['imageerror']='';
        $sphoto =" ";
        $flag=0;
        $config['upload_path']          = UPLOAD_SLIDER_URL;
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = random_string('alnum', 4)."_".$_FILES["sphoto"]["name"];
        //$config['max_size']             = 100;


        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('sphoto'))
        {
            // $error = array('imageerror' => $this->upload->display_errors());
            $flag=1;
            $data['imageerror']=$this->upload->display_errors();
            // $this->load->view('upload_form', $error);
        }
        else
        {
            $sphoto = $this->upload->data('file_name');


        }



        if($flag!=1)
        {
            $sliderurlarray= explode('/',$this->input->post('sliderurl'));
            $sliderurlid=end($sliderurlarray);
            $data2 = array(
                'image_url' => $sphoto,
                'user_id' => $this->session->userdata('admid'),
                'slider_url' => $this->input->post('sliderurl'),
                'sliderid' => $sliderurlid

            );

            if($this->slider_model->insert_slider($data2))
            {
                $data['message']= '<div class="alert alert-info alert-dismissable"> SucessFully Added <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';

            }
            else
            {
                $data['message']= '<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';

            }

            $this->load->view('add_slider_view',$data);
        }
        else
        {
            $data['message']= '<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
            $data['postdata']=$this->input->post();
            $data['imageerror'] = '<div class="alert alert-warning alert-dismissable"> Please upload image. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
            $this->load->view('add_slider_view',$data);
        }
    }






$this->load->view('includes/footer_view');
}
else
{

	  redirect(base_url().'index.php/admin/login/');	
	}
}





public function sld_list()
{


$this->load->helper('url');
$this->load->helper('text');

$this->load->library('pagination');
$this->load->model('slider_model'); 


$config['base_url'] = base_url()."index.php/slider/sld_list/";
$config['total_rows'] = $this->slider_model->count_slider();
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
$data["allsliders"] = $this->slider_model->pagination_select_slider($config["per_page"], $page);

$str_links = $this->pagination->create_links();
$data["links"] = $str_links ;

$data['message']='';
$this->load->view('includes/header_view');
$this->load->view('includes/navigation_view');
$this->load->view('list_slider_view',$data);
$this->load->view('includes/footer_view');
}




public function delete()
{
$this->load->helper("file");	
$this->load->model('slider_model'); 
$status=0;
$id=$this->input->post('id');
$row=$this->slider_model->get_slider($id);

if(trim($row['image_url'])!=" ")
 unlink(UPLOAD_SLIDER_URL.$row['image_url']);


if($this->slider_model->delete_slider($id))
{
$status=1;
}
$data = array('status' => $status);
echo json_encode($data);

}


    public function edit($id)
    {
        $this->load->model('slider_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');

            $data['slider']=$this->slider_model->get_slider($id);
            $data['message']='';
            $this->load->view('edit_slider_view',$data);
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }



    public function editaction($id)
    {
        $this->load->model('slider_model');
        $this->load->helper('form');
        $this->load->helper('string');

        if(($this->session->userdata('admid'))) {
            $data['imageerror'] = "";
            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');


            $this->load->library('form_validation');
            $this->form_validation->set_rules('sliderurl', 'Slider Url', 'required|trim|strip_tags');

            $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            if ($this->form_validation->run()== FALSE)
            {
                $data['postdata']=$this->input->post();
                $data['message']='<div class="alert alert-warning alert-dismissable"> Try after sometime <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                $this->load->view('edit_slider_view',$data);

            }
            else {

                $slider= $this->slider_model->get_slider($id);
                $sphoto = $slider['image_url'];
                if ($_FILES["sphoto"]["size"] > 0) {
                    $flag = 0;
                    $config['upload_path'] = UPLOAD_SLIDER_URL;
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['file_name'] = random_string('alnum', 4) . "_" . $_FILES["sphoto"]["name"];


                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('sphoto')) {
                        // $error = array('imageerror' => $this->upload->display_errors());
                        $flag = 1;
                        $data['imageerror'] = $this->upload->display_errors();
                        // $this->load->view('upload_form', $error);
                    } else {
                        $sphoto = $this->upload->data('file_name');


                    }
                }
                $sliderurlarray= explode('/',$this->input->post('sliderurl'));
                $sliderurlid=end($sliderurlarray);
                $data2 = array(
                    'image_url' => $sphoto,
                    'user_id' => $this->session->userdata('admid'),
                    'slider_url' => $this->input->post('sliderurl'),
                    'sliderid' => $sliderurlid

                );

                $this->slider_model->update_slider($data2, $id);

                $data['message'] = '<div class="alert alert-info alert-dismissable"> SucessFully Ediited <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';


                $data['slider'] = $this->slider_model->get_slider($id);
                $this->load->view('edit_slider_view', $data);
            }
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }



}
