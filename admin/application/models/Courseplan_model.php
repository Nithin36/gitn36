
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Courseplan_model extends CI_Model {

    function __construct()
    {
// Call the Model constructor
        parent::__construct();
    }

    function get_courseplan($id)
    {
        $query = $this->db->get_where('app_courseplan', array('id' => $id), 1);
        $data =$query->row_array();
//echo $this->db->last_query();
        return $data;
    }
    function get_courseplan_course($cid)
    {
        $query = $this->db->get_where('app_courseplan', array('course' => $cid), 1);
        $data =$query->row_array();
//echo $this->db->last_query();
        return $data;
    }
    function insert_courseplan($data)
    {
        $this->db->insert('app_courseplan', $data);
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



    function count_courseplan($id)
    {
        $sql=" select   app_courseplan.*  from  app_courseplan where app_courseplan.course=".$id;
        $query = $this->db->query($sql);
        // echo $this->db->last_query();
        return $rowcount = $query->num_rows();
    }


    public function pagination_select_courseplan($limit, $page=null,$id)
    {
        $sql="select   app_courseplan.* from   app_courseplan where app_courseplan.course=".$id
            ." order by  app_courseplan.id desc limit ".$page." ,".$limit."  ";
        $query = $this->db->query($sql);
        // echo $this->db->last_query();
        $data =$query->result_array();
        return $data;
    }

    public function select_all_courseplan()
    {
        $sql="select  app_courseplan.* from   app_courseplan "
            ." order by  app_courseplan.id desc  ";
        $query = $this->db->query($sql);
        $data =$query->result_array();
        return $data;
    }

    function delete_courseplan($id){
        $this->db->where('id', $id);
        $this->db->delete('app_courseplan');
        // echo $this->db->last_query();
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function delete_courseplan_course($cid){
        $this->db->where('course', $cid);
        $this->db->delete('app_courseplan');

        return ($this->db->affected_rows() != 1) ? false : true;
    }
    function update_courseplan($data,$id)
    {

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('app_courseplan', $data);

        return ($this->db->affected_rows() != 1) ? false : true;

    }



}
