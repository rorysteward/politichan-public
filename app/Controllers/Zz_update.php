<?php

namespace App\Controllers;

use App\Models\Zz_updateModel;
use App\Libraries\Maintenance;
use App\Libraries\Email;

/**
 * 
 * As name suggests these functions meant to be called with cron once a day (unless stated otherwise)
 * 
 * USAGE: 59 23 * * * /usr/bin/php /srv/politichan/public/index.php class function
 * 
 */

class Zz_update extends BaseController
{
	/**
	 * 
	 * Send an email to the admin with today's stats
	 * 
	 */
	public function dailyCount()
	{
		if (is_cli()) {
			$Zz_updateModel = new Zz_updateModel;
			$email = new Email;
			$count = $Zz_updateModel->countDailyPosts();
			foreach ($count as $row) {
				$count['counter'][] = $row['count'];
			};
			$email->dailyCount($count['counter']);
		}
	}

	/**
	 * 
	 * Clean up backend see libraries/maintenance for more info
	 * Can be used with every op post submitted or via cron (recommened)
	 *  
	 */
	public function cleanUp()
	{
		if (is_cli()) {
			$maintenance = new Maintenance();
			$maintenance->cleanUp();
		}
	}

	/**
	 * To prevent abusers behind Tor or other detected proxies from posting
	 */
	public function updateTorEndpoints()
	{
		if (!is_cli()) {
			$maintenance = new Maintenance();
			$maintenance->torEndpoints();
		}
	}
}
