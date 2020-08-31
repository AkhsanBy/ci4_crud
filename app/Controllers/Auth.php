<?php 

namespace App\Controllers;

class Auth extends BaseController
{
	protected $authModel; 
	public function __construct()
	{
		$this->authModel = new \App\Models\AuthModel();
	}

	public function login()
	{
		// jika sudah ada session email kembalikan ke halaman /home
		if (session()->has('email')) {
			return redirect()->to('/home');
		}

		$data = [
			'judul' => 'Login Form',
			'subJudul' => 'Login',
			'validation' => \Config\Services::validation()
		];
		return view('auth/login', $data);
	}

	public function loginProces()
	{
		if (!$this->validate([
			'email'    => [
				'rules'  => 'required|valid_email',
				'errors' => [
					'required' => 'kolom harus diisi!',
					'valid_email' => 'email tidak valid!',
				]
			],
			'password'    => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'kolom harus diisi!'
				]
			],
		])) {
			return redirect()->to('/login')->withInput();
		}

		$email = $this->request->getVar('email', FILTER_SANITIZE_STRING);
		$password = $this->request->getVar('password', FILTER_SANITIZE_STRING);
		return $this->authModel->findUser($email, $password);
	}

	public function register()
	{
		// jika sudah ada session email kembalikan ke halaman /home
		if (session()->has('email')) {
			return redirect()->to('/home');
		}

		$data = [
			'judul' => 'Register Form',
			'subJudul' => 'Buat akun baru',
			'validation' => \Config\Services::validation()
		];
		return view('auth/register', $data);
	}

	public function registerProces()
	{
		if (!$this->validate([
			'username'    => [
				'rules'  => 'required|min_length[3]|is_unique[tbl_user.username]',
				'errors' => [
					'required' => 'kolom harus diisi!',
					'min_length' => 'username terlalu pendek!',
					'is_unique' => 'username tidak tersedia!'
				]
			],
			'email'    => [
				'rules'  => 'required|valid_email|is_unique[tbl_user.email]',
				'errors' => [
					'required' => 'kolom harus diisi!',
					'valid_email' => 'email tidak valid!',
					'is_unique' => 'email tidak tersedia!',
				]
			],
			'password1'    => [
				'rules'  => 'required|min_length[3]|matches[password2]',
				'errors' => [
					'required' => 'kolom harus diisi!',
					'min_length' => 'password terlalu pendek!',
					'matches' => 'konfirmasi password tidak sama!',
				]
			],
			'password2'    => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'kolom harus diisi!',
				]
			],
		])) {
			return redirect()->to('/register')->withInput();
		}

		$data = [
			'username' => $this->request->getVar('username', FILTER_SANITIZE_STRING),
			'email' => $this->request->getVar('email', FILTER_SANITIZE_STRING),
			'password' => $this->request->getVar('password1', FILTER_SANITIZE_STRING),
			'image' => 'default.jpg',
			'role' => 'member'
		];
		$this->authModel->save($data);
		session()->setFlashdata('pesan', 'Akun berhasil dibuat! Silakan login');
		return redirect()->to('/login');
	}

	public function logout() 
	{
		unset(
			$_SESSION['username'],
			$_SESSION['email'],
			$_SESSION['image'],
			$_SESSION['role']
		);
		session()->setFlashdata('pesan', 'logout berhasil!');
		return redirect()->to('/login');
	}
}
