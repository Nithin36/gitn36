<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class channel extends CI_Controller {






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
            $this->load->view('add_channel_view',$data);
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
        $this->load->model('channel_model');
        $this->load->helper('string');

        $data['imageerror'] ='';

        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'required|trim|strip_tags');
            $this->form_validation->set_rules('channelno', 'Title', 'required|trim|strip_tags');
            $this->form_validation->set_rules('livetvurl', 'LiveTvUrl', 'required|trim');
            $this->form_validation->set_rules('youtubechannelurl', 'Youtube Channel Url', 'required|trim|strip_tags');
            $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            if ($this->form_validation->run()== FALSE)
            {
                $data['postdata']=$this->input->post();
                $data['message']='<div class="alert alert-warning alert-dismissable"> Try after sometime <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                $this->load->view('add_channel_view',$data);

            }
            else
            {
                $data['imageerror'] ="";
                $cphoto =" ";
                if($_FILES["cphoto"]["size"]>0) {
                    $flag = 0;
                    $config['upload_path'] = UPLOAD_CHANNEL_URL;
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['file_name'] = random_string('alnum', 4) . "_" . $_FILES["cphoto"]["name"];


                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('cphoto')) {
                        // $error = array('imageerror' => $this->upload->display_errors());
                        $flag = 1;
                        $data['imageerror'] = $this->upload->display_errors();
                        // $this->load->view('upload_form', $error);
                    } else {
                        $cphoto = $this->upload->data('file_name');

                        $youtubechannelarray= explode('/',$this->input->post('youtubechannelurl'));
                        $youtubechannel=end($youtubechannelarray);
                        $data2 = array(
                            'name' => $this->input->post('title'),
                            'channelno' => $this->input->post('channelno'),
                            'videourl' => $this->input->post('livetvurl'),
                            'channelurl' => $this->input->post('youtubechannelurl'),
                            'channelid' => $youtubechannel,
                            'image'=>$cphoto
                        );

                        if($this->channel_model->insert_channel($data2))
                        {

                            $data['message']= '<div class="alert alert-info alert-dismissable"> SucessFully Added <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                            $this->load->view('add_channel_view',$data);
                        }
                        else
                        {
                            $data['postdata']=$this->input->post();
                            $data['message']= '<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                            $this->load->view('add_channel_view',$data);
                        }
                    }
                }
                else
                {

                    $data['postdata']=$this->input->post();
                    $data['message']= '<div class="alert alert-warning alert-dismissable"> Please upload image.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                    $this->load->view('add_channel_view',$data);

                }


            }
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }





    public function channel_list()
    {


        $this->load->helper('url');

        $this->load->library('pagination');
        $this->load->model('channel_model');


        $config['base_url'] = base_url()."index.php/channel/channel_list/";
        $config['total_rows'] = $this->channel_model->count_channel();
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
        $data["allchannels"] = $this->channel_model->pagination_select_channel($config["per_page"], $page);

        $str_links = $this->pagination->create_links();
        $data["links"] = $str_links ;

        $data['message']='';
        $this->load->view('includes/header_view');
        $this->load->view('includes/navigation_view');
        $this->load->view('list_channel_view',$data);
        $this->load->view('includes/footer_view');
    }




    public function delete()
    {
        $this->load->model('channel_model');
        $status=0;
        $id=$this->input->post('id');
        $channel=$this->channel_model->get_channel($id);
        if($this->channel_model->delete_channel($id))
        {
            if(trim($channel['image'])!="")
                unlink(UPLOAD_CHANNEL_URL.$channel['image']);
            $status=1;
        }
        $data = array('status' => $status);
        echo json_encode($data);

    }




    public function edit($id)
    {
        $this->load->model('channel_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');

            $data['channel']=$this->channel_model->get_channel($id);
            $data['message']='';
            $this->load->view('edit_channel_view',$data);
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }



    public function editaction($id)
    {
        $this->load->model('channel_model');
        $this->load->helper('form');
        $this->load->helper('string');

        if(($this->session->userdata('admid'))) {
            $data['imageerror'] = "";
            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');


            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'required|trim|strip_tags');
            $this->form_validation->set_rules('channelno', 'Title', 'required|trim|strip_tags');
            $this->form_validation->set_rules('livetvurl', 'Live Tv Url', 'required|trim|strip_tags');
            $this->form_validation->set_rules('youtubechannelurl', 'Youtube Channel Url', 'required|trim|strip_tags');
            $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            if ($this->form_validation->run()== FALSE)
            {
                $data['postdata']=$this->input->post();
                $data['message']='<div class="alert alert-warning alert-dismissable"> Try after sometime <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                $this->load->view('edit_channel_view',$data);

            }
            else {

                $channel= $this->channel_model->get_channel($id);
                $cphoto = $channel['image'];
                if ($_FILES["cphoto"]["size"] > 0) {
                    $flag = 0;
                    $config['upload_path'] = UPLOAD_CHANNEL_URL;
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['file_name'] = random_string('alnum', 4) . "_" . $_FILES["cphoto"]["name"];


                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('cphoto')) {
                        // $error = array('imageerror' => $this->upload->display_errors());
                        $flag = 1;
                        $data['imageerror'] = $this->upload->display_errors();
                        // $this->load->view('upload_form', $error);
                    } else {
                        $cphoto = $this->upload->data('file_name');


                    }
                }
                $youtubechannelarray= explode('/',$this->input->post('youtubechannelurl'));
                $youtubechannel=end($youtubechannelarray);
                $data2 = array(
                    'name' => $this->input->post('title'),
                    'channelno' => $this->input->post('channelno'),
                    'videourl' => $this->input->post('livetvurl'),
                    'channelurl' => $this->input->post('youtubechannelurl'),
                    'channelid' => $youtubechannel,
                    'image'=>$cphoto
                );

                $this->channel_model->update_channel($data2, $id);

                $data['message'] = '<div class="alert alert-info alert-dismissable"> SucessFully Ediited <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';


                $data['channel'] = $this->channel_model->get_channel($id);
                $this->load->view('edit_channel_view', $data);
            }
            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }


}
