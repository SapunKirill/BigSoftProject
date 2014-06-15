<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;


/** @ORM\Entity */
class CompanyComments {

    /** @ORM\Column(type="integer", name="company_id") */
    protected $company_id;

    /** @ORM\Column(type="integer", name="comments_id") */
    protected $comments_id;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Companies")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    protected $company;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Comments")
     * @ORM\JoinColumn(name="comments_id", referencedColumnName="id")
     */
    protected $comments;

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
     * @param mixed $comments_id
     */
    public function setCommentsId($comments_id)
    {
        $this->comments_id = $comments_id;
    }

    /**
     * @return mixed
     */
    public function getCommentsId()
    {
        return $this->comments_id;
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





}