<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * @author Yohan Giarelli <yohan@un-zero-un.fr>
 */
class ProductRepository extends EntityRepository
{
    public function getLasts($nb = 5)
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.id', 'ASC')
            ->setMaxResults($nb)
            ->getQuery()
            ->getResult();
    }
}
