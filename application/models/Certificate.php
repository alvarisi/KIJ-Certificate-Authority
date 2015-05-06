<?php 
class Certificate extends CI_Model {

	protected $table;

	public function __construct(){
		parent::__construct();
		$this->table = 'certificate';
	}

	function insert($data)
	{
		$this->db->insert($this->table, $data);
	}

	function update($data_t)
	{
		$data = array('status' => $data_t['status']);
		$this->db->where('id', $data_t['id']);
		$this->db->update($this->table, $data);
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