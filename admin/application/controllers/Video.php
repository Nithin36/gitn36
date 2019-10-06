<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class video extends CI_Controller {






    public function add($id)
    {
        $this->load->helper('form');
        $this->load->model('course_model');
        $this->load->library('form_validation');
        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');
            $data['message']='';
            $data['fileerror']='';
            $data['imageerror']='';
            $data['postdata']='';
            $data['course']=$this->course_model->get_course($id);
            $this->load->view('add_video_view',$data);
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
        $this->load->model('video_model');
        $this->load->model('course_model');



        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'required|trim|strip_tags');
            $this->form_validation->set_rules('paid', 'paid', 'required|trim|strip_tags|numeric');
            $data['fileerror']='';
            $data['imageerror']='';

            $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            if ($this->form_validation->run()== FALSE)
            {
                $data['postdata']=$this->input->post();
                $data['course']=$this->course_model->get_course($id);
                $data['message']='<div class="alert alert-warning alert-dismissable"> Try after sometime <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                $this->load->view('add_video_view',$data);

            }
            else
            {




                $vphoto =" ";
                $flag=0;
                $config['upload_path']          = UPLOAD_COVERPHOTO_URL;
                $config['allowed_types']        = 'gif|jpg|png';
                $config['file_name']            = random_string('alnum', 4)."_".$_FILES["vphoto"]["name"];

                //$config['max_size']             = 100;


                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ( ! $this->upload->do_upload('vphoto'))
                {
                    // $error = array('imageerror' => $this->upload->display_errors());
                    $flag=1;
                    $data['imageerror']=$this->upload->display_errors();
                    // $this->load->view('upload_form', $error);
                }
                else
                {
                    $vphoto = $this->upload->data('file_name');


                }

                $pfile =" ";
                $config2['upload_path']          = UPLOAD_VIDEO_URL;
                $config2['allowed_types']        = '*';
                //$config2['allowed_types']        = 'mp4';
                $config['file_name']            = random_string('alnum', 4)."_".$_FILES["vfile"]["name"];
                //  $config2['max_size']             = 100;

                $vfile =" ";
                $this->load->library('upload', $config2);
                $this->upload->initialize($config2);
                if ( ! $this->upload->do_upload('vfile'))
                {
                    $flag=1;
                    // $error = array('fileerror' => $this->upload->display_errors());
                    $data['fileerror']=$this->upload->display_errors();

                    // $this->load->view('upload_form', $error);
                }
                else
                {
                    $vfile = $this->upload->data('file_name');


                }
                if($flag!=1) {
                    $data['course']=$this->course_model->get_course($id);
                    $data2 = array(

                        'title' => $this->input->post('title'),
                        'course' => $data['course']['id'],
                        'coursename' => $data['course']['name'],
                        'video' => $vfile,
                        'image' => $vphoto,
                        'paid' => $this->input->post('paid')

                    );

                    if ($this->video_model->insert_video($data2)) {

                        $data['fileerror']='';
                        $data['imageerror']='';
                        $data['postdata']='';
                        $data['message'] = '<div class="alert alert-info alert-dismissable"> SucessFully Added <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                        $this->load->view('add_video_view', $data);
                    } else {
                        $data['postdata']=$this->input->post();

                        $data['message'] = '<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                        $this->load->view('add_video_view', $data);
                    }
                }
                else
                {
                    $data['postdata']=$this->input->post();

                    $data['course']=$this->course_model->get_course($id);
                    $data['message']= '<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                    $this->load->view('add_video_view',$data);
                }

            }
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }





    public function video_list($id)
    {


        $this->load->helper('url');

        $this->load->library('pagination');
        $this->load->model('video_model');
        $this->load->model('course_model');
      //$id= $this->input->get('id');
        //$data['videos']=$this->video_model->select_all_video();
        $data['course']=$this->course_model->get_course($id);

        $config['base_url'] = base_url()."index.php/video/video_list/".$id;
        $config['total_rows'] = $this->video_model->count_video($id);
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
        $data["allvideos"] = $this->video_model->pagination_select_video($config["per_page"], $page,$id);

        $str_links = $this->pagination->create_links();
        $data["links"] = $str_links ;

        $data['message']='';
        $this->load->view('includes/header_view');
        $this->load->view('includes/navigation_view');
        $this->load->view('list_video_view',$data);
        $this->load->view('includes/footer_view');
    }




    public function delete()
    {
        $this->load->model('video_model');
        $status=0;
        $id=$this->input->post('id');
        $video=$this->video_model->get_video($id);
        if(trim($video['video']!=""))
        {
            unlink(UPLOAD_VIDEO_URL.$video['video']);
        }
        if(trim($video['image']!=""))
        {
            unlink(UPLOAD_COVERPHOTO_URL.$video['image']);
        }
        if($this->video_model->delete_video($id))
        {
            $status=1;
        }
        $data = array('status' => $status);
        echo json_encode($data);

    }




    public function edit($id)
    {
        $this->load->model('video_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('course_model');

        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');

            $data['video']=$this->video_model->get_video($id);
            $data['course']=$this->course_model->get_course( $data['video']['course']);
            $data['message']='';
            $this->load->view('edit_video_view',$data);
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
        $this->load->model('video_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('course_model');
        $video=$this->video_model->get_video($id);

        $data['course']=$this->course_model->get_course( $video['course']);
        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');
            $this->form_validation->set_rules('title', 'Title', 'required|trim|strip_tags');
            $this->form_validation->set_rules('paid', 'paid', 'required|trim|strip_tags|numeric');
            $data['fileerror']='';
            $data['imageerror']='';
            $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            if ($this->form_validation->run()== FALSE)
            {


                $data['message']='<div class="alert alert-warning alert-dismissable"> Try after sometime <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                $this->load->view('edit_video_view', $data);

            }
            else {

                $vphoto =$video['image'];
                if ($_FILES['vphoto']['size']>0) {
                    unlink(UPLOAD_COVERPHOTO_URL.$video['image']);
                    $flag = 0;
                    $config['upload_path'] = UPLOAD_COVERPHOTO_URL;
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['file_name'] = random_string('alnum', 4) . "_" . $_FILES["vphoto"]["name"];

                    //$config['max_size']             = 100;


                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('vphoto')) {
                        // $error = array('imageerror' => $this->upload->display_errors());
                        $flag = 1;
                        $data['imageerror'] = $this->upload->display_errors();
                        // $this->load->view('upload_form', $error);
                    } else {
                        $vphoto = $this->upload->data('file_name');


                    }
                }
                $vfile = $video['video'];;
                if ($_FILES['vfile']['size']>0) {
                    unlink(UPLOAD_VIDEO_URL.$video['video']);
                    $config2['upload_path'] = UPLOAD_VIDEO_URL;
                    $config2['allowed_types'] = '*';
                    //$config2['allowed_types']        = 'mp4';
                    $config['file_name'] = random_string('alnum', 4) . "_" . $_FILES["vfile"]["name"];
                    //  $config2['max_size']             = 100;


                    $this->load->library('upload', $config2);
                    $this->upload->initialize($config2);
                    if (!$this->upload->do_upload('vfile')) {
                        $flag = 1;
                        // $error = array('fileerror' => $this->upload->display_errors());
                        $data['fileerror'] = $this->upload->display_errors();

                        // $this->load->view('upload_form', $error);
                    } else {
                        $vfile = $this->upload->data('file_name');


                    }
                }

                $data2 = array(

                    'title' => $this->input->post('title'),
                    'course' => $data['course']['id'],
                    'coursename' => $data['course']['name'],
                    'video' => $vfile,
                    'image' => $vphoto,
                    'paid' => $this->input->post('paid')

                );

                $this->video_model->update_video($data2, $id);

                $data['message'] = '<div class="alert alert-info alert-dismissable"> SucessFully Ediited <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';


                $data['video'] = $this->video_model->get_video($id);

                $this->load->view('edit_video_view', $data);
                $this->load->view('includes/footer_view');
            }

        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }



}
