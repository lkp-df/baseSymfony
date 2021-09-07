<?php

namespace App\Repository;

use App\Entity\NomSerch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NomSerch|null find($id, $lockMode = null, $lockVersion = null)
 * @method NomSerch|null findOneBy(array $criteria, array $orderBy = null)
 * @method NomSerch[]    findAll()
 * @method NomSerch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NomSerchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NomSerch::class);
    }

    // /**
    //  * @return NomSerch[] Returns an array of NomSerch objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NomSerch
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
