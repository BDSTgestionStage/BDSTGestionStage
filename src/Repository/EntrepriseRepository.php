<?php

namespace App\Repository;

use App\Entity\Entreprise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Entreprise>
 *
 * @method Entreprise|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entreprise|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entreprise[]    findAll()
 * @method Entreprise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntrepriseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entreprise::class);
    }

    public function add(Entreprise $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Entreprise $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function search(Request $request)
    {
        $searchTerm = $request->query->get('q', '');

        if (!empty($searchTerm)) {
            $repository = $this->getDoctrine()->getRepository(Entreprise::class);
            $results = $repository->searchByTerm($searchTerm);
        } else {
            $results = [];
        }

        return $this->render('search/results.html.twig', ['results' => $results]);
    }

    public function searchByTerm($term)
    {
        $qb = $this->createQueryBuilder('e');

        $qb->where('e.ENT_NOM LIKE :term')
           ->orWhere('e.ENT_VILLE LIKE :term')
           ->orWhere('e.ENT_PAYS LIKE :term')
           ->orWhere('e.ENT_SPECIALITE LIKE :term')
           ->setParameter('term', '%' . $term . '%')
           ->orderBy('e.ENT_NOM', 'ASC');

        return $qb->getQuery()->getResult();
    }

//    /**
//     * @return Entreprise[] Returns an array of Entreprise objects
//     */
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

//    public function findOneBySomeField($value): ?Entreprise
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
