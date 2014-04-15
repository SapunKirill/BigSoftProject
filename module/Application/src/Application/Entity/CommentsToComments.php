<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;


/** @ORM\Entity */
class CommentsToComments {
    /** @ORM\Column(type="integer", name="parent_id") */
    protected $parent_id;

    /** @ORM\Column(type="integer", name="child_id") */
    protected $child_id;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Comments")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $parent;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Comments")
     * @ORM\JoinColumn(name="child_id", referencedColumnName="id")
     */
    protected $child;

    /**
     * @param mixed $child
     */
    public function setChild($child)
    {
        $this->child = $child;
    }

    /**
     * @return mixed
     */
    public function getChild()
    {
        return $this->child;
    }

    /**
     * @param mixed $child_id
     */
    public function setChildId($child_id)
    {
        $this->child_id = $child_id;
    }

    /**
     * @return mixed
     */
    public function getChildId()
    {
        return $this->child_id;
    }

    /**
     * @param mixed $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent_id
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
    }

    /**
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parent_id;
    }


}