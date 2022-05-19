<?php

namespace App\Models;

use CodeIgniter\Model;


class Zz_updateModel extends Model
{

    protected $table = 'op_posts';

    function __construct()
    {
        parent::__construct();
        $db      = \Config\Database::connect();
        $builder = $db->table('op_posts');
    }

    function countDailyPosts()
    {
        $query1 = 'SELECT COUNT(*) as count FROM op_posts WHERE DATE(created_at) = CURDATE() AND original_post_id IS NULL';
        $query2 = 'SELECT COUNT(*) as count FROM op_posts WHERE DATE(created_at) = CURDATE() AND original_post_id IS NOT NULL';
        $result1 = $this->db->query($query1)->getResultArray();
        $result2 = $this->db->query($query2)->getResultArray();
        return array_merge($result1, $result2);
    }
}
