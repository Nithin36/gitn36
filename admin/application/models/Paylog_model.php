<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Paylog_model extends CI_Model {

    function __construct()
    {
// Call the Model constructor
        parent::__construct();
    }

    function get_paylog($id)
    {
        $query = $this->db->get_where('app_paylog', array('id' => $id), 1);
        $data =$query->row_array();
//echo $this->db->last_query();
        return $data;
    }

    function insert_paylog($data)
    {
        $this->db->insert('app_paylog', $data);
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


    function count_paylog()
    {
        $sql=" select  app_paylog.*  from   app_paylog ";
        $query = $this->db->query($sql);
        return $rowcount = $query->num_rows();
    }


    public function pagination_select_paylog($limit, $page=null)
    {
        $sql="select  app_paylog.*,app_user.email as email,app_user.mobno as mobno"
               ." from   app_paylog "
            ." left join  app_user on app_user.id=app_paylog.userid"
            ." order by  app_paylog.id desc limit ".$page." ,".$limit."  ";
        $query = $this->db->query($sql);
        $data =$query->result_array();
        return $data;
    }
    function count_paylog_search($name)
    {
        $sql=" select  app_paylog.*  from   app_paylog where username like'".$name."%'";
        $query = $this->db->query($sql);
        return $rowcount = $query->num_rows();
    }


    public function pagination_select_paylog_search($limit, $page=null,$name)
    {
        $sql="select  app_paylog.*,app_user.email as email,app_user.mobno as mobno"
            ." from   app_paylog "
            ." left join  app_user on app_user.id=app_paylog.userid"
            ." where username like'".$name."%'"
            ." order by  app_paylog.id desc limit ".$page." ,".$limit."  ";
        $query = $this->db->query($sql);

        $data =$query->result_array();
        return $data;
    }
    public function select_all_paylog()
    {
        $sql="select  app_paylog.* from   app_paylog "
            ." order by  app_paylog.id desc  ";
        $query = $this->db->query($sql);
        $data =$query->result_array();
        return $data;
    }

    function delete_paylog($id){
        $this->db->where('id', $id);
        $this->db->delete('app_paylog');
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    function update_paylog($data,$id)
    {

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('app_paylog', $data);
//echo $this->db->last_query();
        return ($this->db->affected_rows() != 1) ? false : true;

//return $rowcount = $query->num_rows();
    }



}
