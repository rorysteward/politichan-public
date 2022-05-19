<?php

namespace App\Libraries;

use App\Models\BoardModel;

class RecaptchaAPI
{
	/**
	 * To keep spammers out this function validate token submitted by the users.
	 */
	function verifyReCaptcha($token)
	{
		$recaptcha = new \Config\MY_config\Recaptcha();
		$client = \Config\Services::curlrequest();
		$response = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
			'form_params' => [
				'secret' => $recaptcha->secret_key,
				'response' => $token,
			],
		]);
		return $response->getBody();
	}
}
/**
 * EOF
 */
