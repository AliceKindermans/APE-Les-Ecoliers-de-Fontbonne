<?php

namespace App\Repository;

use App\Entity\Verbatim;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Verbatim>
 *
 * @method Verbatim|null find($id, $lockMode = null, $lockVersion = null)
 * @method Verbatim|null findOneBy(array $criteria, array $orderBy = null)
 * @method Verbatim[]    findAll()
 * @method Verbatim[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VerbatimRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Verbatim::class);
    }

//    /**
//     * @return Verbatim[] Returns an array of Verbatim objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Verbatim
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
