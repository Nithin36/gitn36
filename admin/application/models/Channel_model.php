<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class channel_model extends CI_Model {

    function __construct()
    {
// Call the Model constructor
        parent::__construct();
    }

    function get_channel($id)
    {
        $query = $this->db->get_where('app_channel', array('id' => $id), 1);
        $data =$query->row_array();
//echo $this->db->last_query();
        return $data;
    }

    function insert_channel($data)
    {
        $this->db->insert('app_channel', $data);
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



    function count_channel()
    {
        $sql=" select   app_channel.*  from  app_channel ";
        $query = $this->db->query($sql);
        // echo $this->db->last_query();
        return $rowcount = $query->num_rows();
    }


    public function pagination_select_channel($limit, $page=null)
    {
        $sql="select   app_channel.* from   app_channel "
            ." order by  app_channel.id desc limit ".$page." ,".$limit."  ";
        $query = $this->db->query($sql);
        // echo $this->db->last_query();
        $data =$query->result_array();
        return $data;
    }

    public function select_all_channel()
    {
        $sql="select  app_channel.* from   app_channel "
            ." order by  app_channel.id desc  ";
        $query = $this->db->query($sql);
        $data =$query->result_array();
        return $data;
    }

    function delete_channel($id){
        $this->db->where('id', $id);
        $this->db->delete('app_channel');
        // echo $this->db->last_query();
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    function update_channel($data,$id)
    {

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('app_channel', $data);

        return ($this->db->affected_rows() != 1) ? false : true;

    }



}
