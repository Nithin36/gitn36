
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Video_model extends CI_Model {

    function __construct()
    {
// Call the Model constructor
        parent::__construct();
    }

    function get_video($id)
    {
        $query = $this->db->get_where('app_video', array('id' => $id), 1);
        $data =$query->row_array();
//echo $this->db->last_query();
        return $data;
    }

    function insert_video($data)
    {
        $this->db->insert('app_video', $data);
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



    function count_video($id)
    {
        $sql=" select   app_video.*  from  app_video where app_video.course=".$id;
        $query = $this->db->query($sql);
       // echo $this->db->last_query();
        return $rowcount = $query->num_rows();
    }


    public function pagination_select_video($limit, $page=null,$id)
    {
        $sql="select   app_video.* from   app_video where app_video.course=".$id
            ." order by  app_video.id desc limit ".$page." ,".$limit."  ";
        $query = $this->db->query($sql);
       // echo $this->db->last_query();
        $data =$query->result_array();
        return $data;
    }

    public function select_all_video()
    {
        $sql="select  app_video.* from   app_video "
            ." order by  app_video.id desc  ";
        $query = $this->db->query($sql);
        $data =$query->result_array();
        return $data;
    }

    function delete_video($id){
        $this->db->where('id', $id);
        $this->db->delete('app_video');
       // echo $this->db->last_query();
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    function update_video($data,$id)
    {

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('app_video', $data);

        return ($this->db->affected_rows() != 1) ? false : true;

    }



}
