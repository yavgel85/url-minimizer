<?php

namespace App\Controller;

use App\Entity\Link;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class StatisticsController extends AbstractController
{
    /**
     * @Route("/statistics/{token}", name="link_statistics", methods={"GET"})
     *
     * @param string $token
     * @param EntityManagerInterface $em
     *
     * @return Response
     */
    public function preview(string $token, EntityManagerInterface $em): Response
    {
        $link = $em->getRepository(Link::class)->findByToken($token);

        if (!$link) {
            throw new NotFoundHttpException('There is no statistics available by this url');
        }

        $statistics = $link->getStatistics();
        $visitsCount = $statistics->count();

        return $this->render('statistics/preview.html.twig', [
            'statistics' => $statistics,
            'visitsCount' => $visitsCount,
        ]);
    }
}