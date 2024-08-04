<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $table = 'user';
	protected $primaryKey = 'id_user';
	protected $allowedFields = ['username', 'password', 'nama', 'role', 'email', 'no_hp', 'status'];
	protected $beforeInsert = ['beforeInsert'];
	protected $beforeUpdate = ['beforeUpdate'];

	// Untuk Get User by ID
    public function getUserById($id)
    {
        return $this->find($id);
    }

	// Untuk Create User
	public function createUser($data)
	{
		$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
		return $this->insert($data);
	}

    // Untuk Update Data
    public function updateUser($id, $data)
    {
        return $this->update($id, $data);
    }

    // Untuk Delete Data
    public function deleteUser($id)
    {
        return $this->delete($id);
    }

	public function logout()
	{
		session()->destroy();
		return redirect()->to('/login');
	}
}
