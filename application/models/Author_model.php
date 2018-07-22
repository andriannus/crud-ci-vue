<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Author_model extends CI_Model {

	public $table = 'tb_pengarang';
	public $id = 'id_pengarang';

	public function index()
	{
		$result = $this->db->get($this->table);
		return $result;
	}

	public function view($id)
	{
		$this->db->where($this->id, $id);
		$result = $this->db->get($this->table);
		return $result;
	}

	public function store($data)
	{
		$this->db->insert($this->table, $data);
		if ($this->db->affected_rows()) {
			return true;

		} else {
			return false;
		}
	}

	public function update($data, $id)
	{
		$this->db->where($this->id, $id);
		$this->db->update($this->table, $data);
		if ($this->db->affected_rows()) {
			return true;

		} else {
			return false;
		}
	}

	public function destroy($id)
	{
		$this->db->where($this->id, $id);
		$this->db->delete($this->table);
		if ($this->db->affected_rows()) {
			return true;

		} else {
			return false;
		}
	}
}