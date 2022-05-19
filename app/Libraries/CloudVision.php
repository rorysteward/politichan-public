<?php

namespace App\Libraries;

include("../vendor/autoload.php");

use Google\Cloud\Vision\V1\Feature\Type;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Likelihood;
use Google\Cloud\Storage\StorageClient;

class CloudVision
{
    public function imageCheck()
    {
        $client = new ImageAnnotatorClient([
            'credentials' => json_decode(file_get_contents(APPPATH . "/Config/MY_config/google-cloud.json"), true)
        ]);
        $image = $client->annotateImage(
            fopen(FCPATH . "/images/1651494711_8b2417de05ae79146607.png", 'r'),
            [Type::SAFE_SEARCH_DETECTION]
        );
        echo '<pre>';
        print_r($image);
        exit();
    }
}
