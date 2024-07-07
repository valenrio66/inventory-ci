<?php 

namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
	public function login(): string
	{
		// Untuk menampilkan view form registrasi
		return view('user/login');
	}

	public function attemptLogin()
	{
		$userModel = new UserModel();
		$username = $this->request->getVar('username');
		$password = $this->request->getVar('password');

		// Debug statement
		log_message('debug', 'Attempting login for username: ' . $username);

		$user = $userModel->where('username', $username)->first();

		if ($user) {
			$pass = $user['password'];

			// Debug statement
			log_message('debug', 'Hashed password from database: ' . $pass);

			$authenticatePassword = password_verify($password, $pass);

			// Debug statement
			log_message('debug', 'Password verification result: ' . ($authenticatePassword ? 'true' : 'false'));

			if ($authenticatePassword) {
				$ses_data = [
					'user_id' => $user['id_user'],
					'user_name' => $user['username'],
					'logged_in' => TRUE
				];
				session()->set($ses_data);
				session()->setFlashdata('success', 'Berhasil Login');
				return redirect()->to('/dashboard'); // Kembali ke halaman login dan tampilkan Sweet Alert
			} else {
				session()->setFlashdata('msg', 'Password salah');
				return redirect()->to('/login');
			}
		} else {
			session()->setFlashdata('msg', 'Username tidak ditemukan');
			return redirect()->to('/login');
		}
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

	public function logout()
	{
		session()->destroy();
		return redirect()->to('/login');
	}
}
?>