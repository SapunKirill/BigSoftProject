<?php
namespace Application\Controller;

use Application\Entity\News;
use Application\Entity\NewsComments;
use Zend;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class NewsController extends AbstractActionController
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
        return new ViewModel(array(
            'news' => $this->getEntityManager()->getRepository('Application\Entity\News')->findBy(array(),array('id' => 'DESC')),
            'comments' => $this->getEntityManager()->getRepository('Application\Entity\NewsComments')->findAll(),
        ));
    }
    
    public function newsDetailAction(){
        
                
        return new ViewModel(array(
            'news' => $this->getEntityManager()->getRepository('Application\Entity\News')->findById($this->params()->fromRoute('id')),
            'commentsToNews' => $this->getEntityManager()->getRepository('Application\Entity\NewsComments')->findBy(array('news_id' => $this->params()->fromRoute('id'))),
            'commentsToComments' => $this->getEntityManager()->getRepository('Application\Entity\CommentsToComments')->findAll(),
        ));        
        
    }
}