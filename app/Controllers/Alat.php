<?php 

namespace App\Controllers;

class Alat extends BaseController
{
	protected $bukuModel;
	protected $orangModel;
	public function __construct()
	{
		$this->bukuModel = new \App\Models\BukuModel();
		$this->orangModel = new \App\Models\OrangModel();
	}

	public function buku()
	{
		// jika tidak ada session email kembalikan ke halaman /login
		if (!session()->has('email')) {
			return redirect()->to('login');
		}

		$data = [
			'judul' => 'Buku',
			'username' => session()->get('username'),
			'image' => session()->get('image'),
			'buku' => $this->bukuModel->getBuku()
		];
		return view('alat/buku', $data);
	}

	public function tambahBuku()
	{
		$data = [
			'judul' => 'Form tambah buku',
			'username' => session()->get('username'),
			'image' => session()->get('image'),
			'validation' => \Config\Services::validation()
		];
		return view('alat/tambahbuku', $data);
	}

	public function prosesTambahBuku()
	{
		if (!$this->validate([
			'judul'    => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'kolom harus diisi!'
				]
			],
			'pengarang'    => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'kolom harus diisi!'
				]
			],
			'penerbit'    => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'kolom harus diisi!'
				]
			],
			'image'    => [
				'rules'  => 'max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/png,image/jpeg]',
				'errors' => [
					'max_size' => 'image terlalu besar!',
					'is_image' => 'ini bukan gambar!',
					'mime_in' => 'ini bukan gambar!',
				]
			],
		])) { 
			return redirect()->to('/alat/tambahbuku')->withInput();
		}

		// ambil gambar dari form
		$fileImage = $this->request->getFile('image');

		// jika tidak upload image
		if ($fileImage->getError() == 4) {
			$nameImage = 'default.jpg';
		} else { // jika upload image
			// mendapatkan nama random
			$nameImage = $fileImage->getRandomName();
			// memindahkan gambar ke folder public/img/buku
			$fileImage->move('img/buku', $nameImage);			
		}

		$data = [
			'judul' => $this->request->getVar('judul'),
			'pengarang' => $this->request->getVar('pengarang'),
			'penerbit' => $this->request->getVar('penerbit'),
			'image' => $nameImage
		];
		$this->bukuModel->save($data);
		session()->setFlashdata('pesan', 'buku berhasil ditambah');
		return redirect()->to('/alat/buku');
	}

	public function editBuku($id)
	{
		$data = [
			'judul' => 'Form edit buku',
			'username' => session()->get('username'),
			'image' => session()->get('image'),
			'buku' => $this->bukuModel->getBuku($id),
			'validation' => \Config\Services::validation()
		];
		return view('alat/editbuku', $data);
	}

	public function prosesEditBuku($id)
	{
		if (!$this->validate([
			'judul'    => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'kolom harus diisi!'
				]
			],
			'pengarang'    => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'kolom harus diisi!'
				]
			],
			'penerbit'    => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'kolom harus diisi!'
				]
			],
			'image'    => [
				'rules'  => 'max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/png,image/jpeg]',
				'errors' => [
					'max_size' => 'image terlalu besar!',
					'is_image' => 'ini bukan gambar!',
					'mime_in' => 'ini bukan gambar!',
				]
			],
		])) { 
			return redirect()->to('/alat/editbuku' . $this->request->getVar('id'))->withInput();
		}

		// ambil gambar dari form
		$fileImage = $this->request->getFile('image');

		// ambil nama gambar lama dari form hidden
		$oldImage = $this->request->getVar('oldImage');

		// jika tidak upload image
		if ($fileImage->getError() == 4) {
			$nameImage = $oldImage;
		} else { // jika upload image
			// mendapatkan nama random
			$nameImage = $fileImage->getRandomName();
			// memindahkan gambar ke folder public/img/buku
			$fileImage->move('img/buku', $nameImage);	
			// hapus file image lama
			unlink('img/buku' . $oldImage);		
		}

		$data = [
			'id' => $id,
			'judul' => $this->request->getVar('judul'),
			'pengarang' => $this->request->getVar('pengarang'),
			'penerbit' => $this->request->getVar('penerbit'),
			'image' => $nameImage
		];
		$this->bukuModel->save($data);
		session()->setFlashdata('pesan', 'buku berhasil diedit');
		return redirect()->to('/alat/buku');
	}

	public function hapusbuku($id)
	{
		// cari image di database
		$buku = $this->bukuModel->find($id);

		// cek jika file image default.jpg
		if ($buku['image'] !== 'default.jpg') {
			// hapus image
			unlink('img/buku/' . $buku['image']);
		}


		$this->bukuModel->delete($id);
		session()->setFlashdata('pesan', 'buku berhasil dihapus');
		return redirect()->to('/alat/buku');
	}

