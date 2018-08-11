<?php

namespace App\Repository;

use App\Entity\Tool;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tool|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tool|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tool[]    findAll()
 * @method Tool[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ToolRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tool::class);
    }

    /**
     * @return Tool[] Returns an array of Tool objects
     */
    public function getDisplayed()
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.displayed = 1')
            ->orderBy('t.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Tool
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
