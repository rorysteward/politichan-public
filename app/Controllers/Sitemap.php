<?php

namespace App\Controllers;

use App\Models\SitemapModel;

class Sitemap extends BaseController
{
    public function index()
    {
        $SitemapModel = new SitemapModel();
        $data = [
            'sitemap' => $SitemapModel->generateSitemap(),
        ];
        $this->response->setHeader('Content-Type', 'text/xml');
        echo view('sitemap/index', $data);
    }
}
