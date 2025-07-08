<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Movie>
 */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    /**
     * @return Movie[] Returns an array of Movie objects
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

    //    public function findOneBySomeField($value): ?Movie
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
