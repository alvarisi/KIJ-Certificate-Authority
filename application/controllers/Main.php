<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include(APPPATH.'/third_party/phpseclib/Crypt/RSA.php');
include(APPPATH.'/third_party/phpseclib/File/X509.php');

class Main extends CI_Controller {
     public function __construct($foo = null) {
         parent::__construct();
         $this->load->model('User');
         $this->load->model('Certificate');
         $this->load->model('Country');
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
        $data['country'] = $this->Country->all();
        $content = $this->load->view('/page/index',$data, true);
        $this->render($content);
    }

    public function lists()
    {
       $data = null;
       if($this->session->userdata('isAdmin'))
           $data['content'] = $this->Certificate->all();	
       else
       {
           $arr = array('user_id' => $this->session->userdata('id'));
           $data['content'] = $this->Certificate->get($arr);
       }
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
               'user_id' => $this->session->userdata('id')
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
        $arr = array('id' => $id);
        $certificate = $this->Certificate->first($arr)->row();
        if($certificate->status != '1')
          return "Forbidden";
        $this->generate($type, $certificate);

    }
    function generate($type, $data)
    {
         $handle = fopen('./public/ca/pk.txt', "r");
         $pk = fread($handle, filesize('./public/ca/pk.txt'));
         fclose($handle);
         $CAPrivKey = new Crypt_RSA();
         extract($CAPrivKey->createKey());
         $CAPrivKey->loadKey($pk);

         $handle = fopen('./public/ca/pb.txt', "r");
         $pb = fread($handle, filesize('./public/ca/pb.txt'));
         fclose($handle);
         $pubKey = new Crypt_RSA();
         $pubKey->loadKey($pb);
         $pubKey->setPublicKey();

         // for client
         $privKey = new Crypt_RSA();
         extract($privKey->createKey());
         $privKey->loadKey($pk);

         $pubKey = new Crypt_RSA();
         $pubKey->loadKey($pb);
         $pubKey->setPublicKey();

         $subject = new File_X509();
         $subject->setDNProp('id-at-organizationName', $data->organization_name);
         $subject->setPublicKey($pubKey);

         $issuer = new File_X509();
         $issuer->setPrivateKey($CAPrivKey);
         $issuer->setDN($CASubject= $subject->getDN());

         $x509 = new File_X509();
         $result = $x509->sign($issuer, $subject);
         $file = '';
         if($type == 'private-key')
         {
              $file = './public/client/pk_'.$data->organization_name.'.txt';
              $f = fopen($file, "w");
              fwrite($f, $privKey->getPrivateKey());
              fclose($f);     
         }elseif($type=='cert'){
              $file = './public/client/csr_'.$data->organization_name.'.crt';
              $f = fopen($file, "w");
              fwrite($f, $x509->saveX509($result));
              fclose($f); 
         }elseif($type=='key-pair'){
             $file = './public/client/kp_'.$data->organization_name.'.txt';
             $f = fopen($file, "w");
             fwrite($f, $privKey->getPrivateKey());
             fwrite($f, $pubKey->getPublicKey());
             fclose($f);
         }elseif($type=='csr'){
             $file = './public/client/pk_'.$data->organization_name.'.txt';
              $f = fopen($file, "w");
              fwrite($f, $privKey->getPrivateKey());
              fclose($f);
         }
         
         if (file_exists($file)) {
          header('Content-Description: File Transfer');
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: attachment; filename='.basename($file));
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          header('Content-Length: ' . filesize($file));
          readfile($file);
          exit;
     }
    }
    public function changeStatus($id = null, $status = '0')
    {

      if(empty($id) || empty($status))
      {
        return redirect('main/lists');
      }
      $arr = array('id' => $id, 'status' => $status);

      $this->Certificate->update($arr);
      return redirect('main/lists');
    }

    // public function start2()
    // {
    //      $data = array('email' => 'admin@local.com', 'password' => '12345','level' => '1');
    // //		$this->User->insert($data);
    //      $arr_t = array(
    //           'countryName' => 'ID',
    //           'stateOrProvinceName' => 'Jawa Timur',
    //           'localityName' => 'Surabaya',
    //           'organizationName' => 'Institut Teknologi Sepuluh Nopember',
    //           'organizationalUnitName' => 'Teknik Informatika',
    //           'commonName' => 'KIJ',
    //           'emailAddress' => 'admin@local.com'
    //           );
    //      $ca = new CertificateAuthority($arr_t);
    //      $pk = $ca->set_private_key();
    //      $csr = $ca->generateCSR();
    //      $sscert = $ca->selfSign($csr);
    //      openssl_x509_export_to_file($sscert,base_url().'public/ca/ca.crt');
    // //		openssl_csr_export($csr, $csrout) and var_dump($csrout);
    // }
    public function start()
    {
        $data = array('email' => 'admin@local.com', 'password' => '12345','level' => '1');
        $this->User->insert($data);
         //create private key for CA Cert
         $CAPrivKey = new Crypt_RSA();
         extract($CAPrivKey->createKey());
         $CAPrivKey->loadKey($privatekey);

         $pubKey = new Crypt_RSA();
         $pubKey->loadKey($publickey);
         $pubKey->setPublicKey();

         $f = fopen('./public/ca/pk.txt', "w");
         fwrite($f, $privatekey);
         fclose($f);

         $f = fopen('./public/ca/pb.txt', "w");
         fwrite($f, $publickey);
         fclose($f);

         // create a self-signed cert that'll serve as the CA
         $subject = new File_X509();
         $subject->setDNProp('id-at-organizationName', 'Institut Teknologi Sepuluh Nopember');
         $subject->setPublicKey($pubKey);

         $issuer = new File_X509();
         $issuer->setPrivateKey($CAPrivKey);
         $issuer->setDN($CASubject = $subject->getDN());

         $x509 = new File_X509();
         $x509->makeCA();

         $result = $x509->sign($issuer, $subject);

         $f = fopen('./public/ca/ca.crt', "w");
         fwrite($f, $x509->saveX509($result));
         fclose($f);
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

    public function selfSign($csr, $days=365, $cacert=null)
    {
         $sscert = openssl_csr_sign($csr, $cacert, $this->private_key, $days);
         return $sscert;
    }

}
