<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller {






    public function addoffline()
    {
        $this->load->helper('form');

        $this->load->library('form_validation');
        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');
            $data['message']='';

            $this->load->view('add_offlinecourse_view',$data);
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }

    public function addonline()
    {
        $this->load->helper('form');

        $this->load->library('form_validation');
        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');
            $data['message']='';


            $this->load->view('add_onlinecourse_view',$data);
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }
    public function addofflineaction()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('course_model');




        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('course', 'course', 'required|trim|strip_tags');

            $this->form_validation->set_rules('description', 'Description', 'required|trim|strip_tags');
            $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            if ($this->form_validation->run()== FALSE)
            {

                $data['message']='<div class="alert alert-warning alert-dismissable"> Try after sometime <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                $this->load->view('add_offlinecourse_view',$data);

            }
            else
            {


                $data = array(

                    'name' => $this->input->post('course'),

                    'description' => $this->input->post('description'),
                    'online'=>0

                );

                if($this->course_model->insert_course($data))
                {
                    $data['message']= '<div class="alert alert-info alert-dismissable"> SucessFully Added <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                    $this->load->view('add_offlinecourse_view',$data);
                }
                else
                {
                    $data['message']= '<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                    $this->load->view('add_offlinecourse_view',$data);
                }

            }
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }

    public function addonlineaction()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('course_model');
        $this->load->model('courseplan_model');



        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('course', 'course', 'required|trim|strip_tags');
            $this->form_validation->set_rules('price', 'Price', 'required|trim|strip_tags|numeric');
            $this->form_validation->set_rules('description', 'Description', 'required|trim|strip_tags');
            $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            if ($this->form_validation->run()== FALSE)
            {

                $data['message']='<div class="alert alert-warning alert-dismissable"> Try after sometime <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                $this->load->view('add_onlinecourse_view',$data);

            }
            else
            {


                $data = array(

                    'name' => $this->input->post('course'),
                    'description' => $this->input->post('description'),
                    'online'=>1

                );
$insertid=$this->course_model->insert_course($data);
                if($insertid!=0)
                {
                    $data2 = array(


                        'price' => $this->input->post('price'),
                        'course'=> $insertid
                    );
                $this->courseplan_model->insert_courseplan($data2);
                    $data['message']= '<div class="alert alert-info alert-dismissable"> SucessFully Added <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                    $this->load->view('add_onlinecourse_view',$data);
                }
                else
                {
                    $data['message']= '<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                    $this->load->view('add_onlinecourse_view',$data);
                }

            }
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }



    public function offlinecourse_list()
    {


        $this->load->helper('url');

        $this->load->library('pagination');
        $this->load->model('course_model');

        $data['courses']=$this->course_model->select_all_course_offline();


        $config['base_url'] = base_url()."index.php/course/offlinecourse_list/";
        $config['total_rows'] = $this->course_model->count_course_offline();
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
        $data["allcourses"] = $this->course_model->pagination_select_course_offline($config["per_page"], $page);

        $str_links = $this->pagination->create_links();
        $data["links"] = $str_links ;

        $data['message']='';
        $this->load->view('includes/header_view');
        $this->load->view('includes/navigation_view');
        $this->load->view('list_offlinecourse_view',$data);
        $this->load->view('includes/footer_view');
    }


    public function onlinecourse_list()
    {


        $this->load->helper('url');

        $this->load->library('pagination');
        $this->load->model('course_model');

        $data['courses']=$this->course_model->select_all_course_online();


        $config['base_url'] = base_url()."index.php/course/offlinecourse_list/";
        $config['total_rows'] = $this->course_model->count_course_online();
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
        $data["allcourses"] = $this->course_model->pagination_select_course_online($config["per_page"], $page);

        $str_links = $this->pagination->create_links();
        $data["links"] = $str_links ;

        $data['message']='';
        $this->load->view('includes/header_view');
        $this->load->view('includes/navigation_view');
        $this->load->view('list_onlinecourse_view',$data);
        $this->load->view('includes/footer_view');
    }

    public function delete()
    {
        $this->load->model('course_model');
        $status=0;
        $id=$this->input->post('id');
        if($this->course_model->delete_course($id))
        {
            $status=1;
        }
        $data = array('status' => $status);
        echo json_encode($data);

    }




    public function editoffline($id)
    {
        $this->load->model('course_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('plan_model');
        $data['plans']=$this->plan_model->select_all_plan();
        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');

            $data['course']=$this->course_model->get_course($id);
            $data['message']='';
            $this->load->view('edit_offlinecourse_view',$data);
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }

    public function editonline($id)
    {
        $this->load->model('course_model');
        $this->load->model('courseplan_model');
        $this->load->helper('form');
        $this->load->library('form_validation');


        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');

            $data['course']=$this->course_model->get_course($id);
            $data['courseplan'] = $this->courseplan_model->get_courseplan_course($id);
            $data['message']='';
            $this->load->view('edit_onlinecourse_view',$data);
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }

    public function editofflineaction($id)
    {
        $this->load->model('course_model');

        $this->load->helper('form');
        $this->load->library('form_validation');


        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');

            $this->form_validation->set_rules('course', 'course', 'required|trim|strip_tags');
            $this->form_validation->set_rules('description', 'Description', 'required|trim|strip_tags');
            $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            if ($this->form_validation->run()== FALSE)
            {
                $data['course'] = $this->course_model->get_course($id);

                $data['message']='<div class="alert alert-warning alert-dismissable"> Try after sometime <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                $this->load->view('edit_offlinecourse_view', $data);

            }
            else {


                $data = array(

                    'name' => $this->input->post('course'),
                    'description' => $this->input->post('description')


                );

                $this->course_model->update_course($data, $id);

                $data['message'] = '<div class="alert alert-info alert-dismissable"> SucessFully Ediited <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';


                $data['course'] = $this->course_model->get_course($id);

                $this->load->view('edit_offlinecourse_view', $data);
                $this->load->view('includes/footer_view');
            }

        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }


    public function editonlineaction($id)
    {
        $this->load->model('course_model');
        $this->load->model('courseplan_model');
        $this->load->helper('form');
        $this->load->library('form_validation');


        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');

            $this->form_validation->set_rules('course', 'course', 'required|trim|strip_tags');
            $this->form_validation->set_rules('price', 'Price', 'required|trim|strip_tags|numeric');
            $this->form_validation->set_rules('description', 'Description', 'required|trim|strip_tags');
            $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            if ($this->form_validation->run()== FALSE)
            {
                $data['course'] = $this->course_model->get_course($id);
                $data['courseplan'] = $this->courseplan_model->get_courseplan_course($id);
                $data['message']='<div class="alert alert-warning alert-dismissable"> Try after sometime <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                $this->load->view('edit_onlinecourse_view', $data);

            }
            else {
                $data2['course'] = $this->course_model->get_course($id);

$this->courseplan_model->delete_courseplan_course($data2['course']['id']);
                $data = array(

                    'name' => $this->input->post('course'),
                    'description' => $this->input->post('description')


                );

                $this->course_model->update_course($data, $id);
                $data3 = array(


                    'price' => $this->input->post('price'),
                    'course' => $id
                );
                $this->courseplan_model->insert_courseplan($data3);


                $data['message'] = '<div class="alert alert-info alert-dismissable"> SucessFully Ediited <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';

                $data['course'] = $this->course_model->get_course($id);
                $data['courseplan'] = $this->courseplan_model->get_courseplan_course($id);
                $this->load->view('edit_onlinecourse_view', $data);
                $this->load->view('includes/footer_view');
            }

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

}
