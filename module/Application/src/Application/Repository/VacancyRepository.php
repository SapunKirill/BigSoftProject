<?php

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Application\Entity\Vacancy;

class VacancyRepository extends EntityRepository {

    public function findByDate($date) {
        return $this->getEntityManager()
        ->createQuery('SELECT e FROM ' . $this->getEntityName('Application\Entity\Vacancy') . ' e WHERE e.date_create >=  ' . $date . '')
        ->getArrayResult();
    }
}