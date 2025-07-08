<?php

namespace App\Repository;

use App\Entity\Episode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Episode>
 */
class EpisodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Episode::class);
    }

        /**
         * @return Episode[] Returns an array of Episode objects
         */
    public function findByTitle(?string $title): array
    {
        // Létrehoz egy lekérdezést, ami alapból minden filmet visszaadna.
        $qb = $this->createQueryBuilder('m');

        // Ha a title paraméter nem üres, hozzáad egy WHERE feltételt.
        if ($title) {
            $qb->andWhere('m.title LIKE :title')
                ->setParameter('title', '%' . $title . '%');
        }

        // Visszaadja az eredményeket ABC sorrendben.
        return $qb->orderBy('m.title', 'ASC')
            ->getQuery()
            ->getResult();
    }
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Episode
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
