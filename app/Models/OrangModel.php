<?php 

namespace App\Models;

use CodeIgniter\Model;

class OrangModel extends Model
{	
	protected $table = 'tbl_orang';
	protected $primaryKey = 'nik';
	protected $allowedFields = ['nama', 'nik', 'alamat'];

	public function getOrang($nik = false)
	{
		if ($nik == false) {
			return $this->findAll();
		}
		return $this->where(['nik' => $nik])->first();
	}
}