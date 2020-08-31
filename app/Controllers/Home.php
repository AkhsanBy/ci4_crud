<?php 

namespace App\Controllers;

class Home extends BaseController
{
	protected $bukuModel;
	public function __construct()
	{
		$this->bukuModel = new \App\Models\BukuModel();
	}

	public function index()
	{
		// jika tidak ada session email kembalikan ke halaman /login
		if (!session()->has('email')) {
			return redirect()->to('login');
		}

		$data = [
			'judul' => 'Home',
			'username' => session()->get('username'),
			'image' => session()->get('image'),
			'buku' => $this->bukuModel->getBuku()
		];
		return view('home/index', $data);
	}
}
