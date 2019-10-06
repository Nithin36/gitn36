
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Course_model extends CI_Model {

    function __construct()
    {
// Call the Model constructor
        parent::__construct();
    }

    function get_course($id)
    {
        $query = $this->db->get_where('app_course', array('id' => $id), 1);
        $data =$query->row_array();
//echo $this->db->last_query();
        return $data;
    }

    function insert_course($data)
    {
        $this->db->insert('app_course', $data);
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


    function count_course_offline()
{
    $sql=" select   app_course.*  from  app_course where app_course.online=0 ";
    $query = $this->db->query($sql);
    return $rowcount = $query->num_rows();
}


    public function pagination_select_course_offline($limit, $page=null)
    {
        $sql="select   app_course.* from   app_course where app_course.online=0 "
            ." order by  app_course.id desc limit ".$page." ,".$limit."  ";
        $query = $this->db->query($sql);
        $data =$query->result_array();
        return $data;
    }

    public function select_all_course_offline()
    {
        $sql="select  app_course.* from   app_course where app_course.online=0"
            ." order by  app_course.id desc  ";
        $query = $this->db->query($sql);
        $data =$query->result_array();
        return $data;
    }

    function count_course_online()
    {
        $sql=" select   app_course.*  from  app_course where app_course.online=1 ";
        $query = $this->db->query($sql);
        return $rowcount = $query->num_rows();
    }


    public function pagination_select_course_online($limit, $page=null)
    {
        $sql="select   app_course.*,(select app_courseplan.price from app_courseplan where app_courseplan.course=app_course.id) as cprice from   app_course where app_course.online=1 "
            ." order by  app_course.id desc limit ".$page." ,".$limit."  ";
        $query = $this->db->query($sql);
        $data =$query->result_array();
        return $data;
    }

    public function select_all_course_online()
    {
        $sql="select  app_course.* from   app_course where app_course.online=1"
            ." order by  app_course.id desc  ";
        $query = $this->db->query($sql);
        $data =$query->result_array();
        return $data;
    }

    function delete_course($id){
        $this->db->where('id', $id);
        $this->db->delete('app_course');
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    function update_course($data,$id)
    {

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('app_course', $data);

        return ($this->db->affected_rows() != 1) ? false : true;

    }



}
