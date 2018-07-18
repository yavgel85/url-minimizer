<?php

namespace App\Service;

use App\Entity\Link;
use Symfony\Component\HttpFoundation\Request;

interface StatisticalLoggerInterface
{
    public function logRequestData(Request $request, Link $link);
}