<?php

namespace App\Controllers;

use App\Libraries\Maintenance;
use App\Libraries\RecaptchaAPI;
use App\Libraries\Aws;
use App\Libraries\CloudVision;
use App\Models\Creator\PostModel;
use App\Models\BoardModel;
use App\Models\AdminModel;
use App\Models\ReportedPostsModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\IncomingRequest;

helper('form');
helper('array');
helper('text');
helper('url');


class Board extends BaseController
{
	/**
	 * 
	 * Playground //Ignore//
	 * 
	 */

	public function test()
	{
		//import recaptcha keys

		$aws = new \Config\MY_config\Aws();
		$BoardModel = new BoardModel();
		$CloudVision = new CloudVision();
		//$stocks = $finnhub->test();
		echo '<pre>';
		print_r($CloudVision->imageCheck());
		exit();
		$query = $BoardModel->categoriesAndBoards();

		if (empty($banned)) {

			//fetch list of boards and convert stdclass object to array so it can be used with foreach in view
			$board_ids = $BoardModel->pullAdditionalBoard();
			//post data
			$data = [
				'query' => $query,
				'cdn' => $aws->dnsEndpoint
			];

			$header = [
				'board_ids' => $board_ids
			];
			//load view
			echo view('header/index', $header);
			echo view('board/index', $data);
			echo view('footer/index');
		} else {
			return redirect()->to('/banned/');
		}
	}

	/**
	 * 
	 *  Index page
	 * 
	 * @return void
	 */
	public function index()
	{
		//import recaptcha keys
		$aws = new \Config\MY_config\Aws();
		$BoardModel = new BoardModel();
		$client_ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
		$banned = $BoardModel->getBans($client_ip);

		if (empty($banned)) {

			//fetch list of boards and convert stdclass object to array so it can be used with foreach in view
			$board_ids = $BoardModel->pullAdditionalBoard();
			$categories = $BoardModel->categoriesAndBoards();
			//post data
			$data = [
				'categories' => $categories,
				'cdn' => $aws->dnsEndpoint
			];


			$header = [
				'board_ids' => $board_ids
			];

			//load view
			echo view('header/index', $header);
			echo view('board/index', $data);
			echo view('footer/index');
		} else {
			return redirect()->to('/banned/');
		}
	}

	/**
	 * 
	 * Boards and their content
	 * 
	 * @return void
	 */

	public function subBoard()
	{
		helper('text');
		helper('url');
		$BoardModel = new BoardModel();
		$aws = new \Config\MY_config\Aws();
		//check if client's ip address is banned
		$client_ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
		$banned = $BoardModel->getBans($client_ip);
		if (empty($banned)) {
			//import recaptcha keys
			$recaptcha = new \Config\MY_config\Recaptcha();

			//get board_id we are currently on

			$board_name = $this->request->getPath();
			$board_name = str_replace("boards/", "", "$board_name");
			$post = $BoardModel->pullBoardInfoSlug($board_name);
			$board_id = $post[0]->board_id;
			$post_ids = array();
			//fetch all posts assosiated with this board_id, order by the latest and paginate
			$post_ids = $BoardModel->where('board_id =', $board_id)->orderBy('modified_at', 'desc')->paginate(15);
			$post = $BoardModel->countSubPosts($post_ids);
			//get info name and title for our board we are on
			$board_details = $BoardModel->pullBoardInfo($board_id);
			$board_ids = $BoardModel->pullAdditionalBoard();
			//post data
			$data = [
				'op_posts' => $post_ids,
				'post_password' => random_string('alnum', 16),
				'pager' => $BoardModel->pager,
				'sub_post_count' => $post,
				'total' => $BoardModel->countPosts(),
				'board_id' => $board_id,
				'board_details' => $board_details,
				'site_key' => $recaptcha->site_key,
				'board_ids' => $board_ids,
				'cdn' => $aws->dnsEndpoint

			];

			$header = [
				'board_ids' => $board_ids
			];
			//load views
			echo view('header/index', $header);
			echo view('board/subindex', $data);
			echo view('footer/index');
		} else {
			return redirect()->to('/banned/');
		}
	}

	/**
	 * 
	 * Allows to delete existing post as long as submitted password is valid
	 * 
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 */

	public function deletePost()
	{
		if (empty($this->request->getVar('password'))) {

			echo view('modals/delete-post');
		} else {
			$BoardModel = new BoardModel();
			$maintenance = new Maintenance();
			$password = $this->request->getVar('password');
			$post_id = $BoardModel->select('post_id')->where('post_password', $password)->findAll();
			if (!empty($post_id)) {
				$maintenance->cleanUpPost($post_id);
				$BoardModel->deletePost($password);
			}
			return redirect()->to('/');
		}
	}

	/**
	 * 
	 * In my opinion the most complex function written so far,
	 * it works either with op posts and sub posts.
	 * initially there were two separate functions,
	 * but I have gradually combined both to optimise the code,
	 * however there is still loads of work to be done,
	 * and to be honest I will be more inclined to rewrite all this at some point.
	 * 
	 * @return \CodeIgniter\HTTP\RedirectResponse|void	  
	 * 
	 */