///////////////////////////////////////////////////////////////////////////////

	public function orang()
	{
		// jika tidak ada session email kembalikan ke halaman /login
		if (!session()->has('email')) {
			return redirect()->to('login');
		}

		$data = [
			'judul' => 'Orang',
			'username' => session()->get('username'),
			'image' => session()->get('image'),
			'orang' => $this->orangModel->getOrang()
		];
		return view('alat/orang', $data);
	}

	public function tambahOrang()
	{
		$data = [
			'judul' => 'Form tambah orang',
			'username' => session()->get('username'),
			'image' => session()->get('image'),
			'validation' => \Config\Services::validation()
		];
		return view('alat/tambahorang', $data);
	}

	public function prosesTambahOrang()
	{
		if (!$this->validate([
			'nama'    => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'kolom harus diisi!'
				]
			],
			'nik'    => [
				'rules'  => 'required|is_unique[tbl_orang.nik]',
				'errors' => [
					'required' => 'kolom harus diisi!'
				]
			],
			'alamat'    => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'kolom harus diisi!'
				]
			],
		])) { 
			return redirect()->to('/alat/tambahorang')->withInput();
		}

		$data = [
			'nama' => $this->request->getVar('nama'),
			'nik' => $this->request->getVar('nik'),
			'alamat' => $this->request->getVar('alamat')
		];
		$this->orangModel->insert($data);
		session()->setFlashdata('pesan', 'orang berhasil ditambah');
		return redirect()->to('/alat/orang');
	}

	public function editOrang($nik)
	{
		$data = [
			'judul' => 'Form edit orang',
			'username' => session()->get('username'),
			'image' => session()->get('image'),
			'orang' => $this->orangModel->getOrang($nik),
			'validation' => \Config\Services::validation()
		];
		return view('alat/editorang', $data);
	}

	public function prosesEditOrang($nik)
	{
		if ($this->orangModel->where(['nik' => $nik])) {
			$rules = 'required';
		} else {
			$rules = 'required|is_unique[tbl_orang.nik]';
		}

		if (!$this->validate([
			'nama'    => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'kolom harus diisi!'
				]
			],
			'nik'    => [
				'rules'  => $rules,
				'errors' => [
					'required' => 'kolom harus diisi!'
				]
			],
			'alamat'    => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'kolom harus diisi!'
				]
			],
		])) { 
			return redirect()->to('/alat/editorang/' . $this->request->getVar('nik'))->withInput();
		}

		$data = [
			'nama' => $this->request->getVar('nama'),
			'nik' => $this->request->getVar('nik'),
			'alamat' => $this->request->getVar('alamat')
		];
		$this->orangModel->update($nik, $data);
		session()->setFlashdata('pesan', 'orang berhasil diedit');
		return redirect()->to('/alat/orang');
	}

	public function hapusorang($nik)
	{
		$this->orangModel->delete($nik);
		session()->setFlashdata('pesan', 'orang berhasil dihapus');
		return redirect()->to('/alat/orang');
	}
}
