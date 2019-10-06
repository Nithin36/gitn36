<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class gallery extends CI_Controller {



    public function add()
    {
        $this->load->model('gallery_model');
        $this->load->helper('string');
        $this->load->helper('form');
        $this->load->library('form_validation');
        if(($this->session->userdata('admid'))) {

            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');
            $data['message']='';
            $data['imageerror']='';
            $this->load->view('add_gallery_view',$data);
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

        $this->load->model('gallery_model');

        if(($this->session->userdata('admid'))) {

            $data['imageerror']='';
            $this->load->view('includes/header_view');
            $this->load->view('includes/navigation_view');

            $sphoto =" ";
            $flag=0;
            $config['upload_path']          = UPLOAD_GALLERY_URL;
            $config['allowed_types']        = 'gif|jpg|png';
            $config['file_name']            = random_string('alnum', 4)."_".$_FILES["sphoto"]["name"];
            //$config['max_size']             = 100;


            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('sphoto'))
            {
                // $error = array('imageerror' => $this->upload->display_errors());
                $flag=1;
                $data['imageerror']=$this->upload->display_errors();
                // $this->load->view('upload_form', $error);
            }
            else
            {
                $sphoto = $this->upload->data('file_name');


            }



            if($flag!=1)
            {

                $data2 = array(
                    'image' => $sphoto
               

                );

                if($this->gallery_model->insert_gallery($data2))
                {
                    $data['message']= '<div class="alert alert-info alert-dismissable"> SucessFully Added <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';

                }
                else
                {
                    $data['message']= '<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';

                }

                $this->load->view('add_gallery_view',$data);
            }
            else
            {
                $data['message']= '<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
                $this->load->view('add_gallery_view',$data);
            }




            $this->load->view('includes/footer_view');
        }
        else
        {

            redirect(base_url().'index.php/admin/login/');
        }
    }





    public function gallery_list()
    {


        $this->load->helper('url');
        $this->load->helper('text');

        $this->load->library('pagination');
        $this->load->model('gallery_model');


        $config['base_url'] = base_url()."index.php/gallery/sld_list/";
        $config['total_rows'] = $this->gallery_model->count_gallery();
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
        $data["allgallerys"] = $this->gallery_model->pagination_select_gallery($config["per_page"], $page);

        $str_links = $this->pagination->create_links();
        $data["links"] = $str_links ;

        $data['message']='';
        $this->load->view('includes/header_view');
        $this->load->view('includes/navigation_view');
        $this->load->view('list_gallery_view',$data);
        $this->load->view('includes/footer_view');
    }




    public function delete()
    {
        $this->load->helper("file");
        $this->load->model('gallery_model');
        $status=0;
        $id=$this->input->post('id');
        $row=$this->gallery_model->get_gallery($id);

        if(trim($row['image'])!=" ")
            unlink(UPLOAD_GALLERY_URL.$row['image']);


        if($this->gallery_model->delete_gallery($id))
        {
            $status=1;
        }
        $data = array('status' => $status);
        echo json_encode($data);

    }






}
