<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;
use App\Controllers\Board;

class BoardModel extends Model
{
    protected $table = 'op_posts';
    protected $primaryKey = 'post_id';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'modified_at';
    protected $allowedFields = ['original_post_id', 'board_id', 'post_title', 'post_email', 'post_text', 'post_password', 'image_path', 'image_height', 'image_width', 'ip_address', 'modified_at'];



    public function returnToPost($post_id)
    {
        $query = "SELECT post_id FROM op_posts WHERE post_password = '$post_id'";
        $result = $this->db->query($query)->getResult();
        return $result;
    }

    public function pullBoardInfoSlug($board_name)
    {
        $query = "SELECT * FROM boards WHERE board_name ='$board_name'";
        $result = $this->db->query($query)->getResult();
        return $result;
    }

    public function countPosts()
    {
        $db = $this->db;
        $count = $db->table('op_posts');
        return $count->countAllResults();
    }

    public function countPostsAdmin($board_ids)
    {
        foreach ($board_ids as $row) {
            $query = "SELECT COUNT(*) FROM op_posts WHERE board_id = ('{$row['board_id']}')";
            $array[] = $result = $this->db->query($query)->getResultArray();
        }
        return $array;
    }



    function getPosts()
    {
        $query = "SELECT post_id, post_text, post_email, image_path, post_title, created_at, modified_at FROM op_posts ORDER BY modified_at DESC";
        $result = $this->db->query($query)->getResult();
        return $result;
    }

    // Find original_post_id and search for any sub posts
    function getSubPosts($original_post_id)
    {

        $original_post_id = implode("", $original_post_id);
        $query = "SELECT * FROM sub_posts WHERE original_post_id = $original_post_id ";
        $result = $this->db->query($query)->getResult();
        return ($result);
    }

    function getSubPostsdirty($original_post_id)
    {

        $query = "SELECT post_id, original_post_id, post_title, post_email, post_text, image_path, image_height, image_width, created_at FROM op_posts WHERE original_post_id = $original_post_id ";
        $result = $this->db->query($query)->getResultArray();
        return $result;
    }

    function findPost($original_post_id)
    {

        $query = "SELECT * FROM op_posts WHERE post_id = $original_post_id";
        $result = $this->db->query($query)->getResultArray();
        return $result;
    }
    function findPostdirty($original_post_id)
    {
        $original_post_id = implode($original_post_id, ",");
        $query = "SELECT * FROM op_posts WHERE post_id = $original_post_id";
        $result = $this->db->query($query)->getResultArray();
        return $result;
    }
    // When new sub post is added it will bump the op_post

    // Delete post with password supplied
    function deletePost($password)
    {
        $query = "DELETE FROM op_posts WHERE op_posts.post_password = '$password'";
        $this->db->query($query);
    }
    function deleteReportedPost($post_id)
    {
        $post_id = $post_id[0]->post_id;
        $query = "DELETE FROM op_posts WHERE op_posts.post_id = $post_id";
        $this->db->query($query);
    }

    function getIPAddress($post_id)
    {
        $post_id = $post_id[0]->post_id;
        $query = "SELECT ip_address FROM op_posts WHERE post_id = $post_id";
        $result = $this->db->query($query)->getResult();
        return $result;
    }

    function deleteOldPost()
    {
        $query = "DELETE FROM op_posts WHERE modified_at IS NOT NULL order by modified_at desc LIMIT 1";
        $this->db->query($query);
    }

    function getBans($client_ip)
    {
        $query = "SELECT ip_address FROM banned_ip WHERE ip_address = '$client_ip' AND expires_at  >=DATE(NOW())";
        $result = $this->db->query($query)->getResult();
        return $result;
    }

    function getOldPosts()
    {
        $query = "SELECT board_id FROM `boards`";
        $result = $this->db->query($query)->getResultArray();
        foreach ($result as $row) {

            $query = "SELECT post_id, image_path FROM `op_posts` WHERE `op_posts`.`board_id` = $row[board_id] ORDER BY `op_posts`.`modified_at` DESC LIMIT 255, 18446744073709551614";
            $array[] = $this->db->query($query)->getResultArray();
        }

        return $array;
    }

    function getOldSubPosts($post_ids)
    {
        foreach ($post_ids as $row) {
            $query = "SELECT post_id, image_path FROM `op_posts` WHERE `op_posts`.`original_post_id` = '$row'";
            $result[] = $this->db->query($query)->getResultArray();
        }
        return $result;
    }

    function deleteOrphanedPosts($post_ids)
    {
        foreach ($post_ids as $row) {
            $query = "DELETE FROM `op_posts` WHERE `op_posts`.`post_id` = $row";
            $this->db->query($query);
        }
    }
}
