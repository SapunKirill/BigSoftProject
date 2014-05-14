<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="Application\Repository\NewsRepository")
 */
class News {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /** @ORM\Column(name="`name`", type="string",nullable=true) */
    protected $name;

    /** @ORM\Column(name="`short_text`", type="string",nullable=true) */
    protected $short_text;

    /** @ORM\Column(name="`full_text`", type="text",length=50000, nullable=true) */
    protected $full_text;

    /** @ORM\Column(name="`img`", type="string", nullable=true) */
    protected $img;

    /** @ORM\Column(name="`time`", type="date", nullable=true) */
    protected $time;

    /** @ORM\Column(name="`like`", type="integer", nullable=true) */
    protected $like;

    /** @ORM\Column(name="`dislike`", type="integer", nullable=true) */
    protected $dislike;

    /** @ORM\Column(name="`rating`", type="integer", nullable=true) */
    protected $rating;





    /**
     * @param mixed $dislike
     */
    public function setDislike($dislike)
    {
        $this->dislike = $dislike;
    }

    /**
     * @return mixed
     */
    public function getDislike()
    {
        return $this->dislike;
    }

    /**
     * @param mixed $full_text
     */
    public function setFullText($full_text)
    {
        $this->full_text = $full_text;
    }

    /**
     * @return mixed
     */
    public function getFullText()
    {
        return $this->full_text;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }

    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $like
     */
    public function setLike($like)
    {
        $this->like = $like;
    }

    /**
     * @return mixed
     */
    public function getLike()
    {
        return $this->like;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $short_text
     */
    public function setShortText($short_text)
    {
        $this->short_text = $short_text;
    }

    /**
     * @return mixed
     */
    public function getShortText()
    {
        return $this->short_text;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }



    // getters/setters



}