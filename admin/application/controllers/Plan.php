<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plan extends CI_Controller {






    public function add()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');
            $data['message']='';
            $this->load->view('add_plan_view',$data);
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
        $this->load->model('plan_model');


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
                $this->load->view('add_plan_view',$data);

            }
            else
            {


                $data = array(

                    'name' => $this->input->post('name'),
                    'noofdays' => $this->input->post('days'),
                    'price' => $this->input->post('price')

                );

                if($this->plan_model->insert_plan($data))
                {
                    $data['message']= '<div class="alert alert-info alert-dismissable"> SucessFully Added <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                    $this->load->view('add_plan_view',$data);
                }
                else
                {
                    $data['message']= '<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                    $this->load->view('add_plan_view',$data);
                }

            }
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }





    public function plan_list()
    {


        $this->load->helper('url');

        $this->load->library('pagination');
        $this->load->model('plan_model');


        $config['base_url'] = base_url()."index.php/plan/plan_list/";
        $config['total_rows'] = $this->plan_model->count_plan();
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
        $data["allplans"] = $this->plan_model->pagination_select_plan($config["per_page"], $page);

        $str_links = $this->pagination->create_links();
        $data["links"] = $str_links ;

        $data['message']='';
        $this->load->view('includes/header_view');
        $this->load->view('includes/navigation_view');
        $this->load->view('list_plan_view',$data);
        $this->load->view('includes/footer_view');
    }




    public function delete()
    {
        $this->load->model('plan_model');
        $status=0;
        $id=$this->input->post('id');
        if($this->plan_model->delete_plan($id))
        {
            $status=1;
        }
        $data = array('status' => $status);
        echo json_encode($data);

    }


    public function sel_plan()
    {
        $this->load->model('plan_model');
        $status=0;
        $id=$this->input->post('id');
       $data= $this->plan_model->get_plan($id);

        echo json_encode($data);

    }

    public function edit($id)
    {
        $this->load->model('plan_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');

            $data['plan']=$this->plan_model->get_plan($id);
            $data['message']='';
            $this->load->view('edit_plan_view',$data);
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }



    public function editaction($id)
    {
        $this->load->model('plan_model');
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
            $data['plan'] = $this->plan_model->get_plan($id);
               $data['message']='<div class="alert alert-warning alert-dismissable"> Try after sometime <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
            $this->load->view('edit_plan_view', $data);

           }
            else {


                $data = array(

                    'name' => $this->input->post('name'),
                    'noofdays' => $this->input->post('days'),
                    'price' => $this->input->post('price')

                );

                $this->plan_model->update_plan($data, $id);

                $data['message'] = '<div class="alert alert-info alert-dismissable"> SucessFully Ediited <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';


                $data['plan'] = $this->plan_model->get_plan($id);
                $this->load->view('edit_plan_view', $data);
                $this->load->view('includes/footer_view');
           }

        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }

}
