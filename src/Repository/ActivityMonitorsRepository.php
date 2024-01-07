<?php

namespace App\Repository;

use App\Entity\ActivityMonitors;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ActivityMonitors>
 *
 * @method ActivityMonitors|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActivityMonitors|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActivityMonitors[]    findAll()
 * @method ActivityMonitors[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivityMonitorsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActivityMonitors::class);
    }

//    /**
//     * @return ActivityMonitors[] Returns an array of ActivityMonitors objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ActivityMonitors
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
