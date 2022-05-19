<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class BannedModel extends Model
{
    protected $table = 'banned_ip';
    protected $primaryKey = 'ban_id';
    protected $protectFields = true;
    protected $allowedFields = ['ip_address', 'ban_text', 'expires_at', 'admin_id', 'is_tor'];



    public function banClient($ip_address, $ban_text, $length)

    {
        $ip_address = $ip_address[0]->ip_address;
        $current_time = $Time = date('Y-m-d H:i:s');
        $expires_at = date('Y-m-d H:i:s', strtotime($current_time .  $length));
        $admin_id = '1';
        $query = "INSERT INTO `banned_ip` (`ban_id`, `ip_address`, `ban_text`, `created_at`, `expires_at`, `admin_id`) VALUES (NULL, '$ip_address', '$ban_text', CURRENT_TIMESTAMP, '$expires_at', '$admin_id')";
        $result = $this->db->query($query);
    }
}
