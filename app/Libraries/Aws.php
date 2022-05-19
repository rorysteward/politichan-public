<?php

namespace App\Libraries;

include("../vendor/autoload.php");

use App\Models\BoardModel;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class Aws
{
    public function upload($image)
    {
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
        $client->putObject([
            'Bucket' => $aws->bucket,
            'Key' => $image->getName(),
            'Body' => fopen('./images/' . $image->getName(), 'r'),
        ]);
    }
}
