<?php

namespace App\Repository;

use App\Entity\Link;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Link|null find($id, $lockMode = null, $lockVersion = null)
 * @method Link|null findOneBy(array $criteria, array $orderBy = null)
 * @method Link[]    findAll()
 * @method Link[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LinkRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Link::class);
    }

    public function findByShortCode(string $code, $active = true)
    {
        $now = time();

        $qb = $this->createQueryBuilder('l')
            ->andWhere('l.shortCode = :shortCode')
            ->setParameter('shortCode', $code)
        ;

        if ($active) {
            $qb
                ->andWhere('l.expiresAt > :now')
                ->setParameter('now', $now)
            ;

        }

        $query = $qb->getQuery();

        return $query->getOneOrNullResult();
    }

    public function findByToken($token): ?Link
    {
        return $this->findOneBy(['token' => $token]);
    }
}
