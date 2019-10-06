<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Plan_model extends CI_Model {

    function __construct()
    {
// Call the Model constructor
        parent::__construct();
    }

    function get_plan($id)
    {
        $query = $this->db->get_where('app_plan', array('id' => $id), 1);
        $data =$query->row_array();
//echo $this->db->last_query();
        return $data;
    }

    function insert_plan($data)
    {
        $this->db->insert('app_plan', $data);
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


    function count_plan()
    {
        $sql=" select  app_plan.*  from   app_plan ";
        $query = $this->db->query($sql);
        return $rowcount = $query->num_rows();
    }


    public function pagination_select_plan($limit, $page=null)
    {
        $sql="select  app_plan.* from   app_plan "
            ." order by  app_plan.id desc limit ".$page." ,".$limit."  ";
        $query = $this->db->query($sql);
        $data =$query->result_array();
        return $data;
    }

    public function select_all_plan()
    {
        $sql="select  app_plan.* from   app_plan "
            ." order by  app_plan.id desc  ";
        $query = $this->db->query($sql);
        $data =$query->result_array();
        return $data;
    }

    function delete_plan($id){
        $this->db->where('id', $id);
        $this->db->delete('app_plan');
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    function update_plan($data,$id)
    {

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('app_plan', $data);
//echo $this->db->last_query();
        return ($this->db->affected_rows() != 1) ? false : true;

//return $rowcount = $query->num_rows();
    }



}
