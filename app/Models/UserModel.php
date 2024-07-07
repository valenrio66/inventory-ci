<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $table = 'user';
	protected $primaryKey = 'id_user';
	protected $allowedFields = ['username', 'password', 'nama', 'role', 'email', 'no_hp'];
	protected $beforeInsert = ['beforeInsert'];
	protected $beforeUpdate = ['beforeUpdate'];

	protected function beforeInsert(array $data)
	{
		$data = $this->passwordHash($data);
		return $data;
	}

	protected function beforeUpdate(array $data)
	{
		$data = $this->passwordHash($data);
		return $data;
	}

	protected function passwordHash(array $data)
	{
		if (isset($data['data']['password'])) {
			$data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
			// Debug statement
			log_message('debug', 'Password hashed: ' . $data['data']['password']);
		}
		return $data;
	}

	// Untuk Create User
	public function createUser($data)
	{
		$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
		return $this->insert($data);
	}

	public function logout()
	{
		session()->destroy();
		return redirect()->to('/login');
	}
}
