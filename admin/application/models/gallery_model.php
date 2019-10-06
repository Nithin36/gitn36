<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gallery_model extends CI_Model {

    function __construct()
    {
// Call the Model constructor
        parent::__construct();
    }

    function get_gallery($id)
    {
        $query = $this->db->get_where('app_gallery', array('id' => $id), 1);
        $data =$query->row_array();
//echo $this->db->last_query();
        return $data;
    }

    function insert_gallery($data)
    {
        $this->db->insert('app_gallery', $data);
        $insert_id = $this->db->insert_id();
//echo $this->db->last_query();
        if($this->db->affected_rows() != 1)
        {
            return 0;
        }
        else
        {
            return  $insert_id;
        }
    }


    function count_gallery()
    {
        $sql=" select  app_gallery.*  from   app_gallery ";
        $query = $this->db->query($sql);
        return $rowcount = $query->num_rows();
    }


    public function pagination_select_gallery($limit, $page=null)
    {
        $sql="select  app_gallery.* from   app_gallery "

            ." order by  app_gallery.id desc limit ".$page." ,".$limit."  ";
        $query = $this->db->query($sql);
       // echo $this->db->last_query();
        $data =$query->result_array();
        return $data;
    }

    public function select_all_gallery()
    {
        $sql="select  app_gallery.* from   app_gallery "
            ." order by  app_gallery.id desc  ";
        $query = $this->db->query($sql);
        $data =$query->result_array();
        return $data;
    }

    function delete_gallery($id){
        $this->db->where('id', $id);
        $this->db->delete('app_gallery');
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    function update_gallery($data,$id)
    {

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('app_gallery', $data);
//echo $this->db->last_query();
        return ($this->db->affected_rows() != 1) ? false : true;

//return $rowcount = $query->num_rows();
    }



}