	public function newPost()
	{
		$BoardModel = new BoardModel();
		$client_ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
		$banned = $BoardModel->getBans($client_ip);
		//if banned terminate
		if (isset($banned[0])) {
			return redirect()->to('/banned/');
		} else {
			$recaptcha = new RecaptchaAPI;
			$token = $this->request->getVar('g-recaptcha-response');
			$recaptcha_response = json_decode($recaptcha->verifyReCaptcha($token));
			if ($recaptcha_response->score > 0.5) {
				$aws = new Aws;
				$BoardModel = new BoardModel();
				$PostModel = new PostModel();
				if ($this->request->getPost('board_id') != null) {
					$post = [
						'board_id' => $this->request->getPost('board_id'),
						'post_email' => $this->request->getPost('post_email'),
						'post_title' => $this->request->getPost('post_title'),
						'post_text' => $this->request->getPost('post_text'),
						'post_password' => $this->request->getPost('post_password'),
						'ip_address' => $_SERVER['HTTP_CF_CONNECTING_IP'],
					];
				}
				if ($this->request->getPost('board_id') == null) {
					$post = [
						'original_post_id' => $this->request->getPost('original_post_id'),
						'post_email' => $this->request->getPost('post_email'),
						'post_title' => $this->request->getPost('post_title'),
						'post_text' => $this->request->getPost('post_text'),
						'post_password' => $this->request->getPost('post_password'),
						'ip_address' => $_SERVER['HTTP_CF_CONNECTING_IP'],
					];
				}
				$rules = [
					'post_text' => 'required|max_length[100000]',
					'post_title' => 'permit_empty|max_length[255]',
					'post_email' => 'permit_empty|valid_email',
					'theFile' => 'uploaded[userfile]|max_size[userfile, 1024]|is_image[userfile]'
				];
				//if good request file
				if ($this->validate($rules)) {
					$file = $this->request->getFile('userfile');
					//check if file is valid, move and assign random name
					if ($file->isValid() && !$file->hasMoved()) {
						$image_manipulation = \Config\Services::image()
							->withFile($file)
							->getFile()
							->getProperties(true);
						$file->move('./images', $file->getRandomName());
					}
					$aws->upload($file);
				}
				$post += [
					'image_path' => $file->getName(),
					'image_height' => $image_manipulation['height'],
					'image_width' => $image_manipulation['width']
				];
				$PostModel->insert($post);
				if ($this->request->getPost('board_id') == null) {
					$BoardModel->updatePost($post['original_post_id']);
				}
				if ($this->request->getPost('board_id') != null) {
					$AdminModel = new AdminModel();
					$data = [
						'modified_at' => date("Y-m-d")
					];
					$AdminModel->update($this->request->getPost('board_id'), $data);
				}
				$id = $this->request->getPost('original_post_id') ?? $PostModel->insertID;
				return redirect()->to('/thread/' . $id);
			} else {
				echo "<h2>something went really bad</h2>
				<br>go back and try again";
			}
		}
	}

	/**
	 * 
	 * 	Responsible for displaying op posts and their sub posts as one thread
	 * 
	 *  @return void
	 * 
	 */
	public function subPost()
	{
		$BoardModel = new BoardModel();
		$aws = new \Config\MY_config\Aws();
		$recaptcha = new \Config\MY_config\Recaptcha();
		$client_ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
		$banned = $BoardModel->getBans($client_ip);

		if (empty($banned)) {
			$post_id = $this->request->getPath();
			$post_id = str_replace("thread/", "", "$post_id");
			$board_ids = $BoardModel->pullAdditionalBoard();
			$return = $BoardModel->returnToBoard($post_id);
			$board_id = $return[0]->board_id;
			$board_name = $BoardModel->getBoardName($board_id);

			$data = [
				'return' => $board_name[0]->board_name,
				'original_post_id' => $post_id,
				'original_post' => $this->getPostID($post_id),
				'post_password' => random_string('alnum', 16),
				'new_sub_posts' => $BoardModel->getSubPostsdirty($post_id),
				'site_key' => $recaptcha->site_key,
				'g-recaptcha-response' => $this->request->getVar('g-recaptcha-response'),
				'cdn' => $aws->dnsEndpoint
			];

			$header = [
				'board_ids' => $board_ids
			];
			echo view('header/index', $header);
			echo view('board/subPost', $data);
			echo view('footer/index');
		} else {
			return redirect()->to('/banned/');
		}
	}

	/**
	 * 
	 * Allows triggered users to report posts, so moderators can take an action
	 * 
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 * 
	 */

	public function reportPost()
	{
		$ReportedPostsModel = new ReportedPostsModel();
		$data = [
			'post_id' => $this->request->getVar('post_id'),
			'sub_post_id' => $this->request->getVar('sub_post_id'),
			'board_id' => $this->request->getVar('board_id'),
			'action' => 'o',
			'ip_address' => $_SERVER['HTTP_CF_CONNECTING_IP']
		];
		$board_name = $ReportedPostsModel->boardName($data['board_id']);
		$ReportedPostsModel->insert($data);
		return redirect()->to('boards/' . $board_name[0]->board_name);
	}

	/**
	 * 
	 * Helpers, I don't think these are really needed,
	 * currently thinking about getting rid of them
	 * (these were one of the first functions ever written and left untouched)
	 * 
	 * @param mixed $post_id
	 * @return array|object|null
	 * 
	 */

	function getSubPostID($post_id)
	{
		$BoardModel = new BoardModel();
		$original_post_id = array(
			'original_post_id' => $post_id,
		);
		$post = $BoardModel->getSubPosts($original_post_id);
		return $post;
	}
	function getPostID($post_id)
	{
		$BoardModel = new BoardModel();
		$post_id = array(
			'post_id' => $post_id
		);
		$post = $BoardModel->find($post_id);
		return $post;
	}
}
