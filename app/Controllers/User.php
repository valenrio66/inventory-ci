<?php 

namespace App\Controllers;
use App\Models\UserModel;

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
		return view('user/user_create');
	}

	public function createUser()
	{
		$userModel = new UserModel();
		$data = $this->request->getPost();

		// Debug statement
		log_message('debug', 'User data before insert: ' . json_encode($data));

		if ($userModel->save($data)) {
			return redirect()->to('/dashboard')->with('message', 'User berhasil ditambahkan');
		} else {
			return redirect()->back()->withInput()->with('errors', $userModel->errors());
		}
	}

}
?>