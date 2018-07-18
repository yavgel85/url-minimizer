<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatisticsRepository")
 */
class Statistics
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $userAgent;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=15)
     */
    private $clientIP;

    /**
     * @var Link
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Link", inversedBy="statistics")
     */
    private $link;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    /**
     * @param string $userAgent
     *
     * @return Statistics
     */
    public function setUserAgent(string $userAgent): self
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getClientIP(): ?string
    {
        return $this->clientIP;
    }

    /**
     * @param string $clientIP
     *
     * @return Statistics
     */
    public function setClientIP(string $clientIP): self
    {
        $this->clientIP = $clientIP;

        return $this;
    }

    /**
     * @return Link
     */
    public function getLink(): Link
    {
        return $this->link;
    }

    /**
     * @param Link $link
     */
    public function setLink(Link $link): void
    {
        $this->link = $link;
    }
}
