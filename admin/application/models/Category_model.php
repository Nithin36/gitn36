<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Category_model extends CI_Model {

function __construct()
{
// Call the Model constructor
parent::__construct();
}

function get_category($id)
{                    
$query = $this->db->get_where('app_category', array('id' => $id), 1);
$data =$query->row_array();
//echo $this->db->last_query();
return $data;
}

function insert_category($data)
{
$this->db->insert('app_category', $data);
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


function count_category()
{
$sql=" select  app_category.*  from   app_category ";
$query = $this->db->query($sql);
return $rowcount = $query->num_rows();
}


public function pagination_select_category($limit, $page=null)  
{  
$sql="select  app_category.* from   app_category "
." order by  app_category.id desc limit ".$page." ,".$limit."  ";
$query = $this->db->query($sql);
$data =$query->result_array();
return $data;
}

public function select_all_category()  
{  
$sql="select  app_category.* from   app_category "
." order by  app_category.id desc  ";
$query = $this->db->query($sql);
$data =$query->result_array();
return $data;
}

function delete_category($id){
$this->db->where('id', $id);
$this->db->delete('app_category');
return ($this->db->affected_rows() != 1) ? false : true;
}

         
function update_category($data,$id)
{

$this->db->set($data);
$this->db->where('id', $id);
$this->db->update('app_category', $data);
//echo $this->db->last_query();
return ($this->db->affected_rows() != 1) ? false : true;

//return $rowcount = $query->num_rows();
}

 
    
    }
