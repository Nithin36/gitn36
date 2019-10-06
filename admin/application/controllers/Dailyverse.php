<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dailyverse extends CI_Controller {



    public function add()
    {

        $this->load->helper('form');
        $this->load->library('form_validation');
        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');
            $data['message']='';
            $data['fileerror']='';
            $data['imageerror']='';
            $data['postdata']='';

            $this->load->view('add_dailyverse_view',$data);
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
        $this->load->model('dailyverse_model');

        if(($this->session->userdata('admid'))) {

            $data['fileerror']='';
            $data['imageerror']='';
            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('lang', 'language', 'required|trim|strip_tags');
            $this->form_validation->set_rules('vdate', 'Date', 'required|trim|strip_tags');
            $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            if ($this->form_validation->run()== FALSE)
            {

                $data['message']='<div class="alert alert-warning alert-dismissable"> Try after sometime <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                $data['postdata']=$this->input->post();
                $this->load->view('add_dailyverse_view',$data);

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
                $config2['upload_path']          = UPLOAD_VERSEAUDIO_URL;
                $config2['allowed_types']        = '*';
                $config['file_name']            = random_string('alnum', 4)."_".$_FILES["vfile"]["name"];
                //  $config2['max_size']             = 100;

                $vfile =" ";
                    $this->load->library('upload', $config2);
                $this->upload->initialize($config2);
                if ( ! $this->upload->do_upload('vfile'))
                {
                    // $error = array('fileerror' => $this->upload->display_errors());
                    $data['fileerror']=$this->upload->display_errors();

                    // $this->load->view('upload_form', $error);
                }
                else
                {
                    $vfile = $this->upload->data('file_name');


                }




                if($flag!=1)
                {

                    $data2 = array(

                        'versedate' => $this->input->post('vdate'),
                        'image' => $vphoto,
                        'audio' =>  $vfile,
                        'poll' => $this->input->post('poll'),
                        'language' => $this->input->post('lang'),


                    );

                    if($this->dailyverse_model->insert_dailyverse($data2))
                    {
                        $data['message']= '<div class="alert alert-info alert-dismissable"> SucessFully Added <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';

                    }
                    else
                    {
                        $data['message']= '<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';

                    }
                    $data['fileerror']='';
                    $data['imageerror']='';
                    $data['postdata']='';
                    $this->load->view('add_dailyverse_view',$data);
                }
                else
                {
                    $data['postdata']=$this->input->post();

                    $data['message']= '<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                    $this->load->view('add_dailyverse_view',$data);
                }

            }


            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }





    public function verse_list()
    {


        $this->load->helper('url');
        $this->load->helper('text');

        $this->load->library('pagination');
        $this->load->model('dailyverse_model');


        $config['base_url'] = base_url()."index.php/dailyverse/verse_list";
        $config['total_rows'] = $this->dailyverse_model->count_dailyverse();
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
        $data["alldailyverses"] = $this->dailyverse_model->pagination_select_dailyverse($config["per_page"], $page);

        $str_links = $this->pagination->create_links();
        $data["links"] = $str_links ;

        $data['message']='';
        $this->load->view('includes/header_view');
        $this->load->view('includes/navigation_view');
        $this->load->view('list_dailyverse_view',$data);
        $this->load->view('includes/footer_view');
    }




    public function delete()
    {
        $this->load->helper("file");
        $this->load->model('dailyverse_model');
        $status=0;
        $id=$this->input->post('id');
        $row=$this->dailyverse_model->get_dailyverse($id);
        if(trim($row['audio'])!="")
            unlink(UPLOAD_VERSEAUDIO_URL.$row['audio']);
        if(trim($row['image'])!="")
            unlink(UPLOAD_VERSEIMAGE_URL.$row['image']);


        if($this->dailyverse_model->delete_dailyverse($id))
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



}
