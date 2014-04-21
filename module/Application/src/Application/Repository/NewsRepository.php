<?php
namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;

class NewsRepository extends EntityRepository
{
    public function findAllAsArrayIndexedById() {
        return $this->getEntityManager()
            ->createQuery('SELECT e FROM '.$this->getEntityName().' e INDEX BY e.id')
            ->getArrayResult();
    }
}