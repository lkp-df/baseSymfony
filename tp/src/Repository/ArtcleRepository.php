<?php

namespace App\Repository;

use App\Entity\Artcle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Artcle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Artcle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Artcle[]    findAll()
 * @method Artcle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtcleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Artcle::class);
    }

    // /**
    //  * @return Artcle[] Returns an array of Artcle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Artcle
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
