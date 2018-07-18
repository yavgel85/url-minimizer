<?php

namespace App\Controller;

use App\Entity\Link;
use App\Service\StatisticalLoggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MinimizedLinkController extends AbstractController
{
    /**
     * @Route("/s/{code}", name="short_code", methods={"GET"})
     *
     * @param string $code
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param StatisticalLoggerInterface $statisticalLogger
     *
     * @return Response
     */
    public function followTheLink(
        string $code,
        EntityManagerInterface $em,
        Request $request,
        StatisticalLoggerInterface $statisticalLogger
    ): Response
    {
        $link = $em->getRepository(Link::class)->findByShortCode($code);

        if (!$link) {
            throw $this->createNotFoundException('Link does not found');
        }

        $statisticalLogger->logRequestData($request, $link);

        $originalUrl = $link->getOriginalUrl();

        return $this->redirect($originalUrl);
    }
}