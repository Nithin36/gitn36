<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Faq_model extends CI_Model {

    function __construct()
    {
// Call the Model constructor
        parent::__construct();
    }

    function get_faq($id)
    {
        $query = $this->db->get_where('app_faq', array('id' => $id), 1);
        $data =$query->row_array();
//echo $this->db->last_query();
        return $data;
    }

    function insert_faq($data)
    {
        $this->db->insert('app_faq', $data);
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


    function count_faq()
    {
        $sql=" select  app_faq.*  from   app_faq ";
        $query = $this->db->query($sql);
        return $rowcount = $query->num_rows();
    }


    public function pagination_select_faq($limit, $page=null)
    {
        $sql="select  app_faq.* from   app_faq "
            ." order by  app_faq.id desc limit ".$page." ,".$limit."  ";
        $query = $this->db->query($sql);
        $data =$query->result_array();
        return $data;
    }

    public function select_all_faq()
    {
        $sql="select  app_faq.* from   app_faq "
            ." order by  app_faq.id desc  ";
        $query = $this->db->query($sql);
        $data =$query->result_array();
        return $data;
    }

    function delete_faq($id){
        $this->db->where('id', $id);
        $this->db->delete('app_faq');
        return ($this->db->affected_rows() != 1) ? false : true;
    }


    function update_faq($data,$id)
    {

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('app_faq', $data);
//echo $this->db->last_query();
        return ($this->db->affected_rows() != 1) ? false : true;

//return $rowcount = $query->num_rows();
    }



}
