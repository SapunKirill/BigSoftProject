<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Entity\Position;
use Application\Entity\Vacancy;
use Application\Entity\NewsTechnology;
use Application\Entity\Technology;
use Zend;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
     /**
     * @var EntityManager
     */
    protected $em;


    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }
    public function indexAction()
    {   
        
        if(!empty($this->params()->fromPost('country'))){
          $news = $this->getEntityManager()->getRepository('Application\Entity\News')->findBy(array('country' => $this->params()->fromPost('country')),array('id'=>'DESC'));            
        }else{
        
          $news = $this->getEntityManager()->getRepository('Application\Entity\News')->findAll(array(),array('id'=>'DESC'));
        }

       
        return new ViewModel(array(
            'news'=>$news,
            'technology' => $this->getEntityManager()->getRepository('Application\Entity\Technology')->findAll(),
        ));
    }
}
