<?php

namespace App\Repository;

use App\Entity\ExpenseReport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExpenseReport>
 *
 * @method ExpenseReport|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExpenseReport|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExpenseReport[]    findAll()
 * @method ExpenseReport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExpenseReportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExpenseReport::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(ExpenseReport $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(ExpenseReport $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @return ExpenseReport[] Returns an array of ExpenseReport objects
     */
    public function findByUser($userId, $limit = 20, $offset = 0)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.owner = :userId')
            ->setParameter('userId', $userId)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?ExpenseReport
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
