<?php

namespace App\Models;

use CodeIgniter\Model;


class ReportedPostsModel extends Model
{

    protected $table = 'reported_posts';

    protected $allowedFields = [
        'report_id',
        'post_id',
        'sub_post_id',
        'action',
        'board_id',
        'ip_address',
        'admin_id'
    ];



    function __construct()
    {
        parent::__construct();
        $db      = \Config\Database::connect();
        $builder = $db->table('boards');
    }

    function fetchOpenReports()
    {
        $query = "SELECT reported_posts.report_id, reported_posts.post_id, reported_posts.board_id, reported_posts.action, reported_posts.ip_address, reported_posts.created_at, op_posts.post_title, op_posts.post_text
        FROM reported_posts
        LEFT OUTER JOIN op_posts ON reported_posts.post_id = op_posts.post_id WHERE reported_posts.action = 'o'";
        $result = $this->db->query($query)->getResult();
        return $result;
    }

    function countOpenReports()
    {
        $query = "SELECT COUNT(*) as count FROM reported_posts WHERE action = 'o'";
        return $this->db->query($query)->getResult();
    }

    function fetchClosedReports()
    {
        $query = "SELECT * FROM reported_posts WHERE action = 'c'";
        $result = $this->db->query($query)->getResult();
        return $result;
    }

    function closeReport($post_id)
    {
        $post_id = $post_id[0]->post_id;
        $query = "UPDATE reported_posts SET action = 'c' WHERE post_id = $post_id";
        $result = $this->db->query($query);
        return $result;
    }


    function getPostID($report_id)
    {
        $query = "SELECT post_id FROM reported_posts WHERE report_id = $report_id";
        $result = $this->db->query($query)->getResult();
        return $result;
    }

    function boardName($board_id)
    {
        $query = "SELECT board_name FROM boards WHERE board_id = $board_id";
        $result = $this->db->query($query)->getResult();
        return $result;
    }
}
