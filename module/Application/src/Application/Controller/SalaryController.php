<?php
namespace Application\Controller;

use Application\Entity\Position;
use Application\Entity\Vacancy;
use Application\Entity\Technology;
use Zend;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SalaryController extends AbstractActionController
{
    public function indexAction()
    {
        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');        
        
        
        $getTechnology = $objectManager->find('Application\Entity\Technology', 1);
        
        printf($getTechnology->getName());
        return new ViewModel();
    }
}