<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
	public function index()
	{
		echo view('header/index');
		echo view('dashboard/index');
		echo view('footer/index');
	}
}
