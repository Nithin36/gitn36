<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courseplan extends CI_Controller {






    public function add($id)
    {
        $this->load->helper('form');
        $this->load->model('course_model');
        $this->load->library('form_validation');
        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');
            $data['message']='';
            $data['postdata']='';
            $data['course']=$this->course_model->get_course($id);
            $this->load->view('add_courseplan_view',$data);
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }


    public function addaction($id)
    {
        //print_r($_POST);
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('string');
        $this->load->model('courseplan_model');
        $this->load->model('course_model');



        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Category', 'required|trim|strip_tags');
            $this->form_validation->set_rules('days', 'No Of Days', 'required|trim|strip_tags|numeric');
            $this->form_validation->set_rules('price', 'Price', 'required|trim|strip_tags|numeric');
            $data['fileerror']='';
            $data['imageerror']='';

            $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            if ($this->form_validation->run()== FALSE)
            {
                $data['postdata']=$this->input->post();
                $data['course']=$this->course_model->get_course($id);
                $data['message']='<div class="alert alert-warning alert-dismissable"> Try after sometime <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                $this->load->view('add_courseplan_view',$data);

            }
            else
            {



                    $data['course']=$this->course_model->get_course($id);
                    $data2 = array(

                        'course' => $data['course']['id'],
                        'name' => $this->input->post('name'),
                        'noofdays' => $this->input->post('days'),
                        'price' => $this->input->post('price')

                    );

                    if ($this->courseplan_model->insert_courseplan($data2)) {


                        $data['postdata']='';
                        $data['message'] = '<div class="alert alert-info alert-dismissable"> SucessFully Added <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                        $this->load->view('add_courseplan_view', $data);
                    } else {
                        $data['postdata']=$this->input->post();

                        $data['message'] = '<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                        $this->load->view('add_courseplan_view', $data);
                    }



            }
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }





    public function courseplan_list($id)
    {


        $this->load->helper('url');

        $this->load->library('pagination');
        $this->load->model('courseplan_model');
        $this->load->model('course_model');
        //$id= $this->input->get('id');
        //$data['courseplans']=$this->courseplan_model->select_all_courseplan();
        $data['course']=$this->course_model->get_course($id);

        $config['base_url'] = base_url()."index.php/courseplan/courseplan_list/".$id;
        $config['total_rows'] = $this->courseplan_model->count_courseplan($id);
        // $config[‘reuse_query_string’] = TRUE;
        $config['per_page'] = 50;
        $config['page_query_string'] = TRUE;
        $config['reuse_query_string'] = true;
        $config['use_page_numbers'] = TRUE;

        //$config['query_string_segment'] = "?id=".$id;
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
        if($this->input->get('per_page')){
            $page = ($this->input->get('per_page'))-1 ;

        }
        else{
            $page = 0;
        }
        $data["allcourseplans"] = $this->courseplan_model->pagination_select_courseplan($config["per_page"], $page,$id);

        $str_links = $this->pagination->create_links();
        $data["links"] = $str_links ;

        $data['message']='';
        $this->load->view('includes/header_view');
        $this->load->view('includes/navigation_view');
        $this->load->view('list_courseplan_view',$data);
        $this->load->view('includes/footer_view');
    }




    public function delete()
    {
        $this->load->model('courseplan_model');
        $status=0;
        $id=$this->input->post('id');
        $courseplan=$this->courseplan_model->get_courseplan($id);

        if($this->courseplan_model->delete_courseplan($id))
        {
            $status=1;
        }
        $data = array('status' => $status);
        echo json_encode($data);

    }




    public function edit($id)
    {
        $this->load->model('courseplan_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('course_model');

        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');

            $data['courseplan']=$this->courseplan_model->get_courseplan($id);
            $data['course']=$this->course_model->get_course( $data['courseplan']['course']);
            $data['message']='';
            $this->load->view('edit_courseplan_view',$data);
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }



    public function editaction($id)
    {
        $this->load->helper('string');
        $this->load->model('courseplan_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('course_model');
        $courseplan=$this->courseplan_model->get_courseplan($id);

        $data['course']=$this->course_model->get_course( $courseplan['course']);
        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');
            $this->form_validation->set_rules('name', 'name', 'required|trim|strip_tags');
            $this->form_validation->set_rules('days', 'No Of Days', 'required|trim|strip_tags|numeric');
            $this->form_validation->set_rules('price', 'Price', 'required|trim|strip_tags|numeric');

            $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            if ($this->form_validation->run()== FALSE)
            {


                $data['message']='<div class="alert alert-warning alert-dismissable"> Try after sometime <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                $this->load->view('edit_courseplan_view', $data);

            }
            else {


                $data2 = array(

                    'course' => $data['course']['id'],
                    'name' => $this->input->post('name'),
                    'noofdays' => $this->input->post('days'),
                    'price' => $this->input->post('price')

                );

                $this->courseplan_model->update_courseplan($data2, $id);

                $data['message'] = '<div class="alert alert-info alert-dismissable"> SucessFully Ediited <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';


                $data['courseplan'] = $this->courseplan_model->get_courseplan($id);

                $this->load->view('edit_courseplan_view', $data);
                $this->load->view('includes/footer_view');
            }

        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }



}
