<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class AwsPublicLinkService implements Contracts\AwsPublicLinkServiceContract
{

    public static function generate(string $filePath): string
    {
        try {
            $client = Storage::disk('s3')->getClient();
            $expiry = "+7 days";

            $cmd = $client->getCommand('GetObject', [
                'Bucket' => config('filesystems.disks.s3.bucket'),
                'Key' => $filePath,
                'ACL' => 'public-read'
            ]);

            return (string)$client->createPresignedRequest($cmd, $expiry)->getUri();
        } catch (\Exception $exception) {
            logs()->warning(__CLASS__ . ' => ' . $exception->getMessage());
            return '';
        }
    }
}
