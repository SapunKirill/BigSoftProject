<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;


/** @ORM\Entity */
class Comments {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /** @ORM\Column(name="`author_id`", type="integer", nullable=true) */
    protected $author_id;

    /** @ORM\Column(name="`text`", type="string", nullable=true) */
    protected $text;

    /** @ORM\Column(name="`time`", type="datetime", nullable=true) */
    protected $time;

    /** @ORM\Column(name="`like`", type="integer", nullable=true) */
    protected $like;

    /** @ORM\Column(name="`dislike`", type="integer", nullable=true) */
    protected $dislike;



    //getters/setters



    /**
     * @param mixed $author_id
     */
    public function setAuthorId($author_id)
    {
        $this->author_id = $author_id;
    }

    /**
     * @return mixed
     */
    public function getAuthorId()
    {
        return $this->author_id;
    }

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
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $time
     */
    public function setTime()
    {
        $this->time = new \DateTime('now');
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }





}