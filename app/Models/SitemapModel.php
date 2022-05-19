<?php

namespace App\Models;

use CodeIgniter\Model;


class SitemapModel extends Model
{

    protected $table = 'boards';

    function __construct()
    {
        parent::__construct();
        $db      = \Config\Database::connect();
        $builder = $db->table('boards');
    }

    function generateSitemap()
    {
        $query = 'SELECT board_name, board_title, board_slug, modified_at FROM boards';
        $result = $this->db->query($query)->getResult();
        return $result;
    }
}
