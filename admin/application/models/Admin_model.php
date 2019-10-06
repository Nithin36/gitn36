<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_model extends CI_Model {



function __construct()
{
// Call the Model constructor
parent::__construct();
}
function get_customer($id)
{                    

$query = $this->db->get_where('customer', array('id' => $id), 1);
$data =$query->row_array();
//echo $this->db->last_query();
return $data;
}

function insert_customer($data)
{


$this->db->insert('customer', $data);
  $insert_id = $this->db->insert_id();

   
   if($this->db->affected_rows() != 1)
   {
       return 0;
   }
 else {
       return  $insert_id;
   }

}



      
         function get_adminlogin($email,$password)
    {                    

$this->db->select('id,email,password');
//$this->db->where('password = ',md5($password));
$this->db->where('password = ',base64_encode($password));
$this->db->where('email = ',$email);
$query = $this->db->get('admin',1);

$data =$query->row_array();
//echo $this->db->last_query();

                return $data;
    }
    
    
     function update_customer($data,$id)
{

$this->db->set($data);
$this->db->where('id', $id);
$this->db->update('customer', $data);
//echo $this->db->last_query();
return ($this->db->affected_rows() != 1) ? false : true;

//return $rowcount = $query->num_rows();
}

           function check_customeremail($email)
    {                    

 $query = $this->db->get_where('customer', array('email' => $email), 1);
$data =$query->row_array();
if(count($data)==0)
{
    return false;
}
 else {
    return true;
}
             
    }
    
    
                   function get_customerdetails_withemail($email)
    {                    

 $query = $this->db->get_where('customer', array('email' => $email), 1);

$data =$query->row_array();
return $data;
             
    }
    
    }
