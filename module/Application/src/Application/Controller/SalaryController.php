<?php

namespace Application\Controller;

use Application\Entity\Position;
use Application\Entity\Vacancy;
use Application\Entity\Technology;
use Application\Entity\Needs;
use Application\Entity\VacancyNeeds;
use Application\Entity\CompanyVacancy;
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
    
    public function sortAnArrayObject($arrayObj){
        $newArray = array();
        foreach ($arrayObj as $value){
            $newArray[] = $value->getViews();
            
        }
        return;
        
    }

        public function indexAction() {
            
        $expdate = new \DateTime('-1 year');
        $date = $expdate->getTimestamp();

        return new ViewModel(array(
            'technology' => $this->getEntityManager()->getRepository('Application\Entity\Technology')->findAll(),
            'position' => $this->getEntityManager()->getRepository('Application\Entity\Position')->findAll(),
            'city' => $this->getEntityManager()->getRepository('Application\Entity\City')->findAll(),
            'companyVacancy' => $this->getEntityManager()->getRepository('Application\Entity\CompanyVacancy')->findAll(),
            'company' => $this->getEntityManager()->getRepository('Application\Entity\Companies')->findAll(),
            'vacancy' => $this->getEntityManager()->getRepository('Application\Entity\Vacancy')->findBy(array(),array('views' => 'DESC')),
            'date' => $this->getEntityManager()->getRepository('Application\Entity\Vacancy')->findByDate($date)
        ));
    }

    public function searchAction() {
        
        $price = 0;
        $needs = array();
        $experienceMin = 0;
        $validator = new Zend\Validator\Digits(); 
        
       if ($validator->isValid( $this->params()->fromQuery("technology")) && strlen($this->params()->fromQuery("technology")) <= 4 && $this->params()->fromQuery("technology") != 0) {
            $needs['technology_id'] = $this->params()->fromQuery("technology");
        }

        if ($validator->isValid($this->params()->fromQuery("position")) && strlen($this->params()->fromQuery("position")) <= 4 && $this->params()->fromQuery("position") != 0) {
            $needs['position_id'] = $this->params()->fromQuery("position");
        }

        if ($validator->isValid($this->params()->fromQuery("city")) && strlen($this->params()->fromQuery("city")) <= 3 && $this->params()->fromQuery("city") != 0) {
            $needs['city_id'] = $this->params()->fromQuery("city");
        }
        if ($validator->isValid($this->params()->fromQuery("experience")) && strlen($this->params()->fromQuery("experience")) <= 2 && $this->params()->fromQuery("experience") != 0) {
            $experienceMin = $this->params()->fromQuery("experience");
        }
        if ($validator->isValid($this->params()->fromQuery("price")) && strlen($this->params()->fromQuery("price")) <= 6) {
            $price = $this->params()->fromQuery("price");
        }

        $resultNeeds = $this->getEntityManager()->getRepository('Application\Entity\Needs')->findBy($needs);

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

        $vacancyNeedsId = $this->getEntityManager()->getRepository('Application\Entity\VacancyNeeds')->findBy(array('needs' => $needsId));


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

        if (empty($vacancy_id)) {
            return new ViewModel(array(
                'vacancy' => NULL,
                'technology' => $this->getEntityManager()->getRepository('Application\Entity\Technology')->findAll(),
                'position' => $this->getEntityManager()->getRepository('Application\Entity\Position')->findAll(),
                'city' => $this->getEntityManager()->getRepository('Application\Entity\City')->findAll(),
                'queryFilter'=> $this->params()->fromQuery(),                
                ));
            
            
        } else {
            return new ViewModel(array(
                'technology' => $this->getEntityManager()->getRepository('Application\Entity\Technology')->findAll(),
                'position' => $this->getEntityManager()->getRepository('Application\Entity\Position')->findAll(),
                'city' => $this->getEntityManager()->getRepository('Application\Entity\City')->findAll(),
                'vacancy' => $this->getEntityManager()->getRepository('Application\Entity\Vacancy')->findById($vacancy_id),
                'companyVacancy' => $this->getEntityManager()->getRepository('Application\Entity\CompanyVacancy')->findBy(array('vacancy' => $vacancy_id)),
                'queryFilter'=> $this->params()->fromQuery(),
            ));
        }
    }
    
    public function vacancyDetailAction() {
        $vacancyResult = $this->getEntityManager()->getRepository('Application\Entity\Vacancy')->findById($this->params()->fromRoute('id'));
        foreach ($vacancyResult as $value){
            if($value->getViews() == NULL){                
                $value->setViews('1');
                $value->setId($value->getId());                
                $this->getEntityManager()->flush();                
            }else{
                $views = $value->getViews();
                $views ++;
                $value->setViews($views);
                $value->setId($value->getId());                
                $this->getEntityManager()->flush();
            }
        }
        
        return new ViewModel(array(
            'vacancy' => $vacancyResult,
            'company' => $this->getEntityManager()->getRepository('Application\Entity\CompanyVacancy')->findBy(array('vacancy_id' => $this->params()->fromRoute('id')))
            ));        
    }
    
    public function vacancyAddAction(){
        
       if (empty($this->params()->fromPost())) {
            echo 'Внесите данные';
        } else {
            $formPostNeeds['technology_id'] = $this->params()->fromPost('technology');
            $formPostNeeds['position_id'] = $this->params()->fromPost('position');
            $formPostNeeds['city_id'] = $this->params()->fromPost('city');
            $formPostNeeds['experience'] = $this->params()->fromPost('vacancyExpr');

            $resultNeeds = $this->getEntityManager()->getRepository('Application\Entity\Needs')->findBy($formPostNeeds);
            $needsId = 0;
            if (empty($resultNeeds)) {
                $needs = new Needs();
                $needs->setTechnologyId($this->params()->fromPost('technology'));
                $needs->setPositionId($this->params()->fromPost('position'));
                $needs->setCityId($this->params()->fromPost('city'));
                $needs->setExperience($this->params()->fromPost('vacancyExpr'));
                $this->getEntityManager()->persist($needs);
                $this->getEntityManager()->flush();
                $needsId = $needs->getId();
            } else {
                foreach ($resultNeeds as $value) {
                    $needsId = $value->getId();
                }
            }

            $formPostVacancy['name'] = $this->params()->fromPost('vacancyName');
            $formPostVacancy['description'] = $this->params()->fromPost('vacancyDescr');

            $resultVacancy = $this->getEntityManager()->getRepository('Application\Entity\Vacancy')->findBy($formPostVacancy);

            if (empty($resultVacancy)) {
                $vacancy = new Vacancy();
                $vacancy->setName($this->params()->fromPost('vacancyName'));
                $vacancy->setDescription($this->params()->fromPost('vacancyDescr'));
                $vacancy->setPrice($this->params()->fromPost('vacancyPrice'));
                $vacancy->setDateCreate();
                $vacancy->setDateEnd('+' . $this->params()->fromPost('vacancyActive') . 'day');
                $this->getEntityManager()->persist($vacancy);
                $this->getEntityManager()->flush();
                $vacancyId = $vacancy->getId();
                
                    $vacancyNeeds = new VacancyNeeds();
                    $vacancyNeeds->setVacancyId($vacancyId);
                    $vacancyNeeds->setNeedsId($needsId);
                    $this->getEntityManager()->persist($vacancyNeeds);
                    $this->getEntityManager()->flush();
                
                
                    $companyVacancy = new CompanyVacancy();
                    $companyVacancy->setVacancyId($vacancyId);
                    $companyVacancy->setCompanyId($this->params()->fromPost('companyId'));
                    $this->getEntityManager()->persist($companyVacancy);
                    $this->getEntityManager()->flush();
                
                
                echo 'Вакансия добавлена';
                
            } else {
                echo 'Ваша запись уже существует, пожалуйста отредактируйте или удалите старую вакансию';
            }
        }
        
         return new ViewModel(array(
            'technology' => $this->getEntityManager()->getRepository('Application\Entity\Technology')->findAll(),
            'position' => $this->getEntityManager()->getRepository('Application\Entity\Position')->findAll(),
            'city' => $this->getEntityManager()->getRepository('Application\Entity\City')->findAll(),
            'companyVacancy' => $this->getEntityManager()->getRepository('Application\Entity\CompanyVacancy')->findAll(),
            'company' => $this->getEntityManager()->getRepository('Application\Entity\Companies')->findAll(),
        ));
        
    }
}
