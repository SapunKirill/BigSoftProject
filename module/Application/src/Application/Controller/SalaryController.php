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
        $position_id = $this->params()->fromQuery("position");
        $technology_id = $this->params()->fromQuery("technology");
        $city_id = $this->params()->fromQuery("city");
        $experience = $this->params()->fromQuery("experience");
        $price = 0;
        $needs = array();
        $experienceMin = 0;
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
            $experienceMin = $experience;
        }
        if ($validator->isValid($this->params()->fromQuery("price")) && strlen($this->params()->fromQuery("price")) <= 6) {
            $price = $this->params()->fromQuery("price");
        }

        $resultNeeds = $this->getEntityManager()
                ->getRepository('Application\Entity\Needs')
                ->findBy($needs);

        $needsId = array();
        if ($experienceMin !== 0) {
            foreach ($resultNeeds as $value) {
                if ($value->getExperience() <= $experienceMin) {
                    $needsId[] = $value->getId();
                }
            }
        } else {
            foreach ($resultNeeds as $value) {
                $needsId[] = $value->getId();
            }
        }

        $vacancyNeedsId = $this->getEntityManager()
                ->getRepository('Application\Entity\VacancyNeeds')
                ->findBy(array('needs' => $needsId));


        $vacancy_id = array();
        if ($price !== 0) {
            foreach ($vacancyNeedsId as $value) {
                if ($value->getVacancy()->getPrice() >= $price) {
                    $vacancy_id[] = $value->getVacancy()->getId();
                }
            }
        } else {
            foreach ($vacancyNeedsId as $value) {
                $vacancy_id[] = $value->getVacancy()->getId();
            }
        }

        return new ViewModel(array(
            'vacancy' => $this->getEntityManager()
                    ->getRepository('Application\Entity\Vacancy')
                    ->findById($vacancy_id)));
    }

}
