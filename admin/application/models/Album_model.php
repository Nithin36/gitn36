<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Album_model extends CI_Model {

    function __construct()
    {
// Call the Model constructor
        parent::__construct();
    }

    function get_album($id)
    {
        $query = $this->db->get_where('app_album', array('id' => $id), 1);
        $data =$query->row_array();
//echo $this->db->last_query();
        return $data;
    }

    function insert_album($data)
    {
        $this->db->insert('app_album', $data);
        $insert_id = $this->db->insert_id();
        if($this->db->affected_rows() != 1)
        {
            return 0;
        }
        else
        {
            return  $insert_id;
        }
    }


    function count_album()
    {
        $sql=" select  app_album.*  from   app_album ";
        $query = $this->db->query($sql);
        return $rowcount = $query->num_rows();
    }


    public function pagination_select_album($limit, $page=null)
    {
        $sql="select  app_album.*,(select 	category_name from app_category where app_category.id=app_album.category ) as acategory from   app_album "
            ." order by  app_album.id desc limit ".$page." ,".$limit."  ";
        $query = $this->db->query($sql);
        $data =$query->result_array();
        return $data;
    }

    public function select_all_album_category($cat)
    {
        $sql="select  app_album.* from   app_album "
            ." where app_album.category=".$cat
            ." order by  app_album.id desc  ";
        $query = $this->db->query($sql);
        $data =$query->result_array();
        return $data;
    }


    public function select_all_album()
    {
        $sql="select  app_album.* from   app_album "
            ." order by  app_album.id desc  ";
        $query = $this->db->query($sql);
        $data =$query->result_array();
        return $data;
    }
    function delete_album($id){
        $this->db->where('id', $id);
        $this->db->delete('app_album');
        return ($this->db->affected_rows() != 1) ? false : true;
    }


    function update_album($data,$id)
    {

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('app_album', $data);
//echo $this->db->last_query();
        return ($this->db->affected_rows() != 1) ? false : true;

//return $rowcount = $query->num_rows();
    }



}
