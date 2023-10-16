<?php

namespace App\Repository;

use App\Entity\Bicycle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bicycle>
 *
 * @method Bicycle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bicycle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bicycle[]    findAll()
 * @method Bicycle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BicycleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bicycle::class);
    }

    public function removeAssociations(Bicycle $bicycle)
    {
        foreach ($bicycle->getParts() as $part) {

            $bicycle->removePart($part);
            $this->getEntityManager()->persist($bicycle);
        }

        $this->getEntityManager()->flush();
    }

}
