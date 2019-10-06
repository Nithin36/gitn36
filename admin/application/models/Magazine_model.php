<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Magazine_model extends CI_Model {

function __construct()
{
// Call the Model constructor
parent::__construct();
}

function get_magazine($id)
{                    
$query = $this->db->get_where('app_magazine', array('id' => $id), 1);
$data =$query->row_array();
//echo $this->db->last_query();
return $data;
}

function insert_magazine($data)
{
$this->db->insert('app_magazine', $data);
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


function count_magazine()
{
$sql=" select  app_magazine.*  from   app_magazine ";
$query = $this->db->query($sql);
return $rowcount = $query->num_rows();
}


public function pagination_select_magazine($limit, $page=null)  
{  
$sql="select  app_magazine.*,app_category.category_name	 as cname from   app_magazine "
." left join  app_category on  app_magazine.category_id=app_category.id"
." order by  app_magazine.id desc limit ".$page." ,".$limit."  ";
$query = $this->db->query($sql);
$data =$query->result_array();
return $data;
}

public function select_all_magazine()  
{  
$sql="select  app_magazine.* from   app_magazine "
." order by  app_magazine.id desc  ";
$query = $this->db->query($sql);
$data =$query->result_array();
return $data;
}

function delete_magazine($id){
$this->db->where('id', $id);
$this->db->delete('app_magazine');
return ($this->db->affected_rows() != 1) ? false : true;
}    
function update_magazine($data,$id)
{

$this->db->set($data);
$this->db->where('id', $id);
$this->db->update('app_magazine', $data);
//echo $this->db->last_query();
return ($this->db->affected_rows() != 1) ? false : true;

//return $rowcount = $query->num_rows();
}

 
    
    }
