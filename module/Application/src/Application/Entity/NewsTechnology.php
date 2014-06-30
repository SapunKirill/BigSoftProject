<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;


/** @ORM\Entity */
class NewsTechnology {

    /** @ORM\Column(type="integer", name="news_id") */
    protected $news_id;

    /** @ORM\Column(type="integer", name="technology_id") */
    protected $technology_id;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="News")
     * @ORM\JoinColumn(name="news_id", referencedColumnName="id")
     */
    protected $news;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Technology")
     * @ORM\JoinColumn(name="technology_id", referencedColumnName="id")
     */
    protected $technology;




    //getters/setters



    /**
     * @param mixed $technology
     */
    public function setTechnology($technology)
    {
        $this->technology = $technology;
    }

    /**
     * @return mixed
     */
    public function getTechnology()
    {
        return $this->technology;
    }

    /**
     * @param mixed $technologyId
     */
    public function setTechnologyId($technologyId)
    {
        $this->technologyId = $technologyId;
    }

    /**
     * @return mixed
     */
    public function getTechnologyId()
    {
        return $this->technologyId;
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