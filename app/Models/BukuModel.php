<?php 

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{	
	protected $table = 'tbl_buku';
	protected $primaryKey = 'id';
	protected $allowedFields = ['judul', 'pengarang', 'penerbit', 'image'];

	public function getBuku($id = false)
	{
		if ($id == false) {
			return $this->findAll();
		}
		return $this->where(['id' => $id])->first();
	}
}