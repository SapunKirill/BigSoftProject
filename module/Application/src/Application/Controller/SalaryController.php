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
        
        $id = $this->params()->fromRoute('technology');
        
        var_dump($_POST);
        
        var_dump($id);
        
        return new ViewModel();
    }

}
