<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct($foo = null) {
		parent::__construct();
		$this->load->model('Certificate');
	}

	protected $layout = '/layout/app';
	protected $nav = '/include/nav';
	protected $stylesheets = array(
	    'bootstrap.min.css',
	    'bootflat.min.css',
	    'style.css'
  	);
  	protected $javascripts = array(
  		'jquery-1.10.1.min.js',
  		'bootstrap.min.js'
  	  	);
  	protected function get_stylesheets() {
	    return $this->stylesheets;
  	}
  	protected function get_javascripts() {
    	return $this->javascripts;
  	}
  	protected function render($content) {
  		
        $view_data = array(
        
    		'content' => $content,
      		'stylesheets' => $this->get_stylesheets(),
      		'javascripts' => $this->get_javascripts()
    	);
    	$this->load->view($this->layout,$view_data);
  	}
  	public function index()
  	{
  		$data['content'] = $this->Certificate->all();
  		$content = $this->load->view('/page/index',$data, true);
  		$this->render($content);
  	}

    public function lists()
    {
      $data['content'] = $this->Certificate->all();
      $content = $this->load->view('/page/list',$data, true);
      $this->render($content);
    }
    public function add()
    {
      $this->load->library('upload');
      $this->load->library('form_validation');
      $this->form_validation->set_rules('name', 'Nama Perusahaan', 'required');
      $this->form_validation->set_rules('hashing_type', 'Type Hashing', 'required');
      if ($this->form_validation->run())
      {

      }else{
        $this->index();
      }
      
    }
}
