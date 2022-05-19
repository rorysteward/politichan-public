<?php

namespace App\Libraries;

use App\Models\BoardModel;

class HcaptchaAPI
{
	/**
	 *
	 * 	To keep spammers out this function validate token submitted by the users.
	 * 	check https://docs.hcaptcha.com/ for more details.
	 * 
	 */

	function verifyHCaptcha($token)
	{
		$BoardModel = new BoardModel();
		$hcaptcha = new \Config\MY_config\Hcaptcha();
		$client = \Config\Services::curlrequest();
		$response = $client->request('POST', 'https://hcaptcha.com/siteverify', [
			'form_params' => [
				'response' => $token,
				'secret' => $hcaptcha->secret_key,
			],
		]);
		$response = $response->getBody();
		return $response;
	}
}
/**
 * EOF
 */
