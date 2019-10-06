<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Audio_model extends CI_Model {

    function __construct()
    {
// Call the Model constructor
        parent::__construct();
    }

    function get_audio($id)
    {
        $query = $this->db->get_where('app_audio', array('id' => $id), 1);
        $data =$query->row_array();
//echo $this->db->last_query();
        return $data;
    }

    function insert_audio($data)
    {
        $this->db->insert('app_audio', $data);
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


    function count_audio()
    {
        $sql=" select  app_audio.*  from   app_audio ";
        $query = $this->db->query($sql);
        return $rowcount = $query->num_rows();
    }


    public function pagination_select_audio($limit, $page=null)
    {
        $sql="select  app_audio.*,(select category_name from app_category where app_category.id=app_audio.category ) as acategory,(select 	app_album.title from app_album where app_album.id=app_audio.album ) as aalbum from   app_audio "
            ." order by  app_audio.id desc limit ".$page." ,".$limit."  ";
        $query = $this->db->query($sql);
        $data =$query->result_array();
        return $data;
    }

    public function select_all_audio()
    {
        $sql="select  app_audio.* from   app_audio "
            ." order by  app_audio.id desc  ";
        $query = $this->db->query($sql);
        $data =$query->result_array();
        return $data;
    }

    function delete_audio($id){
        $this->db->where('id', $id);
        $this->db->delete('app_audio');
        return ($this->db->affected_rows() != 1) ? false : true;
    }


    function update_audio($data,$id)
    {

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('app_audio', $data);
//echo $this->db->last_query();
        return ($this->db->affected_rows() != 1) ? false : true;

//return $rowcount = $query->num_rows();
    }



}
