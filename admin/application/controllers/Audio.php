<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class audio extends CI_Controller {






    public function add()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('string');
        $this->load->model('album_model');
        $this->load->model('category_model');
        if(($this->session->userdata('admid'))) {
            $data["allcategorys"] = $this->category_model->select_all_category();
            $data["allalbums"] = $this->album_model->select_all_album();
            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');
            $data['message']='';
            $this->load->view('add_audio_view',$data);
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
        $this->load->model('album_model');
        $this->load->model('audio_model');
        $this->load->model('category_model');
        $this->load->helper('string');

        if(($this->session->userdata('admid'))) {

            $data["allcategorys"] = $this->category_model->select_all_category();
            $data["allalbums"] = $this->album_model->select_all_album();
            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'required|trim|strip_tags');
            $this->form_validation->set_rules('category', 'Category', 'required|trim');
            $this->form_validation->set_rules('album', 'Album', 'required|trim');


            $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            if ($this->form_validation->run()== FALSE)
            {
                $data['postdata']=$this->input->post();
                $data['message']='<div class="alert alert-warning alert-dismissable"> Try after sometime <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                $this->load->view('add_audio_view',$data);

            }
            else
            {
                $data['imageerror'] ="";
                $aphoto =" ";
                if($_FILES["aphoto"]["size"]>0) {
                    $flag = 0;
                    $config['upload_path'] = UPLOAD_AUDIOIMAGE_URL;
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['file_name'] = random_string('alnum', 4) . "_" . $_FILES["aphoto"]["name"];


                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('aphoto')) {
                        // $error = array('imageerror' => $this->upload->display_errors());
                        $flag = 1;
                        $data['imageerror'] = $this->upload->display_errors();
                        // $this->load->view('upload_form', $error);
                    } else {
                        $aphoto = $this->upload->data('file_name');


                    }
                }

                $afile =" ";
                if($_FILES["afile"]["size"]>0) {
                    $flag = 0;
                    $config2['upload_path'] = UPLOAD_AUDIO_URL;
                    $config2['allowed_types'] = 'mp3';
                    $config2['file_name'] = random_string('alnum', 4) . "_" . $_FILES["afile"]["name"];


                    $this->load->library('upload', $config2);
                    $this->upload->initialize($config2);
                    if (!$this->upload->do_upload('afile')) {
                        // $error = array('imageerror' => $this->upload->display_errors());
                        $flag = 1;
                        $data['audioerror'] = $this->upload->display_errors();
                        // $this->load->view('upload_form', $error);
                    } else {
                        $afile = $this->upload->data('file_name');


                    }

                    $data2 = array(
                        'category' => $this->input->post('category'),
                        'album' => $this->input->post('album'),
                        'title' => $this->input->post('title'),
                        'genere' => $this->input->post('genere'),
                        'lyrics' => $this->input->post('lyrics'),
                        'singer' => $this->input->post('singer'),
                        'image' => $aphoto,
                        'audiofile' => $afile
                    );

                    if($this->audio_model->insert_audio($data2))
                    {

                        $data['message']= '<div class="alert alert-info alert-dismissable"> SucessFully Added <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                        $this->load->view('add_audio_view',$data);
                    }
                    else
                    {
                        $data['postdata']=$this->input->post();
                        $data['message']= '<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                        $this->load->view('add_audio_view',$data);
                    }
                }
                else
                {
                    $data['postdata']=$this->input->post();
                    $data['message']= '<div class="alert alert-warning alert-dismissable"> Please upload audio file <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                    $this->load->view('add_audio_view',$data);
                }


            }
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }





    public function audio_list()
    {


        $this->load->helper('url');

        $this->load->library('pagination');
        $this->load->model('audio_model');


        $config['base_url'] = base_url()."index.php/audio/audio_list/";
        $config['total_rows'] = $this->audio_model->count_audio();
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
        $data["allaudios"] = $this->audio_model->pagination_select_audio($config["per_page"], $page);

        $str_links = $this->pagination->create_links();
        $data["links"] = $str_links ;

        $data['message']='';
        $this->load->view('includes/header_view');
        $this->load->view('includes/navigation_view');
        $this->load->view('list_audio_view',$data);
        $this->load->view('includes/footer_view');
    }




    public function delete()
    {
        $this->load->model('audio_model');
        $status=0;
        $id=$this->input->post('id');
        $audio=$this->audio_model->get_audio($id);
        if(trim($audio['image'])!="")
            unlink(UPLOAD_AUDIOIMAGE_URL.$audio['image']);
        if(trim($audio['audiofile'])!="")
            unlink(UPLOAD_AUDIO_URL.$audio['audiofile']);
        if($this->audio_model->delete_audio($id))
        {

            $status=1;
        }
        $data = array('status' => $status);
        echo json_encode($data);

    }




    public function edit($id)
    {
        $this->load->model('audio_model');
        $this->load->model('category_model');
        $this->load->model('album_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        if(($this->session->userdata('admid'))) {
            $data["allcategorys"] = $this->category_model->select_all_category();
            $data["allalbums"] = $this->album_model->select_all_album();
            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');

            $data['audio']=$this->audio_model->get_audio($id);

            $data['message']='';
            $this->load->view('edit_audio_view',$data);
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }



    public function editaction($id)
    {
        $this->load->model('album_model');
        $this->load->model('audio_model');
        $this->load->model('category_model');
        $this->load->helper('form');
        $this->load->helper('string');

        if(($this->session->userdata('admid'))) {
            $data['imageerror'] = "";
            $data["allcategorys"] = $this->category_model->select_all_category();
            $data["allalbums"] = $this->album_model->select_all_album();
            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');


            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'required|trim|strip_tags');
            $this->form_validation->set_rules('category', 'Category', 'required|trim');
            $this->form_validation->set_rules('album', 'Album', 'required|trim');
            $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            if ($this->form_validation->run()== FALSE)
            {

                $data['audio'] = $this->audio_model->get_audio($id);
                $data['message']='<div class="alert alert-warning alert-dismissable"> Try after sometime <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                $this->load->view('edit_audio_view', $data);

            }
            else {
                $audio= $this->audio_model->get_audio($id);

                $data['imageerror'] ="";
                $aphoto =$audio['image'];
                if($_FILES["aphoto"]["size"]>0) {
                    if(trim($audio['image'])!="")
                        unlink(UPLOAD_AUDIOIMAGE_URL.$audio['image']);
                    $flag = 0;
                    $config['upload_path'] = UPLOAD_AUDIOIMAGE_URL;
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['file_name'] = random_string('alnum', 4) . "_" . $_FILES["aphoto"]["name"];


                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('aphoto')) {
                        // $error = array('imageerror' => $this->upload->display_errors());
                        $flag = 1;
                        $data['imageerror'] = $this->upload->display_errors();
                        // $this->load->view('upload_form', $error);
                    } else {
                        $aphoto = $this->upload->data('file_name');


                    }
                }


                $afile =$audio['audiofile'];
                if($_FILES["afile"]["size"]>0) {
                    if(trim($audio['audiofile'])!="")
                        unlink(UPLOAD_AUDIOIMAGE_URL.$audio['audiofile']);
                    $flag = 0;
                    $config2['upload_path'] = UPLOAD_AUDIO_URL;
                    $config2['allowed_types'] = 'mp3';
                    $config2['file_name'] = random_string('alnum', 4) . "_" . $_FILES["afile"]["name"];


                    $this->load->library('upload', $config2);
                    $this->upload->initialize($config2);
                    if (!$this->upload->do_upload('afile')) {
                        // $error = array('imageerror' => $this->upload->display_errors());
                        $flag = 1;
                        $data['audioerror'] = $this->upload->display_errors();
                        // $this->load->view('upload_form', $error);
                    } else {
                        $afile = $this->upload->data('file_name');


                    }

                }
                $data2 = array(
                    'category' => $this->input->post('category'),
                    'album' => $this->input->post('album'),
                    'title' => $this->input->post('title'),
                    'genere' => $this->input->post('genere'),
                    'lyrics' => $this->input->post('lyrics'),
                    'singer' => $this->input->post('singer'),
                    'image' => $aphoto,
                    'audiofile' => $afile
                );

                $this->audio_model->update_audio($data2, $id);

                $data['message'] = '<div class="alert alert-info alert-dismissable"> SucessFully Ediited <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';

                $this->load->model('audio_model');
                $data['audio'] = $this->audio_model->get_audio($id);
                $this->load->view('edit_audio_view', $data);
            }
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }

}
