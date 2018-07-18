<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LinkRepository")
 * @ORM\Table(name="links")
 * @UniqueEntity("shortCode", message="Please try another unique code")
 */
class Link
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
    private $originalUrl;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $shortCode;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $token;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $expiresAt;

    /**
     * @var Statistics[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Statistics", mappedBy="link")
     */
    private $statistics;


    public function __construct()
    {
        $this->statistics = new ArrayCollection();
    }


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
    public function getOriginalUrl(): ?string
    {
        return $this->originalUrl;
    }

    /**
     * @param string $originalUrl
     *
     * @return Link
     */
    public function setOriginalUrl(string $originalUrl): self
    {
        $this->originalUrl = $originalUrl;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getShortCode(): ?string
    {
        return $this->shortCode;
    }

    /**
     * @param string $shortCode
     *
     * @return Link
     */
    public function setShortCode(string $shortCode): self
    {
        $this->shortCode = $shortCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string|null $token
     *
     * @return self
     */
    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return int
     */
    public function getExpiresAt(): int
    {
        return $this->expiresAt;
    }

    /**
     * @param int $expiresAt
     */
    public function setExpiresAt(int $expiresAt): void
    {
        $this->expiresAt = $expiresAt;
    }

    /**
     * @return Statistics[]|ArrayCollection
     */
    public function getStatistics()
    {
        return $this->statistics;
    }
}
