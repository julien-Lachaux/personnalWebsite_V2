<?php

namespace App\Repository;

use App\Entity\Nav;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Nav|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nav|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nav[]    findAll()
 * @method Nav[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NavRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Nav::class);
    }

    /**
     * @return Nav[] Returns an array of Nav objects
     */
    public function getDisplayed($section)
    {
        $section = $section === 'index' ? 1 : $section;
        return $this->createQueryBuilder('n')
            ->andWhere('n.section_id = :val')
            ->andWhere('n.displayed = 1')
            ->setParameter('val', $section)
            ->orderBy('n.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Nav
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}