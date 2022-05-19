<?php

namespace App\Libraries;

use App\Models\UserModel;

class Validator
{
    public function validateUser(string $str, string $fields, array $data)
    {
        $UserModel = new UserModel();
        $user = $UserModel->where('admin_username', $data['admin_username'])
            ->first();
        if (!$user)
            return false;

        return password_verify($data['admin_password'], $user['admin_password']);
    }
}
