<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;


/** @ORM\Entity */
class Companies {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /** @ORM\Column(name="`name`", type="string", nullable=true) */
    protected $name;

    /** @ORM\Column(name="`legal_name`", type="string", nullable=true) */
    protected $legal_name;

    /** @ORM\Column(name="`worker_count`", type="integer", nullable=true) */
    protected $worker_count;

    /** @ORM\Column(name="`address`", type="string", nullable=true) */
    protected $address;

    /** @ORM\Column(name="`phone`", type="string", nullable=true) */
    protected $phone;

    /** @ORM\Column(name="`service`", type="string", nullable=true) */
    protected $service;

    /** @ORM\Column(name="`logo`", type="string", nullable=true) */
    protected $logo;
    
    /** @ORM\Column(name="`comments`", type="integer", nullable=true) */
    protected $comments;






    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
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
     * @param mixed $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
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
     * @param mixed $name
     */
    public function setLegalName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLegalName()
    {
        return $this->name;
    }
    
    /**
     * @param mixed $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }

    /**
     * @return mixed
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param mixed $worker_count
     */
    public function setWorkerCount($worker_count)
    {
        $this->worker_count = $worker_count;
    }

    /**
     * @return mixed
     */
    public function getWorkerCount()
    {
        return $this->worker_count;
    }

    /**
     * @param mixed $time
     */
    public function setComments($comments){
        $this->comments = $comments;
    }
    
        /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }


}