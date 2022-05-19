<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Banned extends BaseController
{
    public function index()
    {
        echo view('header/index');
        echo view('board/banned');
        echo view('footer/index');
    }
}
