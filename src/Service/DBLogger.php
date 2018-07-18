<?php

namespace App\Service;

use App\Entity\Link;
use App\Entity\Statistics;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class DBLogger implements StatisticalLoggerInterface
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function logRequestData(Request $request, Link $link): void
    {
        $userAgentData = $request->headers->get('User-Agent');
        $clientIP = $request->getClientIp();

        $statistics = new Statistics();
        $statistics->setUserAgent($userAgentData);
        $statistics->setLink($link);
        $statistics->setClientIP($clientIP);

        $this->em->persist($statistics);
        $this->em->flush();
    }
}