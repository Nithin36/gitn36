
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dailyverse_model extends CI_Model {

    function __construct()
    {
// Call the Model constructor
        parent::__construct();
    }

    function get_dailyverse($id)
    {
        $query = $this->db->get_where('app_dailyverse', array('id' => $id), 1);
        $data =$query->row_array();
//echo $this->db->last_query();
        return $data;
    }

    function insert_dailyverse($data)
    {
        $this->db->insert('app_dailyverse', $data);
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


    function count_dailyverse()
    {
        $sql=" select   app_dailyverse.*  from  app_dailyverse ";
        $query = $this->db->query($sql);
        return $rowcount = $query->num_rows();
    }


    public function pagination_select_dailyverse($limit, $page=null)
    {
        $sql="select   app_dailyverse.* from   app_dailyverse "
            ." order by  app_dailyverse.id desc limit ".$page." ,".$limit."  ";
        $query = $this->db->query($sql);
        $data =$query->result_array();
        return $data;
    }

    public function select_all_dailyverse()
    {
        $sql="select  app_dailyverse.* from   app_dailyverse "
            ." order by  app_magazine.id desc  ";
        $query = $this->db->query($sql);
        $data =$query->result_array();
        return $data;
    }

    function delete_dailyverse($id){
        $this->db->where('id', $id);
        $this->db->delete('app_dailyverse');
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    function update_dailyverse($data,$id)
    {

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('app_dailyverse', $data);
//echo $this->db->last_query();
        return ($this->db->affected_rows() != 1) ? false : true;

//return $rowcount = $query->num_rows();
    }



}
