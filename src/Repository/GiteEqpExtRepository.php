<?php

namespace App\Repository;

use App\Entity\GiteEqpExt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GiteEqpExt>
 *
 * @method GiteEqpExt|null find($id, $lockMode = null, $lockVersion = null)
 * @method GiteEqpExt|null findOneBy(array $criteria, array $orderBy = null)
 * @method GiteEqpExt[]    findAll()
 * @method GiteEqpExt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GiteEqpExtRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GiteEqpExt::class);
    }

    public function save(GiteEqpExt $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GiteEqpExt $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return GiteEqpExt[] Returns an array of GiteEqpExt objects
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

//    public function findOneBySomeField($value): ?GiteEqpExt
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
