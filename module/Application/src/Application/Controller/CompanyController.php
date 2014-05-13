<?php



namespace Application\Controller;

use Application\Entity\Companies;
use Application\Entity\CompanyComments;
use Application\Entity\CompanyVacancy;
use Application\Entity\Vacancy;
use Application\Entity\Comments;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CompanyController extends AbstractActionController
{
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


    public function indexAction()
    {

        return new ViewModel(array(
            'company' => $this->getEntityManager()->getRepository('Application\Entity\Companies')->findAll(),
            'companycomments' => $this->getEntityManager()->getRepository('Application\Entity\CompanyComments')->findAll(),
            'companyvacancy' => $this->getEntityManager()->getRepository('Application\Entity\CompanyVacancy')->findAll(),
            'vacancy' => $this->getEntityManager()->getRepository('Application\Entity\Vacancy')->findAll(),
            'comments' => $this->getEntityManager()->getRepository('Application\Entity\Comments')->findAll(),
        ));
    }

    public function listcompanyAction()
    {

        return new ViewModel(array(
            'company' => $this->getEntityManager()->getRepository('Application\Entity\Companies')->findAll(),
        ));
    }
}