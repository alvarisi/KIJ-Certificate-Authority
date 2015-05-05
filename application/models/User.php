<?php 
class User extends CI_Model {

	protected $table;

	public function __construct(){
		parent::__construct();
		$this->table = 'user';
	}
	
	protected $details;	
	
	function attempt($data)
	{
		$query = $this->db->get_where($this->table, $data);
		if($query->num_rows() > 0)
		{
			$this->details = $query->row();
			$this->setSession();
			return true;
		}
		else
		{
			return false;
		}
	}
	function setSession()
	{
		$data = $this->details;
		$admin = false;
		$arr = array('id' => $data->id,'email'=> $data->email );
		if($data->level=='1')
		{
			$arr['isAdmin'] = true;
			$arr['isUser'] = false;
		}else
		{
			$arr['isAdmin'] = false;
			$arr['isUser'] = true;
		}
		$this->session->set_userdata($arr);
	}
	function insert($data)
	{
		$this->db->insert($this->table, $data);
	}

	function update($data)
	{
		$this->db->replace($this->table, $data);
	}
	function delete($data)
	{
		$this->db->delete($this->table, $data);
	}

	function get($data,$limit = null, $offset = null)
	{
		$query = $this->db->get_where($this->table, $data, $limit, $offset);
		return $query;
	}
	function first($data)
	{
		$query = $this->db->get_where($this->table,$data,1);
		return $query;
	}
	function all()
	{
		$query = $this->db->get($this->table);
		return $query;
	}
}
