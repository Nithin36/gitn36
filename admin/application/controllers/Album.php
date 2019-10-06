<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class album extends CI_Controller {






    public function add()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('string');
        $this->load->model('channel_model');
        $this->load->model('category_model');
        if(($this->session->userdata('admid'))) {
            $data["allcategorys"] = $this->category_model->select_all_category();
            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');
            $data['message']='';
            $this->load->view('add_album_view',$data);
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
        $this->load->model('category_model');
        $this->load->helper('string');

        if(($this->session->userdata('admid'))) {

            $data["allcategorys"] = $this->category_model->select_all_category();
            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'required|trim|strip_tags');
            $this->form_validation->set_rules('category', 'Category', 'required|trim');


            $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            if ($this->form_validation->run()== FALSE)
            {
                $data['postdata']=$this->input->post();
                $data['message']='<div class="alert alert-warning alert-dismissable"> Try after sometime <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                $this->load->view('add_album_view',$data);

            }
            else
            {
                $data['imageerror'] ="";
                $aphoto =" ";
                if($_FILES["aphoto"]["size"]>0) {
                    $flag = 0;
                    $config['upload_path'] = UPLOAD_ALBUM_URL;
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

                $data2 = array(
                    'category' => $this->input->post('category'),
                    'title' => $this->input->post('title'),
                    'image' => $aphoto
                );

                if($this->album_model->insert_album($data2))
                {

                    $data['message']= '<div class="alert alert-info alert-dismissable"> SucessFully Added <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                    $this->load->view('add_album_view',$data);
                }
                else
                {
                    $data['postdata']=$this->input->post();
                    $data['message']= '<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                    $this->load->view('add_album_view',$data);
                }

            }
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }





    public function album_list()
    {


        $this->load->helper('url');

        $this->load->library('pagination');
        $this->load->model('album_model');


        $config['base_url'] = base_url()."index.php/album/album_list/";
        $config['total_rows'] = $this->album_model->count_album();
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
        $data["allalbums"] = $this->album_model->pagination_select_album($config["per_page"], $page);

        $str_links = $this->pagination->create_links();
        $data["links"] = $str_links ;

        $data['message']='';
        $this->load->view('includes/header_view');
        $this->load->view('includes/navigation_view');
        $this->load->view('list_album_view',$data);
        $this->load->view('includes/footer_view');
    }




    public function delete()
    {
        $this->load->model('album_model');
        $status=0;
        $id=$this->input->post('id');
        $album=$this->album_model->get_album($id);
        if(trim($album['image'])!="")
        unlink(UPLOAD_AUDIOIMAGE_URL.$album['image']);
        if(trim($album['audiofile'])!="")
            unlink(UPLOAD_AUDIO_URL.$album['audiofile']);
        if($this->album_model->delete_album($id))
        {

            $status=1;
        }
        $data = array('status' => $status);
        echo json_encode($data);

    }




    public function edit($id)
    {
        $this->load->model('album_model');
        $this->load->model('category_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        if(($this->session->userdata('admid'))) {
            $data["allcategorys"] = $this->category_model->select_all_category();
            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');

            $data['album']=$this->album_model->get_album($id);
            $data['message']='';
            $this->load->view('edit_album_view',$data);
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
        $this->load->model('category_model');
        $this->load->helper('form');
        $this->load->helper('string');

        if(($this->session->userdata('admid'))) {
            $data['imageerror'] = "";
            $data["allcategorys"] = $this->category_model->select_all_category();
            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');


            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'required|trim|strip_tags');
            $this->form_validation->set_rules('category', 'Category', 'required|trim');
            $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            if ($this->form_validation->run()== FALSE)
            {
                $data['album'] = $this->album_model->get_album($id);
                $data['message']='<div class="alert alert-warning alert-dismissable"> Try after sometime <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                $this->load->view('edit_album_view', $data);

            }
            else {
                $album= $this->album_model->get_album($id);

                $data['imageerror'] ="";
                $aphoto =$album['image'];
                if($_FILES["aphoto"]["size"]>0) {
                    $flag = 0;
                    $config['upload_path'] = UPLOAD_ALBUM_URL;
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
                $data2 = array(
                    'category' => $this->input->post('category'),
                    'title' => $this->input->post('title'),
                    'image' => $aphoto
                );

                $this->album_model->update_album($data2, $id);

                $data['message'] = '<div class="alert alert-info alert-dismissable"> SucessFully Ediited <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';

                $this->load->model('album_model');
                $data['album'] = $this->album_model->get_album($id);
                $this->load->view('edit_album_view', $data);
            }
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }


    function select_album()
    {
        $this->load->model('album_model');
        $this->load->helper('form');
$allalbums = $this->album_model->select_all_album_category($this->input->post('id'));
        ?>
             <option value="">select</option>
                                            <?php

                                            if(!empty($allalbums))
                                            {
                                                foreach ($allalbums as $album)
                                                {
                                                    ?>
                                                    <option value="<?php echo $album['id'] ?>" <?php if(!empty($postdata)){if($postdata['album']==$album['id']) {?> selected="selected" <?php }}?>><?php echo $album['title'] ?></option>

                                                    <?php
                                                }
                                            }


    }

}
