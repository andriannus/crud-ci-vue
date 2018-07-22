<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Categories extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('category_model', 'category');
	}

	public function index_get()
	{
		$categories = $this->category->index();

		$this->response([
			'success' => true,
			'message' => 'Mendapatkan semua data kategori',
			'data' => $categories->result()
		], 200);
	}

	public function index_post()
	{
		$kategori = $this->post('kategori');
		$deskripsi = $this->post('deskripsi');

		$data = [
			'kategori' => $kategori,
			'deskripsi' => $deskripsi
		];

		$result = $this->category->store($data);

		if ($result) {
			$this->response([
				'success' => true,
				'message' => 'Data kategori berhasil disimpan'
			], 201);

		} else {
			$this->response([
				'success' => false,
				'message' => 'Gagal saat menyimpan data kategori'
			], 500);
		}
	}

	public function index_update()
	{
		$id = $this->input->post('id');
		$kategori = $this->input->post('kategori');
		$deskripsi = $this->input->post('deskripsi');

		$data = [
			'kategori' => $kategori,
			'deskripsi' => $deskripsi
		];

		$result = $this->category->update($data, $id);

		if ($result) {
			$this->response([
				'success' => false,
				'message' => 'Data kategori berhasil diperbaui'
			], 200);

		} else {
			$this->response([
				'success' => false,
				'message' => 'Gagal saat membarui data kategori'
			], 500);
		}
	}

	public function index_delete()
	{
		$id = $this->query('id');

		$result = $this->category->destroy($id);

		if ($result) {
			$this->response([
				'success' => true,
				'message' => 'Data kategori berhasil dihapus'
			], 200);

		} else {
			$this->response([
				'success' => false,
				'message' => 'Gagal saat menghapus data kategori'
			], 500);
		}
	}
}
