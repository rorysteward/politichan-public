<?php

namespace App\Controllers;

use App\Models\BoardModel;

class Rules extends BaseController
{
	public function index()
	{
		$BoardModel = new BoardModel();
		$board_ids = $BoardModel->pullAdditionalBoard();
		$board_ids = json_decode(json_encode($board_ids), true);
		$header = [
			'board_ids' => $board_ids
		];
		echo view('header/index', $header);
		echo view('index/rules');
		echo view('footer/index');
	}
}
