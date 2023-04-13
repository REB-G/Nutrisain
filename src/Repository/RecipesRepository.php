<?php

namespace App\Repository;

use App\Entity\Recipes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recipes>
 *
 * @method Recipes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipes[]    findAll()
 * @method Recipes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipes::class);
    }

    public function save(Recipes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Recipes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Recipes[] Returns an array of Recipes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Recipes
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    // Méthode pour effectuer une pagination (sans bundle)
    public function getPaginatedRecipes(int $page, int $limit, $filtersCategories = null, $filtersDiets = null): array
    {
        $offset = (($page * $limit) - $limit);

        $query = $this->createQueryBuilder('r')
            ->where('r.isPublic = true');

        if ($filtersCategories !== null) {
            $query->andWhere('r.category IN (:filtersCategories)')
                ->setParameter('filtersCategories', $filtersCategories);
        }

        if ($filtersDiets !== null) {
            $query->innerJoin('r.diet', 'd')
                ->andWhere('d IN (:filtersDiets)')
                ->setParameter('filtersDiets', $filtersDiets);
        }

        $query->orderBy('r.category', 'DESC')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery();

        return $query->getQuery()->getResult();
    }

    // Méthode pour compter le nombre de total de recettes publiques
    public function countRecipes($filtersCategories = null, $filtersDiets = null): int
    {
        $query = $this->createQueryBuilder('r')
            ->select('COUNT(r.id)')
            ->where('r.isPublic = true');

            if ($filtersCategories !== null) {
                $query->andWhere('r.category IN (:filtersCategories)')
                    ->setParameter('filtersCategories', $filtersCategories);
            }

            if ($filtersDiets !== null) {
                $query->innerJoin('r.diet', 'd')
                    ->andWhere('d IN (:filtersDiets)')
                    ->setParameter('filtersDiets', $filtersDiets);
            }

        return $query->getQuery()->getSingleScalarResult();
    }
}
