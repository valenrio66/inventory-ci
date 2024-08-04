<?php 

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\AuthModel;

class User extends BaseController
{
	// Get All User
	public function getAllUser(): string
	{
		$userModel = new UserModel();
		$data['users'] = $userModel->findAll();

		return view('admin/user_view', $data);
	}
	
	// Function for Create User
	public function renderPageCreateUser(): string
	{
		return view('admin/user_add');
	}

	// Function for Create User
	public function createUser()
	{
		$authModel = new AuthModel();
		$data = [
			'username' => $this->request->getPost('username'),
			'password' => $this->request->getPost('password'),
			'nama' => $this->request->getPost('nama'),
			'role' => $this->request->getPost('role'),
			'email' => $this->request->getPost('email'),
			'status' => $this->request->getPost('status'),
			'no_hp' => $this->request->getPost('no_hp'),
		];
	
		if ($authModel->insert($data)) {
			return redirect()->to('/dashboard/user');
		} else {
			return redirect()->back()->withInput()->with('errors', $authModel->errors());
		}
	}

	// Render Page Detail User
	public function renderPageDetailUser($id): string
    {
        $userModel = new UserModel();
		$data['users'] = $userModel->getUserById($id);
		
		return view('admin/user_detail', $data);
    }

	// Delete User
	public function deleteUser($id)
	{
		$userModel = new UserModel();
		if ($userModel->deleteUserModel($id)) {
			// Debugging message
			return redirect()->to('/dashboard/user')->with('message', 'User berhasil dihapus');
		} else {
			// Debugging message
			return redirect()->back()->with('message', 'Gagal menghapus user');
		}
	}

}
?>