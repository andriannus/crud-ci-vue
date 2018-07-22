<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Authors extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('author_model', 'author');
	}

	public function index_get()
	{
		$authors = $this->author->index();

		$this->response([
			'success' => true,
			'message' => 'Mendapatkan semua data Pengarang',
			'data' => $authors->result()
		], 200);
	}

	public function index_post()
	{
		$pengarang = $this->post('pengarang');
		$tgl_lahir = $this->post('tgl_lahir');

		$data = [
			'pengarang' => $pengarang,
			'tgl_lahir' => $tgl_lahir
		];

		$result = $this->author->store($data);

		if ($result) {
			$this->response([
				'success' => true,
				'message' => 'Data Pengarang berhasil disimpan'
			], 201);
			
		} else {
			$this->response([
				'success' => false,
				'message' => 'Gagal saat menyimpan data Pengarang'
			], 500);
		}
	}

	public function index_update()
	{
		$id = $this->input->get('id');
		$pengarang = $this->input->get('pengarang');
		$tgl_lahir = $this->input->get('tgl_lahir');

		$data = [
			'pengarang' => $pengarang,
			'tgl_lahir' => $tgl_lahir
		];

		$result = $this->author->update($data, $id);

		if ($result) {
			$this->response([
				'success' => true,
				'message' => 'Data Pengarang berhasil diperbarui'
			], 200);
			
		} else {
			$this->response([
				'success' => false,
				'message' => 'Gagal saat membarui data Pengarang'
			], 500);
		}
	}

	public function index_delete()
	{
		$id = $this->query('id');

		$result = $this->author->destroy($id);

		if ($result) {
			$this->response([
				'success' => true,
				'message' => 'Data Pengarang berhasil dihapus'
			], 200);
			
		} else {
			$this->response([
				'success' => false,
				'message' => 'Gagal saat menghapus data Pengarang'
			], 500);
		}
	}
}
