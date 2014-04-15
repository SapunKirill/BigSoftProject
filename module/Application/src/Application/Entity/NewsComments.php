<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;


/** @ORM\Entity */
class NewsComments {

    /** @ORM\Column(type="integer", name="news_id") */
    protected $news_id;

    /** @ORM\Column(type="integer", name="comments_id") */
    protected $comments_id;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="News")
     * @ORM\JoinColumn(name="news_id", referencedColumnName="id")
     */
    protected $news;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Comments")
     * @ORM\JoinColumn(name="comments_id", referencedColumnName="id")
     */
    protected $comments;




    //getters/setters



    /**
     * @param mixed $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $commentsId
     */
    public function setCommentsId($commentsId)
    {
        $this->commentsId = $commentsId;
    }

    /**
     * @return mixed
     */
    public function getCommentsId()
    {
        return $this->commentsId;
    }

    /**
     * @param mixed $news
     */
    public function setNews($news)
    {
        $this->news = $news;
    }

    /**
     * @return mixed
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * @param mixed $newsId
     */
    public function setNewsId($newsId)
    {
        $this->newsId = $newsId;
    }

    /**
     * @return mixed
     */
    public function getNewsId()
    {
        return $this->newsId;
    }



}