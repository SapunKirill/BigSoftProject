<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SalaryController extends AbstractActionController
{
    public function indexAction()
    {
        printf("Salary index");
        return new ViewModel();
    }
}