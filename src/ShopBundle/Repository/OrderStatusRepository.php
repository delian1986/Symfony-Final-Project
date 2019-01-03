<?php

namespace ShopBundle\Repository;

use Doctrine\ORM\EntityManagerInterface;
use ShopBundle\Entity\OrderStatus;

/**
 * OrderStatusRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OrderStatusRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param EntityManagerInterface $em
     */

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, new \Doctrine\ORM\Mapping\ClassMetadata(OrderStatus::class));
    }

    public function findOneByName(string $status){

        $q = $this->createQueryBuilder('s')
            ->where('s.name = :status')
            ->setParameter('status', $status)
            ->getQuery();

        return $q->getResult();
    }
}
