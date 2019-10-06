<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Playlist_model extends CI_Model {

    function __construct()
    {
// Call the Model constructor
        parent::__construct();
    }

    function get_playlist($id)
    {
        $query = $this->db->get_where('app_playlist', array('id' => $id), 1);
        $data =$query->row_array();
//echo $this->db->last_query();
        return $data;
    }

    function insert_playlist($data)
    {
        $this->db->insert('app_playlist', $data);
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


    function count_playlist()
    {
        $sql=" select  app_playlist.*  from   app_playlist ";
        $query = $this->db->query($sql);
        return $rowcount = $query->num_rows();
    }


    public function pagination_select_playlist($limit, $page=null)
    {
        $sql="select  app_playlist.* from   app_playlist "
            ." order by  app_playlist.id desc limit ".$page." ,".$limit."  ";
        $query = $this->db->query($sql);
        $data =$query->result_array();
        return $data;
    }

    public function select_all_playlist()
    {
        $sql="select  app_playlist.* from   app_playlist "
            ." order by  app_playlist.id desc  ";
        $query = $this->db->query($sql);
        $data =$query->result_array();
        return $data;
    }

    function delete_playlist($id){
        $this->db->where('id', $id);
        $this->db->delete('app_playlist');
        return ($this->db->affected_rows() != 1) ? false : true;
    }


    function update_playlist($data,$id)
    {

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('app_playlist', $data);
//echo $this->db->last_query();
        return ($this->db->affected_rows() != 1) ? false : true;

//return $rowcount = $query->num_rows();
    }



}
