<?php

namespace ShopBundle\Repository;

/**
 * AdminHelperRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AdminHelperRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getInitialCashValue()
    {
        $qb = $this->createQueryBuilder('a')
            ->select('a.initialCash');
        return $qb->getQuery()->setMaxResults(1)->getSingleScalarResult();
    }

    public function getOldInitialCash(){
        $qb = $this->createQueryBuilder('a')
                    ->select('a.initialCash');
        return $qb->getQuery()->getResult()[0];
    }

}
