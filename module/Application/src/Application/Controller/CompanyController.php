<?php



namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CompanyController extends AbstractActionController
{
    public function indexAction()
    {
        printf("Company index");
        return new ViewModel();
    }
}