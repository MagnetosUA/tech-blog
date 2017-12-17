<?php

namespace MagnetosCompany\BlogBundle\Repository;

use MagnetosCompany\BlogBundle\Repository\PostRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
    public function getUserByName($userName)
    {
        $query = $this->createQueryBuilder('u')
            ->where('u.name = :name')
            ->setParameter('name', $userName)
            ->getQuery();

        return $query->getResult();
    }
}
