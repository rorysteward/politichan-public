<?php

namespace App\Models;

use CodeIgniter\Model;


class AdminModel extends Model
{

    protected $table = 'boards';
    protected $primaryKey = 'board_id';
    protected $allowedFields = [
        'board_id',
        'board_name',
        'board_title',
        'board_slug',
        'modified_at',
    ];



    function __construct()
    {
        parent::__construct();
        $db      = \Config\Database::connect();
        $builder = $db->table('boards');
    }
    function pullUsers()
    {
        $query = "SELECT admin_id, admin_username, admin_email, admin_first_name, admin_last_name, admin_rights, mod_permissions, active FROM admin_users";
        $result = $this->db->query($query)->getResultArray();
        return $result;
    }

    function getBoardNames($permissions)
    {
        foreach ($permissions as $row) {
            $query = "SELECT board_id, board_name FROM boards WHERE board_id IN ($row)";
            $result[] = $this->db->query($query)->getResultArray();
        }
        return $result;
    }

    function modifyBoard($data)
    {
        $board_id = $data['board_id'];
        $board_name = $data['board_name'];
        $board_title = $data['board_title'];
        $board_slug = $data['board_slug'];
        $query = "UPDATE `boards` SET `board_name` = '$board_name', `board_title` = '$board_title', `board_slug` = '$board_slug' WHERE `board_id` = '$board_id'";
        $this->db->query($query);
    }
    function updateBoard($board_id)
    {
        $Time = date('Y-m-d');
        $query = "UPDATE boards SET modified_at = '$Time' WHERE boards.board_id = $board_id";
        $this->db->query($query);
    }
}
