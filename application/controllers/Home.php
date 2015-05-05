<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
  public function __construct($foo = null) {
    parent::__construct();
    $this->load->model('User');
    $this->load->model('Certificate');
    $this->load->library('session');
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
   $content = null;
   if($this->session->userdata('isAdmin'))
   {
    $data['content'] = $this->Certificate->all();
    $content = $this->load->view('/page/index',$data, true);
  }
  elseif($this->session->userdata('isUser'))
  {
    $arr = array('user_id' => $this->session->userdata('id'));
    $data['content'] = $this->Certificate->get($arr);
    $content = $this->load->view('/page/list',$data, true);
  }
  else
  {
   $content = $this->load->view('/page/login',null, true);
 }

 $this->render($content);
}
public function register()
{
	$content = $this->load->view('/page/register',null, true);
	$this->render($content);
}
public function postRegister()
{
  $this->load->library('form_validation');
  $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
  $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
  $this->form_validation->set_rules('cpassword', 'Konfirmasi Password', 'required|matches[password]');
  if ($this->form_validation->run())
  {
    $data = array(
      'email' => $this->input->post('email'),
        //'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
      'password' => $this->input->post('password'),
      'level' => '2'
      );
    $this->User->insert($data);
    return redirect('home/index');
  }else{
    $this->register();
  }
}
public function login()
{
	$this->load->library('form_validation');
  $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
  $this->form_validation->set_rules('password', 'Password', 'required');
  if ($this->form_validation->run())
  {
    $data = array(
      'email' => $this->input->post('email'),
      'password' => $this->input->post('password')
      );
    $this->User->attempt($data);

  }      
  return redirect('home/index');

}
public function logout()
{

  $this->session->sess_destroy();
  return redirect('home/index');
}


}
