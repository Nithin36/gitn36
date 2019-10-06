<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paylog extends CI_Controller {






    public function add()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');
            $data['message']='';
            $this->load->view('add_paylog_view',$data);
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
        $this->load->model('paylog_model');


        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Category', 'required|trim|strip_tags');
            $this->form_validation->set_rules('days', 'No Of Days', 'required|trim|strip_tags|numeric');
            $this->form_validation->set_rules('price', 'Price', 'required|trim|strip_tags|numeric');
            $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            if ($this->form_validation->run()== FALSE)
            {

                $data['message']='<div class="alert alert-warning alert-dismissable"> Try after sometime <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                $this->load->view('add_paylog_view',$data);

            }
            else
            {


                $data = array(

                    'name' => $this->input->post('name'),
                    'noofdays' => $this->input->post('days'),
                    'price' => $this->input->post('price')

                );

                if($this->paylog_model->insert_paylog($data))
                {
                    $data['message']= '<div class="alert alert-info alert-dismissable"> SucessFully Added <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                    $this->load->view('add_paylog_view',$data);
                }
                else
                {
                    $data['message']= '<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                    $this->load->view('add_paylog_view',$data);
                }

            }
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }
    public function searchlist2()
    {
        print_r($_POST);
    }
    public function searchlist()
    {




        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->model('paylog_model');
        $name=" ";
  if(isset($_POST['name']))
  {
      $name = trim($this->input->post('name'));
  }
        if(isset($_GET['name']))
        {
            $name = trim($this->input->get('name'));
        }
        $config['base_url'] = base_url()."index.php/paylog/searchlist/?name=".$name;
        $config['total_rows'] = $this->paylog_model->count_paylog_search($name);
        $config['per_page'] = 50;
        $config['enable_query_strings']=TRUE;
        $config['page_query_string']=TRUE;
        $config['reuse_query_string'] = TRUE;
        //$config['query_string_segment'] =$name;
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
        if(isset($_GET['per_page'])){
            $page = $_GET['per_page'] ;

        }
        else{
            $page = 1;
        }
        $data["allpaylogs"] = $this->paylog_model->pagination_select_paylog_search($config["per_page"], $page,$name);

        $str_links = $this->pagination->create_links();
        $data["links"] = $str_links ;

        $data['message']='';
        $this->load->view('includes/header_view');
        $this->load->view('includes/navigation_view');
        $this->load->view('list_paylog_view',$data);
        $this->load->view('includes/footer_view');

    }



    public function paylog_list()
    {


        $this->load->helper('url');

        $this->load->library('pagination');
        $this->load->model('paylog_model');


        $config['base_url'] = base_url()."index.php/paylog/paylog_list/";
        $config['total_rows'] = $this->paylog_model->count_paylog();
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
        $data["allpaylogs"] = $this->paylog_model->pagination_select_paylog($config["per_page"], $page);

        $str_links = $this->pagination->create_links();
        $data["links"] = $str_links ;

        $data['message']='';
        $this->load->view('includes/header_view');
        $this->load->view('includes/navigation_view');
        $this->load->view('list_paylog_view',$data);
        $this->load->view('includes/footer_view');
    }




    public function delete()
    {
        $this->load->model('paylog_model');
        $status=0;
        $id=$this->input->post('id');
        if($this->paylog_model->delete_paylog($id))
        {
            $status=1;
        }
        $data = array('status' => $status);
        echo json_encode($data);

    }


    public function sel_paylog()
    {
        $this->load->model('paylog_model');
        $status=0;
        $id=$this->input->post('id');
        $data= $this->paylog_model->get_paylog($id);

        echo json_encode($data);

    }

    public function edit($id)
    {
        $this->load->model('paylog_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');

            $data['paylog']=$this->paylog_model->get_paylog($id);
            $data['message']='';
            $this->load->view('edit_paylog_view',$data);
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }



    public function editaction($id)
    {
        $this->load->model('paylog_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');

            $this->form_validation->set_rules('name', 'name', 'required|trim|strip_tags');
            $this->form_validation->set_rules('days', 'No Of Days', 'required|trim|strip_tags|numeric');
            $this->form_validation->set_rules('price', 'Price', 'required|trim|strip_tags|numeric');
            $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            if ($this->form_validation->run()== FALSE)
            {
                $data['paylog'] = $this->paylog_model->get_paylog($id);
                $data['message']='<div class="alert alert-warning alert-dismissable"> Try after sometime <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                $this->load->view('edit_paylog_view', $data);

            }
            else {


                $data = array(

                    'name' => $this->input->post('name'),
                    'noofdays' => $this->input->post('days'),
                    'price' => $this->input->post('price')

                );

                $this->paylog_model->update_paylog($data, $id);

                $data['message'] = '<div class="alert alert-info alert-dismissable"> SucessFully Ediited <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';


                $data['paylog'] = $this->paylog_model->get_paylog($id);
                $this->load->view('edit_paylog_view', $data);
                $this->load->view('includes/footer_view');
            }

        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }

}
