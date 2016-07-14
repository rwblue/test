<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Home extends MX_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('test_model');
    }

	protected function _getData()
	{
		$data = $this->test_model->get();
		return $data;
	}


	public function index(){
		$init_data = $this->_getData();
		$data['init'] = $init_data;
		$this->load->view('home', $data);
	}

	// function for insert
	public function request()
	{
		$post = $this->input->post();
		//check value
		$flag = false;
		foreach($post as $key => $val)
		{
			if(trim($val)=="")
			{
				$flag = true;
				exit;
			}
		}
		//generate hash
		$post['uuid'] = hash('sha256', mktime());
		//process it
		if(!$flag)
		{
			$ret = $this->test_model->set($post);
			echo json_encode(array('success'=> $ret));
		}
		else
			echo json_encode(array('success'=>false));
	}


	public function get_ajax()
	{
		$init_data = $this->_getData();
		return json_encode($init_data);
	}

}