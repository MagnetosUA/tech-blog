<?php

namespace MagnetosCompany\BlogBundle\Repository;

/**
 * CommentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentRepository extends \Doctrine\ORM\EntityRepository
{
    public function findCommentsByArticle($articleId)
    {
        $query = $this->createQueryBuilder('c')
            ->where('c.article = :articleID')
            ->setParameter('articleID', $articleId)
            ->getQuery();

        return $query;
    }
}
