<?php

namespace App\Repository;

use App\Entity\Panel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Panel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Panel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Panel[]    findAll()
 * @method Panel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PanelRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Panel::class);
    }

    /**
     * @return Panel[] Returns an array of Panel objects
     */
    public function getDisplayed()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.displayed = 1')
            ->orderBy('p.navOrder', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function getByNavUrl($navUrl)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.navUrl = :val')
            ->setParameter('val', $navUrl)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
