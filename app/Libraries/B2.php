<?php

namespace App\Libraries;

include("../vendor/autoload.php");

use App\Models\BoardModel;
use obregonco\B2\Client;
use obregonco\B2\Bucket;

class B2
{
    function uploadStaticContent($image)
    {
        $b2 = new \Config\MY_config\B2();
        $client = new Client($b2->accountId, [
            'applicationKey' => $b2->applicationKey,
            'keyId' => $b2->keyId
        ]);
        $client->version = 2;

        $client->domainAliases = [
            $b2->endpoint => $b2->dnsEndpoint,
        ];
        $client->largeFileLimit = 10000000; // 10MB
        $client->upload([
            'BucketName' => $b2->bucketName,
            'FileName' => $image->getName(),
            'Body' => fopen('./images/' . $image->getName(), 'r')
        ]);
    }

    public function deleteStaticContent($images)
    {
        $b2 = new \Config\MY_config\B2();
        $client = new Client($b2->accountId, [
            'applicationKey' => $b2->applicationKey,
            'keyId' => $b2->keyId
        ]);
        $client->version = 2;

        $client->domainAliases = [
            $b2->endpoint => $b2->dnsEndpoint,
        ];
        $client->largeFileLimit = 10000000; // 10MB

        $client->deleteFile([
            'BucketName' => $b2->bucketName,
            'FileName' => $images
        ]);
    }
}
/**
 * EOF
 */
