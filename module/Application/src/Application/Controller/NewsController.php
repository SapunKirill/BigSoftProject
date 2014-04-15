<?php
namespace Application\Controller;

use Application\Entity\News;
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
        $objectManager = $this
            ->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager');
        $news = new News();
        $news->setName("blabla");
        $objectManager->persist($news);
        $objectManager->flush();

        $getNews = $objectManager->find('Application\Entity\News', 1);
        printf($getNews->getName());

        return new ViewModel();
    }
}