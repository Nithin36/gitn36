<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Event_model extends CI_Model {

    function __construct()
    {
// Call the Model constructor
        parent::__construct();
    }

    function get_event($id)
    {
        $query = $this->db->get_where('app_event', array('id' => $id), 1);
        $data =$query->row_array();
//echo $this->db->last_query();
        return $data;
    }

    function insert_event($data)
    {
        $this->db->insert('app_event', $data);
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


    function count_event()
    {
        $sql=" select  app_event.*  from   app_event ";
        $query = $this->db->query($sql);
        return $rowcount = $query->num_rows();
    }


    public function pagination_select_event($limit, $page=null)
    {
        $sql="select  app_event.* from   app_event "
            ." order by  app_event.id desc limit ".$page." ,".$limit."  ";
        $query = $this->db->query($sql);
        $data =$query->result_array();
        return $data;
    }

    public function select_all_event()
    {
        $sql="select  app_event.* from   app_event "
            ." order by  app_event.id desc  ";
        $query = $this->db->query($sql);
        $data =$query->result_array();
        return $data;
    }

    function delete_event($id){
        $this->db->where('id', $id);
        $this->db->delete('app_event');
        return ($this->db->affected_rows() != 1) ? false : true;
    }


    function update_event($data,$id)
    {

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('app_event', $data);
//echo $this->db->last_query();
        return ($this->db->affected_rows() != 1) ? false : true;

//return $rowcount = $query->num_rows();
    }



}
