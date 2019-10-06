<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class faq extends CI_Controller {






    public function add()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('string');
        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');
            $data['message']='';
            $data['imageerror'] ='';
            $this->load->model('category_model'); 
            $data["allcategorys"] = $this->category_model->select_all_category();
            $this->load->view('add_faq_view',$data);
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
        $this->load->model('faq_model');
        $this->load->helper('string');
  $this->load->model('category_model'); 
            $data["allcategorys"] = $this->category_model->select_all_category();
        $data['imageerror'] ='';

        if(($this->session->userdata('admid'))) {

                $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'required|trim|strip_tags');
      
            $this->form_validation->set_rules('category', 'category', 'required|trim|strip_tags');
            $this->form_validation->set_rules('description', 'Description', 'required|trim|strip_tags');
            $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            if ($this->form_validation->run()== FALSE)
            {
                $data['postdata']=$this->input->post();
                $data['message']='<div class="alert alert-warning alert-dismissable"> Try after sometime <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                $this->load->view('add_faq_view',$data);

            }
            else
            {
                $data['imageerror'] ="";
                $ephoto =" ";
   
                $data2 = array(
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'category'=>$this->input->post('category')
                );

                if($this->faq_model->insert_faq($data2))
                {

                    $data['message']= '<div class="alert alert-info alert-dismissable"> SucessFully Added <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                    $this->load->view('add_faq_view',$data);
                }
                else
                {
                    $data['postdata']=$this->input->post();
                    $data['message']= '<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                    $this->load->view('add_faq_view',$data);
                }

            }
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }





    public function faq_list()
    {


        $this->load->helper('url');

        $this->load->library('pagination');
        $this->load->model('faq_model');


        $config['base_url'] = base_url()."index.php/faq/faq_list/";
        $config['total_rows'] = $this->faq_model->count_faq();
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
        $data["allfaqs"] = $this->faq_model->pagination_select_faq($config["per_page"], $page);

        $str_links = $this->pagination->create_links();
        $data["links"] = $str_links ;

        $data['message']='';
        $this->load->view('includes/header_view');
        $this->load->view('includes/navigation_view');
        $this->load->view('list_faq_view',$data);
        $this->load->view('includes/footer_view');
    }




    public function delete()
    {
        $this->load->model('faq_model');
        $status=0;
        $id=$this->input->post('id');
        $faq=$this->faq_model->get_faq($id);
        if($this->faq_model->delete_faq($id))
        {
   
            $status=1;
        }
        $data = array('status' => $status);
        echo json_encode($data);

    }




    public function edit($id)
    {
        $this->load->model('faq_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('category_model'); 
        $data["allcategorys"] = $this->category_model->select_all_category();
        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');

            $data['faq']=$this->faq_model->get_faq($id);
            $data['message']='';
            $this->load->view('edit_faq_view',$data);
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }



    public function editaction($id)
    {
        $this->load->model('faq_model');
        $this->load->helper('form');
        $this->load->helper('string');
        $this->load->model('category_model'); 
        $data["allcategorys"] = $this->category_model->select_all_category();

        if(($this->session->userdata('admid'))) {
            $data['imageerror'] = "";
            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');


            $this->load->library('form_validation');
 $this->form_validation->set_rules('title', 'Title', 'required|trim|strip_tags');
      
            $this->form_validation->set_rules('category', 'category', 'required|trim|strip_tags');
            $this->form_validation->set_rules('description', 'Description', 'required|trim|strip_tags');
            $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            if ($this->form_validation->run()== FALSE)
            {
                $data['postdata']=$this->input->post();
                $data['message']='<div class="alert alert-warning alert-dismissable"> Try after sometime <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                $this->load->view('add_faq_view',$data);

            }
            else {

                $faq= $this->faq_model->get_faq($id);
             

                    $data2 = array(
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'category'=>$this->input->post('category')
                );
                

                $this->faq_model->update_faq($data2, $id);

                $data['message'] = '<div class="alert alert-info alert-dismissable"> SucessFully Ediited <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';


                $data['faq'] = $this->faq_model->get_faq($id);
                $this->load->view('edit_faq_view', $data);
            }
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }

}
