<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Books extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('book_model', 'book');
	}

	public function index_get()
	{
		$books = $this->book->index();

		$this->response([
			'success' => true,
			'message' => 'Mendapatkan semua data buku',
			'data' => $books->result()
		]);
	}

	public function index_post()
	{
		$judul = $this->input->post('judul');
		$pengarang = $this->input->post('pengarang');
		$kategori = $this->input->post('kategori');
		$tanggal = $this->input->post('tanggal');

		$data = [
			'judul' => $judul,
			'pengarang' => $pengarang,
			'kategori' => $kategori,
			'tanggal' => $tanggal
		];

		$result = $this->book->store($data);

		if ($result) {
			$this->response([
				'success' => true,
				'message' => 'Data buku berhasil disimpan'
			], 201);
			
		} else {
			$this->response([
				'success' => false,
				'message' => 'Gagal saat menyimpan data buku'
			], 500);
		}
	}

	public function index_update()
	{
		$id = $this->input->post('id');
		$judul = $this->input->post('judul');
		$kategori = $this->input->post('kategori');
		$tanggal = $this->input->post('tanggal');

		$data = [
			'judul' => $judul,
			'pengarang' => $pengarang,
			'kategori' => $kategori,
			'tanggal' => $tanggal
		];

		$result = $this->book->update($data, $id);

		if ($result) {
			$this->response([
				'success' => true,
				'message' => 'Data buku berhasil diperbaui'
			], 200);
			
		} else {
			$this->response([
				'success' => false,
				'message' => 'Gagal saat membarui data buku'
			], 500);
		}
	}

	public function index_delete()
	{
		$id = $this->query('id');

		$result = $this->book->destroy($id);

		if ($result) {
			$this->response([
				'success' => true,
				'message' => 'Data buku berhasil dihapus'
			], 200);

		} else {
			$this->response([
				'success' => false,
				'message' => 'Gagal saat menghapus data buku'
			], 500);
		}
	}
}
