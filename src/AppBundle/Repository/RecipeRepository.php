<?php

namespace AppBundle\Repository;

/**
 * RecipeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RecipeRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllPrivate()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT r FROM AppBundle:recipe r WHERE r.visibility = 0'
            )
            ->getResult();
    }

    public function findAllPublic()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT r FROM AppBundle:recipe r WHERE r.visibility = 1'
            )
            ->getResult();
    }

    public function findCreateDateDESC()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT r FROM AppBundle:recipe r ORDER BY r.createDate DESC'

            )
            ->getResult();
    }

    public function findEditDateDESC()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT r FROM AppBundle:recipe r ORDER BY r.editDate DESC'

            )
            ->getResult();
    }

    /*public function createAlphabeticalQueryBuilder(){
        return $this->createAlphabeticalQueryBuilder('tag')
            ->orderBy('recipe.tag','ASC');
    }*/

    public function findOneByIdJoinedToTag()
    {
        /*$query = $this->getEntityManager()
            ->createQuery(
                'SELECT r, t FROM AppBundle:recipe r
            JOIN r.tag t
            WHERE r.id = :id'
            )->setParameter('id', $tagId);

        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }*/
        return $this->getEntityManager()
            ->createQuery(
                //'SELECT r, t FROM AppBundle:Recipe r JOIN r.tag t WHERE r.id = 1
                'SELECT r FROM AppBundle:recipe r WHERE r.visibility = 1'
            )
            ->getResult();
    }
}
