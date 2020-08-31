<?php 

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{	
	protected $table = 'tbl_user';
	protected $primaryKey = 'id';
	protected $allowedFields = ['username', 'email', 'password', 'image', 'role'];

	public function findUser($email, $password)
	{
		$user = $this->where(['email' => $email, 'password' => $password])->first();

		if ($user) {
			$data = [
				'username'  => $user['username'],
				'email'     => $user['email'],
				'image'     => $user['image'],
				'role' 		=> $user['role'] 
			];
			session()->set($data);
			return redirect()->to('/home');
		} else {
			session()->setFlashData('kesalahan', 'Email/password salah!');
			return redirect()->to('/login');
		}
	}
}