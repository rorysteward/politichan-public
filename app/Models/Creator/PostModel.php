<?php 
namespace App\Models\Creator;
use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table = 'op_posts';
    protected $primaryKey = 'post_id';   
    protected $protectFields = true;
    protected $allowedFields = ['original_post_id', 'image_path', 'image_width', 'image_height', 'ip_address','board_id', 'post_text', 'post_password', 'post_title', 'post_email'];

}

