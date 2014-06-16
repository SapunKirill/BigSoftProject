<?php
namespace Application\Controller;

use Application\Entity\News;
use Application\Entity\NewsComments;
use Application\Entity\Comments;
use Application\Entity\CommentsToComments;
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
            $expdate = new \DateTime($this->params()->fromRoute('Y').'-'.$this->params()->fromRoute('m').'-'.$this->params()->fromRoute('d'));
            $news = $this->getEntityManager()->getRepository('Application\Entity\News')->findBy(array('id' => $this->params()->fromRoute('id'),'time'=> $expdate));
            
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
        $view = new ViewModel(array(            
            'news' => $news,
        ));
        
        $commentsView = new ViewModel(array(
            'commentsParent' => $this->getEntityManager()->getRepository('Application\Entity\NewsComments')->findBy(array('news_id' => $this->params()->fromRoute('id'))),
            'commentsToComments' => $this->getEntityManager()->getRepository('Application\Entity\CommentsToComments')->findAll()));
        $commentsView->setTemplate('templates/commentsList');
        $view->addChild($commentsView, 'comments');     
        
        return $view;
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