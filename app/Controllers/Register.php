<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Register extends BaseController
{
    public function index()
    {
        if (session()->get('logged_in')) { // jika sudah login
            return redirect()->to('/'); // kembali ke home
        }
        $data['title'] = 'Register';
        return view('auth/register_view', $data);
    }

    public function process()
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required|min_length[4]|max_length[20]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 20 Karakter',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'valid_email' => 'Gunakan email yang valid',
                    'is_unique' => 'Email sudah digunakan sebelumnya'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[4]|max_length[50]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 50 Karakter',
                ]
            ],
            'password_conf' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi Password tidak sesuai dengan password',
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $users = new UsersModel();
        $users->insert([
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
        ]);
        return redirect()->to('/login');
    }
}
