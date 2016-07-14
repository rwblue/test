<?php
/*
	Test_model : user table

*/
class Test_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }


    /* Get all data from table user */
    function get()
    {
    	$query = $this->db->get('user');
    	if($query->num_rows())
    	{
    		return $query->result_array();
    	}
    	else return array();
    }


    /* Insert new data to table user */
    function set($data)
    {
    	//check already duplicated name
    	$this->db->where('name', $data['name']);
    	$query = $this->db->get('user');
    	$total = $query->num_rows();
    	if($total > 0)
    		return false;

    	foreach($data as $key => $val)
    	{
    		// looping each key and value and set to assign to key in user table
    		$this->db->set($key, $val);
    	}
    	$this->db->insert('user');

    	//return true or not if successfully insert the data
    	$return = ($this->db->affected_rows() != 1) ? false : true;
    	return $return;

    }

}
?>