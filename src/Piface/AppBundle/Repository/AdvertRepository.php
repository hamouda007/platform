<?php

namespace Piface\AppBundle\Repository;

use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityRepository;

/**
 * AdvertRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AdvertRepository extends EntityRepository
{
    public function getMyListAdvert($id)
    {
        $qb = $this->createQueryBuilder('a');

        $qb
            ->where('a.user = :user')
            ->setParameter(':user', $id);

        return $qb->getQuery()->getResult();
    }

    public function isAuthorized($id)
    {
        $qb = $this->createQueryBuilder('a');

        $qb
            ->leftJoin('a.user', 'user')
            ->select('user.id')
            ->where('a.id = :id')
            ->setParameter(':id', $id);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
