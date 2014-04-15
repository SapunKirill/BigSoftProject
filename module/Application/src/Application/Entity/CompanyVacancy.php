<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;


/** @ORM\Entity */
class CompanyVacancy {

    /** @ORM\Column(type="integer", name="company_id") */
    protected $company_id;

    /** @ORM\Column(type="integer", name="vacancy_id") */
    protected $vacancy_id;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Companies")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    protected $company;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Vacancy")
     * @ORM\JoinColumn(name="vacancy_id", referencedColumnName="id")
     */
    protected $vacancy;




    /**
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company_id
     */
    public function setCompanyId($company_id)
    {
        $this->company_id = $company_id;
    }

    /**
     * @return mixed
     */
    public function getCompanyId()
    {
        return $this->company_id;
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