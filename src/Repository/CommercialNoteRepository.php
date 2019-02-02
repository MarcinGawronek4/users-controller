<?php

namespace App\Repository;

use App\Entity\CommercialNote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CommercialNote|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommercialNote|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommercialNote[]    findAll()
 * @method CommercialNote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommercialNoteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CommercialNote::class);
    }

    // /**
    //  * @return CommercialNote[] Returns an array of CommercialNote objects
    //  */
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
    public function findOneBySomeField($value): ?CommercialNote
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
