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
    
    public function listDateAction(){       
        
        $expdate = new \DateTime($this->params()->fromRoute('Y').'-'.$this->params()->fromRoute('m').'-'.$this->params()->fromRoute('d'));
        
        return new ViewModel(array(
            'news' => $this->getEntityManager()->getRepository('Application\Entity\News')->findBy(array('time' => $expdate)),
            'comments' => $this->getEntityManager()->getRepository('Application\Entity\NewsComments')->findAll(),
        ));
        
    }

        public function newsDetailAction(){
            
               if(!empty($this->params()->fromPost())){
                   
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
        

            
        $expdate = new \DateTime($this->params()->fromRoute('Y').'-'.$this->params()->fromRoute('m').'-'.$this->params()->fromRoute('d'));
                
        return new ViewModel(array(
            
            'news' => $this->getEntityManager()->getRepository('Application\Entity\News')->findBy(array('id' => $this->params()->fromRoute('id'),'time'=> $expdate)),
            'commentsToNews' => $this->getEntityManager()->getRepository('Application\Entity\NewsComments')->findBy(array('news_id' => $this->params()->fromRoute('id'))),
            'commentsToComments' => $this->getEntityManager()->getRepository('Application\Entity\CommentsToComments')->findAll(),
        )); 
        

        
    }
        public function newsAddAction(){
            
            if(empty($this->params()->fromPost())){
                echo 'Внесите данные';
            }else{
            
                $formPostNews['name']=  $this->params()->fromPost('newsName');
                $formPostNews['short_text']=  $this->params()->fromPost('newsShortText');
                $formPostNews['full_text']=  $this->params()->fromPost('newsFullText');
             
                $resultNews = $this->getEntityManager()->getRepository('Application\Entity\News')->findBy($formPostNews);
                
                if(empty($resultNews)){
                    $news = new News();
                    $news->setName($this->params()->fromPost('newsName'));
                    $news->setShortText($this->params()->fromPost('newsShortText'));
                    $news->setFullText($this->params()->fromPost('newsFullText'));
                    $news->setTime();
                    $this->getEntityManager()->persist($news);
                    $this->getEntityManager()->flush();
                    
                    echo 'Новость успешно добавлена';
                }else{
                    echo 'Такая запись уже существует, пожалуйста отредактируйте или удалите старую новость';
            }}
                
            return new ViewModel();
            
        }
        
}