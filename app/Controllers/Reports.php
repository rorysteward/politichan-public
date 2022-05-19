<?php

namespace App\Controllers;

use App\Models\Zz_updateModel;
use App\Models\BoardModel;

class Reports extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            echo view('header/index');
            echo view('admin/login/index');
            echo view('footer/index');
        } else {
            echo view('admin/header/index');
            echo view('admin/reports/index');
            echo view('footer/index');
        }
    }

    public function dailyCount()
    {
        if (!session()->get('isLoggedIn')) {
            echo view('header/index');
            echo view('admin/login/index');
            echo view('footer/index');
        } else {
            if ($this->request->isAJAX()) {
                $BoardModel = new BoardModel;
                $Zz_updateModel = new Zz_updateModel;
                $count = $Zz_updateModel->countDailyPosts();
                $data['count'] = [
                    '0' => $count[0]['count'],
                    '1' => $count[1]['count']
                ];
                return json_encode($data);
            } else {
                echo "direct access forbidden";
            }
        }
    }
}
