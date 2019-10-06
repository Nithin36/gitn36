<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Slider_model extends CI_Model {

function __construct()
{
// Call the Model constructor
parent::__construct();
}

function get_slider($id)
{                    
$query = $this->db->get_where('app_slider', array('id' => $id), 1);
$data =$query->row_array();
//echo $this->db->last_query();
return $data;
}

function insert_slider($data)
{
$this->db->insert('app_slider', $data);
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


function count_slider()
{
$sql=" select  app_slider.*  from   app_slider ";
$query = $this->db->query($sql);
return $rowcount = $query->num_rows();
}


public function pagination_select_slider($limit, $page=null)  
{  
$sql="select  app_slider.* from   app_slider "

." order by  app_slider.id desc limit ".$page." ,".$limit."  ";
$query = $this->db->query($sql);
//echo $this->db->last_query();
$data =$query->result_array();
return $data;
}

public function select_all_slider()  
{  
$sql="select  app_slider.* from   app_slider "
." order by  app_slider.id desc  ";
$query = $this->db->query($sql);
$data =$query->result_array();
return $data;
}

function delete_slider($id){
$this->db->where('id', $id);
$this->db->delete('app_slider');
return ($this->db->affected_rows() != 1) ? false : true;
}    
function update_slider($data,$id)
{

$this->db->set($data);
$this->db->where('id', $id);
$this->db->update('app_slider', $data);
//echo $this->db->last_query();
return ($this->db->affected_rows() != 1) ? false : true;

//return $rowcount = $query->num_rows();
}

 
    
    }
