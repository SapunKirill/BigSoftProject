<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;


/** @ORM\Entity */
class VacancyNeeds {

    /** @ORM\Column(type="integer", name="vacancy_id") */
    protected $vacancy_id;

    /** @ORM\Column(type="integer", name="needs_id") */
    
    protected $needs_id;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Vacancy")
     * @ORM\JoinColumn(name="vacancy_id", referencedColumnName="id")
     */
    protected $vacancy;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Needs")
     * @ORM\JoinColumn(name="needs_id", referencedColumnName="id")
     */
    protected $needs;

    /**
     * @param mixed $needs
     */
    public function setNeeds($needs)
    {
        $this->needs = $needs;
    }

    /**
     * @return mixed
     */
    public function getNeeds()
    {
        return $this->needs;
    }

    /**
     * @param mixed $needs_id
     */
    public function setNeedsId($needs_id)
    {
        $this->needs_id = $needs_id;
    }

    /**
     * @return mixed
     */
    public function getNeedsId()
    {
        return $this->needs_id;
    }

    /**
     * @param mixed $vacancy
     */
    public function setVacancy($vacancy)
    {
        $this->vacancy = $vacancy;
    }

    /**
     * @return mixed
     */
    public function getVacancy()
    {
        return $this->vacancy;
    }

    /**
     * @param mixed $vacancy_id
     */
    public function setVacancyId($vacancy_id)
    {
        $this->vacancy_id = $vacancy_id;
    }

    /**
     * @return mixed
     */
    public function getVacancyId()
    {
        return $this->vacancy_id;
    }





}