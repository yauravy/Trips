<?php

namespace App\Repository;

use App\Entity\Trip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Trip>
 *
 * @method Trip|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trip|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trip[]    findAll()
 * @method Trip[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TripRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trip::class);
    }

    public function add(Trip $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Trip $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findJoin(int $id)
    {
        $bd = $this->createQueryBuilder('t');
        $bd->andWhere('t.id = :id')->setParameter(':id', $id)
            ->leftJoin('t.etat', 'e')->addSelect('e')
            ->leftJoin('t.creator', 'c')->addSelect('c')
            ->leftJoin('t.inscriptions', 'i')->addSelect('i')
            ->leftJoin('i.user', 'iuser')->addSelect('iuser')
            ->leftJoin('t.lieu', 'lieu')->addSelect('lieu');

        return $bd->getQuery()->getOneOrNullResult();

    }

}
