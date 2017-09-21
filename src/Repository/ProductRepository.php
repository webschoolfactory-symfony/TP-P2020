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
            ->orderBy('p.id', 'DESC')
            ->setMaxResults($nb)
            ->getQuery()
            ->getResult();
    }
}
