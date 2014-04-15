<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;


/** @ORM\Entity */
class Needs {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /** @ORM\Column(name="`position_id`", type="integer", nullable=true) */
    protected $position_id;

    /** @ORM\Column(name="`technology_id`", type="integer", nullable=true) */
    protected $technology_id;

    /** @ORM\Column(name="`city_id`", type="integer", nullable=true) */
    protected $city_id;

    /** @ORM\Column(name="`experience`", type="integer", nullable=true) */
    protected $experience;

    /**
     * @param mixed $city_id
     */
    public function setCityId($city_id)
    {
        $this->city_id = $city_id;
    }

    /**
     * @return mixed
     */
    public function getCityId()
    {
        return $this->city_id;
    }

    /**
     * @param mixed $experience
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;
    }

    /**
     * @return mixed
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * @param mixed $position_id
     */
    public function setPositionId($position_id)
    {
        $this->position_id = $position_id;
    }

    /**
     * @return mixed
     */
    public function getPositionId()
    {
        return $this->position_id;
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
     * @param mixed $technology_id
     */
    public function setTechnologyId($technology_id)
    {
        $this->technology_id = $technology_id;
    }

    /**
     * @return mixed
     */
    public function getTechnologyId()
    {
        return $this->technology_id;
    }



}