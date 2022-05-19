<?php

namespace App\Libraries;

include("../vendor/autoload.php");

use App\Models\BoardModel;
use App\Models\BannedModel;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class Maintenance
{

	public function cleanUpPost($post_id)
	{
		helper('filesystem');
		$BoardModel = new BoardModel();
		$path = FCPATH;
		$image_path = $BoardModel->select('image_path')->where('original_post_id', $post_id[0]['post_id'])->findAll();
		$original_image_path = $BoardModel->select('image_path')->where('post_id', $post_id[0]['post_id'])->findAll();
		$image_path[count($image_path)] = $original_image_path[0];
		$aws = new \Config\MY_config\Aws();
		$client = new S3Client([
			'region' => $aws->region,
			'version' => $aws->version,
			'endpoint' => $aws->endpoint,
			'credentials' => [
				'key' => $aws->key,
				'secret' => $aws->secret
			],
			'use_path_style_endpoint' => true
		]);
		foreach ($image_path as $image) {
			$cmd = "rm " . $path . "images/" . $image['image_path'];
			shell_exec($cmd);
			$client->deleteObject([
				'Bucket' => $aws->bucket,
				'Key' => $image
			]);
		}
		$BoardModel->where('original_post_id', $post_id[0]['post_id'])->delete();
	}
	public function cleanUpAdmin($board_id)
	{
		helper('filesystem');
		$BoardModel = new BoardModel();
		$path = FCPATH;
		$image_path = $BoardModel->select('image_path')->where('board_id', $board_id)->findAll();
		$aws = new \Config\MY_config\Aws();
		$client = new S3Client([
			'region' => $aws->region,
			'version' => $aws->version,
			'endpoint' => $aws->endpoint,
			'credentials' => [
				'key' => $aws->key,
				'secret' => $aws->secret
			],
			'use_path_style_endpoint' => true
		]);
		foreach ($image_path as $image) {
			$cmd = "rm " . $path . "images/" . $image['image_path'];
			shell_exec($cmd);
			$client->deleteObject([
				'Bucket' => $aws->bucket,
				'Key' => $image
			]);
		}
		$BoardModel->where('board_id', $board_id)->delete();
	}

	/**
	 * As we only display 15 x 15 posts there is no point to keep the old ones,
	 * therefore some sort of clean up must happen to save already scarse resources.
	 * Function essentially compile list of post ids to be deleted (if over 255 (value is in the model))
	 * Then assosiate any sub posts and delete them from the database and uploaded content.
	 */
	public function cleanUp()
	{
		helper('filesystem');
		$BoardModel = new BoardModel();
		//compile list of old op posts, sieve out empty arrays and reindex
		$posts = $BoardModel->getOldPosts();
		array_filter($posts);
		array_values($posts);
		//init aws s3 client and set project's path
		$path = FCPATH;
		$aws = new \Config\MY_config\Aws();
		$client = new S3Client([
			'region' => $aws->region,
			'version' => $aws->version,
			'endpoint' => $aws->endpoint,
			'credentials' => [
				'key' => $aws->key,
				'secret' => $aws->secret
			],
			'use_path_style_endpoint' => true
		]);
		//loop through ids
		if (!empty($posts[0])) {
			foreach ($posts as $i => $row) {
				foreach ($row as $row2) {


					$post_ids[] = $row2['post_id'];
					$image_path[] = $row2['image_path'];
				}
			}
			//fetch sub posts assossiated with op posts
			$sub_post = $BoardModel->getOldSubPosts($post_ids);
			if (!empty($sub_post)) {
				array_filter($sub_post);
				array_values($sub_post);
				foreach ($sub_post as $row) {
					foreach ($row as $row2) {
						$post_ids[] = $row2['post_id'];
						$image_path[] = $row2['image_path'];
					}
				}
				foreach ($image_path as $row) {
					//delete images
					$cmd = "rm $path'images/'$row";
					shell_exec($cmd);
					$client->deleteObject([
						'Bucket' => $aws->bucket,
						'Key' => $row
					]);
				}
			}
			//delete database entries
			$BoardModel->deleteOrphanedPosts($post_ids);
		}
	}

	/**
	 * to stop scumbags posting nasty shit script will refresh and populate banned ips known tor exit endpoints
	 */
	public function torEndpoints()
	{
		$BannedModel = new BannedModel();
		$url = 'https://lists.fissionrelays.net/tor/exits.txt';
		$client = \Config\Services::curlrequest();
		$response = $client->get($url);
		$response = $response->getBody();
		$list = array();
		$list = preg_split('/\r\n|\r|\n/', $response);
		$exit_nodes = $BannedModel->select('ip_address')->where('is_tor', 'y')->find();
		$endpoints = array();
		array_pop($list);
		echo '<pre>';
		print_r($list);
		print_r($exit_nodes);
		foreach ($list as $item) {
			$result = true;
			//	$endpoints[] = array_unique($item, $exit_nodes[$i]['ip_address']);
		}
		echo '<pre>';
		print_r($result);
		exit();

		//	$BannedModel->where('is_tor', 'y')->delete();

		//	$BannedModel->insertBatch($data);
	}
}
/**
 * EOF
 */
