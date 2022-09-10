<?php

namespace App\Services\Contracts;

interface AwsPublicLinkServiceContract
{
    public static function generate(string $filePath): string;
}
