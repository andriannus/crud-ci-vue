<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book_model extends CI_Model {

	public $table = 'tb_buku';
	public $id = 'id_buku';

	public function index()
	{
		$this->db->join('tb_pengarang', 'tb_pengarang.id_pengarang = tb_buku.id_buku');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_buku.id_buku');
		$this->db->order_by('id_buku', 'DESC');
		$result = $this->db->get($this->table);
		return $result;
	}

	public function view($id)
	{
		$this->db->where($this->id, $id);
		$this->db->join('tb_pengarang', 'tb_pengarang.id_pengarang = tb_buku.id_buku');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_buku.id_buku');
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