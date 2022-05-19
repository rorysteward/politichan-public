<?php

namespace App\Models;

use CodeIgniter\Model;


class UserModel extends Model
{

    protected $table = 'admin_users';
    protected $primaryKey = 'admin_id';
    protected $allowedFields = [
        'admin_id',
        'admin_username',
        'admin_email',
        'admin_first_name',
        'admin_last_name',
        'admin_rights',
        'admin_password',
        'active',
        'mod_permissions'
    ];

    protected function beforeInsert(array $data)
    {
        $data = $this->passwordHash($data);
        return $data;
    }

    protected function passwordHash(array $data)
    {
        $options = [
            'cost' => 12,
        ];
        if (isset($data['data']['admin_password']))
            $data['data']['admin_password'] = password_hash($data['data']['admin_password'], PASSWORD_DEFAULT);
        return $data;
    }

    function __construct()
    {
        parent::__construct();
        $db      = \Config\Database::connect();
        $builder = $db->table('boards');
    }

    public function getSession($admin_user)
    {
        $query = "SELECT * FROM admin_users WHERE admin_username = '$admin_user'";
        $result = $this->db->query($query)->getResult();
        return $result;
    }
}
