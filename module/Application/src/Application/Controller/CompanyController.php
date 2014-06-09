<?php



namespace Application\Controller;

use Application\Entity\Companies;
use Application\Entity\CompanyComments;
use Application\Entity\CompanyVacancy;
use Application\Entity\Vacancy;
use Application\Entity\Comments;
use Application\Entity\CommentsToComments;

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
            'vacancy' => $this->getEntityManager()->getRepository('Application\Entity\CompanyVacancy')->findAll(),
            
            'comments' => $this->getEntityManager()->getRepository('Application\Entity\Comments')->findAll(),
        ));
    }

    public function companyDetailAction()
    {
               
               if(!empty($this->params()->fromPost())){
                   if (!empty($this->params()->fromPost('like')) || !empty($this->params()->fromPost('disLike'))){                   
               $comment = $this->getEntityManager()->getRepository('Application\Entity\Comments')->findById($this->params()->fromPost('id'));
               foreach ($comment as $value){
                   if($this->params()->fromPost('like') == -1){
                       $count = $value->getDislike();
                       $count++;
                       $value->setDislike($count);
                       $this->getEntityManager()->flush();
                   }
                   if($this->params()->fromPost('like') == 1){
                       $count = $value->getLike();
                       $count++;
                       $value->setLike($count);
                       $this->getEntityManager()->flush();             
                   }
                }
                }
               if(!empty($this->params()->fromPost('parent_id'))){
                   $comment = new Comments;
                   $comment->setAuthorId($this->params()->fromPost('autId'));
                   $comment->setText($this->params()->fromPost('textNewComment'));
                   $comment->setTime();
                   $this->getEntityManager()->persist($comment);
                   $this->getEntityManager()->flush();
                   $newsId = 0;
                       foreach ($news as $value){
                          $newsId = $value->getId();
                          $comentCount = $value->getComments();
                          $comentCount ++;
                          $value->setComments($comentCount);
                          $this->getEntityManager()->flush();                          
                       }
                    
                   if($this->params()->fromPost('parent_id') !== 0){
                       $comToCom = new CommentsToComments();
                       $comToCom->setParent($this->params()->fromPost('parent_id'));
                       $comToCom->setChild($comment->getId());
                       $this->getEntityManager()->persist($comToCom);
                       $this->getEntityManager()->flush();
                       
                   }else{
                       $newsComment = new NewsComments();
                       $newsComment->setNewsId($newsId);
                       $newsComment->setCommentsId($comment->getId());
                       $this->getEntityManager()->persist($newsComment);
                       $this->getEntityManager()->flush();
                   }
                   
               }
               }
        
        
        return new ViewModel(array(
            'company' => $this->getEntityManager()->getRepository('Application\Entity\Companies')->findById($this->params()->fromRoute('id')),            
            'vacancy' => $this->getEntityManager()->getRepository('Application\Entity\CompanyVacancy')->findBy(array('company_id' => $this->params()->fromRoute('id'))),
            'commentsParent' => $this->getEntityManager()->getRepository('Application\Entity\CompanyComments')->findBy(array('company_id' => $this->params()->fromRoute('id'))),
            'commentsToComments' => $this->getEntityManager()->getRepository('Application\Entity\CommentsToComments')->findAll(),
            
            
            
        ));
    }
}