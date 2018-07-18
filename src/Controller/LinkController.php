<?php

namespace App\Controller;

use App\Entity\Link;
use App\Form\LinkType;
use App\Service\LinkMinimizerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class LinkController extends AbstractController
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Create minimized URL
     *
     * @Route("/", name="create_link", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param LinkMinimizerInterface $linkMinimizer
     * @param TokenGeneratorInterface $tokenGenerator
     *
     * @return Response
     */
    public function create(
        Request $request,
        LinkMinimizerInterface $linkMinimizer,
        TokenGeneratorInterface $tokenGenerator
    ): Response
    {
        //$link = new Link();
        $form = $this->createForm(LinkType::class);
        //$form = $this->createForm(LinkType::class, $link);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $expiresIn = $form->get('expires_in')->getData();
            $token = $tokenGenerator->generateToken();
            $originalUrl = $form->get('originalUrl')->getData();

            $newLink = $this->createLink($token, $expiresIn, $originalUrl);

            $shortCode = $form->get('shortCode')->getData();

            if (!$shortCode) {
                $shortCode = $linkMinimizer->minimize($newLink);
            }

            $newLink->setShortCode($shortCode);

            $this->em->persist($newLink);
            $this->em->flush();

            $this->addFlash('notice', 'Your URL was minimized');

            return $this->render('link/show.html.twig', ['link' => $newLink]);
        }

        return $this->render('link/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function createLink($accessToken, $expiresIn, $originalUrl): Link
    {
        $link = new Link();

        $link->setExpiresAt(time() + $expiresIn);
        $link->setToken($accessToken);
        $link->setOriginalUrl($originalUrl);

        $this->em->persist($link);
        $this->em->flush();

        return $link;
    }
}
