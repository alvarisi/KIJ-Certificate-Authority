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
    $this->form_validation->set_rules('common_name', 'Nama', 'required');
    $this->form_validation->set_rules('email_address', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('country_name', 'Negara', 'required');
    $this->form_validation->set_rules('state_name', 'Provinsi', 'required');
    $this->form_validation->set_rules('locality_name', 'Locality', 'required');
    $this->form_validation->set_rules('organization_name', 'Organisasi', 'required');
    $this->form_validation->set_rules('organizational_unit', 'Unit Organisasi', 'required');
    if ($this->form_validation->run())
    {
      $data = array(
        'common_name' => $this->input->post('common_name'),
        'email_address' => $this->input->post('email_address'),
        'country_name' => $this->input->post('country_name'),
        'state_name' => $this->input->post('state_name'),
        'locality_name' => $this->input->post('locality_name'),
        'organization_name' => $this->input->post('organization_name'),
        'organizational_unit' => $this->input->post('organizational_unit'),
        );
      $this->Certificate->insert($data);
      return redirect('main/lists');
    }else{
      $this->index();
    }

  }
  public function download($type=null, $id=null)
  {
    if(empty($type) or empty($id))
      return redirect('main/lists');
    switch ($type) {
      case 'private-key':
      $arr = array('id' => $id);
      $certificate = $this->Certificate->first($arr)->row();
      $arr_t = array(
        'countryName' => $certificate->country_name,
        'stateOrProvinceName' => $certificate->state_name,
        'localityName' => $certificate->locality_name,
        'organizationName' => $certificate->organization_name,
        'organizationalUnitName' => $certificate->organizational_unit,
        'commonName' => $certificate->common_name,
        'emailAddress' => $certificate->email_address
        );
      $ca = new CertificateAuthority($arr_t);
      $pk = $ca->set_private_key();
      var_dump($pk);
      $csr = $ca->generateCSR();
// $sscert = $ca->selfSign($csr);
// openssl_csr_export($csr, $csrout) and var_dump($csrout);
// openssl_x509_export($sscert, $certout) and var_dump($certout);
      break;

      default:
# code...
      break;
    }
  }
}

Class CertificateAuthority {
  protected $private_key;
  protected $dn;
  public function __construct($data = null) {
    $this->dn = $data;
  }
  public function set_private_key()
  {
    $config = array(
      "digest_alg" => "sha512",
      "private_key_bits" => 4096,
      "private_key_type" => OPENSSL_KEYTYPE_RSA,
      );
    $this->private_key = openssl_pkey_new($config);
    return $this->private_key;
  }
  public function generateCSR()
  {
    $config = array(
      "digest_alg" => "sha512",
      "private_key_bits" => 4096,
      "private_key_type" => OPENSSL_KEYTYPE_RSA,
      );
    $this->private_key = openssl_pkey_new($config);
    $csr = openssl_csr_new($this->dn, $this->private_key);
    return $csr;
  }
  public function selfSign($csr, $days=365)
  {
    $sscert = openssl_csr_sign($csr, null, $this->private_key, $days);
    return $sscert;
  }
}