<?php

namespace Application\Controller;

use Application\Entity\Position;
use Application\Entity\Vacancy;
use Application\Entity\Technology;
use Application\Entity\Needs;
use Application\Entity\City;
use Zend;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SalaryController extends AbstractActionController {

    /**
     * @var EntityManager
     */
    protected $em;

    public function setEntityManager(EntityManager $em) {
        $this->em = $em;
    }

    public function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function indexAction() {
        return new ViewModel(array(
            'technology' => $this->getEntityManager()->getRepository('Application\Entity\Technology')->findAll(),
            'position' => $this->getEntityManager()->getRepository('Application\Entity\Position')->findAll(),
            'city' => $this->getEntityManager()->getRepository('Application\Entity\City')->findAll(),
        ));
    }

    public function searchAction() {
        $position_id = $this->params('position');
        $technology_id = $this->params('technology');
        $city_id = $this->params('city');
        $experience = $this->params('experience');
        $price = 0;
        $needs = array();

        $validator = new Zend\Validator\Digits();

        if ($validator->isValid($position_id) && strlen($position_id) <= 4 && $position_id != 0) {
            $needs['position_id'] = $position_id;
        }
        if ($validator->isValid($technology_id) && strlen($technology_id) <= 4 && $technology_id != 0) {
            $needs['technology_id'] = $technology_id;
        }
        if ($validator->isValid($city_id) && strlen($city_id) <= 3 && $city_id != 0) {
            $needs['city_id'] = $city_id;
        }
        if ($validator->isValid($experience) && strlen($experience) <= 2 && $experience != 0) {
            $needs['experience'] = $experience;
        }
        if ($validator->isValid($this->params('price')) && strlen($this->params('price')) <= 6) {
            $price = $this->params('price');
        }

        $needs_id = 0;
        $resultNeeds = $this->getEntityManager()
                ->getRepository('Application\Entity\Needs')
                ->findBy($needs);
        foreach ($resultNeeds as $value) {
            $needs_id = $value->getId();
        }
        $vacancyId = 0;
        $resultVacancyNeeds = $this->getEntityManager()
                ->getRepository('Application\Entity\VacancyNeeds')
                ->findBy(array('needs' => $needs_id));
        foreach ($resultVacancyNeeds as $value) {
            $vacancyId = $value->getVacancyId();
        }

        if ($price != 0) {
            return new ViewModel(array(
                'vacancy' => $this->getEntityManager()
                        ->getRepository('Application\Entity\Vacancy')
                        ->findBy(array('id' => $vacancyId,
                            'price' => $price,
                        )),
            ));
        } else {
            return new ViewModel(array(
                'vacancy' => $this->getEntityManager()
                        ->getRepository('Application\Entity\Vacancy')
                        ->findBy(array('id' => $vacancyId,
                        )),
            ));
        }
    }

}
