<?php

namespace App\Libraries;

class Email
{
    function dailyCount($count)
    {
        $email = \Config\Services::email();

        $data = [
            'op_posts' => $count[0],
            'sub_posts' => $count[1],
        ];
        $body = view('emails/dailycount/index', $data);
        $email->setFrom('admin@politichan.org', 'Politichan Admin')->setTo('karol@viszon.net')->setSubject('Daily summary')->setMessage($body);
        $email->send();
    }
}
/**
 * EOF
 */
