<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Controller;

use App\Models\BannedModel;

class BannedGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $BannedModel = new BannedModel();
        if (!empty($BannedModel->select('*')->where('ip_address', $request->getServer('HTTP_CF_CONNECTING_IP'))->findAll())) {
            echo view('header/index');
            echo view('board/banned');
            echo view('footer/index');
            exit();
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
