<?php

namespace App\Repository;

use App\Entity\Svelte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Svelte>
 *
 * @method Svelte|null find($id, $lockMode = null, $lockVersion = null)
 * @method Svelte|null findOneBy(array $criteria, array $orderBy = null)
 * @method Svelte[]    findAll()
 * @method Svelte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class SvelteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Svelte::class);
    }

    public function save(Svelte $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Svelte $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
