<?php

namespace App\Repository;

use App\Entity\ColorTheme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ColorTheme|null find($id, $lockMode = null, $lockVersion = null)
 * @method ColorTheme|null findOneBy(array $criteria, array $orderBy = null)
 * @method ColorTheme[]    findAll()
 * @method ColorTheme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ColorThemeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ColorTheme::class);
    }

//    /**
//     * @return ColorTheme[] Returns an array of ColorTheme objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ColorTheme
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
