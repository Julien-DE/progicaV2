<?php

namespace App\Repository;

use App\Entity\GiteEqpInt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GiteEqpInt>
 *
 * @method GiteEqpInt|null find($id, $lockMode = null, $lockVersion = null)
 * @method GiteEqpInt|null findOneBy(array $criteria, array $orderBy = null)
 * @method GiteEqpInt[]    findAll()
 * @method GiteEqpInt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GiteEqpIntRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GiteEqpInt::class);
    }

    public function save(GiteEqpInt $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GiteEqpInt $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return GiteEqpInt[] Returns an array of GiteEqpInt objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GiteEqpInt
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
