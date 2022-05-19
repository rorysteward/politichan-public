<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AdminModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\IncomingRequest;

class Login extends BaseController
{
    public function index()
    {
        $data = [];

        if ($this->request->getMethod() == 'post') {
            //let's do the validation here
            $rules = [
                'admin_username' => 'required',
                'admin_password' => 'required|validateUser[admin_username,admin_password]',
            ];


            if (!$this->validate($rules)) {
                $data['validator'] = $this->validator;
            } else {
                $model = new UserModel();

                $user = $model->where('admin_username', $this->request->getVar('admin_username'))
                    ->first();
                $this->returnSession($user);
                return redirect()->to('admin');
            }
        }

        echo view('header/index');
        echo view('admin/login/index', $data);
        echo view('footer/index');
    }


    private function returnSession($user)
    {
        $data = [
            'admin_id' => $user['admin_id'],
            'admin_username' => $user['admin_username'],
            'admin_email' => $user['admin_email'],
            'admin_first_name' => $user['admin_first_name'],
            'admin_last_name' => $user['admin_last_name'],
            'admin_rights' => $user['admin_rights'],
            'mod_permissions' => $user['mod_permissions'],
            'isLoggedIn' => true,
        ];
        session()->set($data);
        return true;
    }
}
