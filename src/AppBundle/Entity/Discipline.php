<?php

namespace AppBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * Discipline
 *
 * @ORM\Table(name="discipline")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DisciplineRepository")
 */
class Discipline {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=255)
     * @Assert\NotBlank(message="Le champ designation ne peut être vide ! .")
     */
    private $designation;

    /**
     * @ORM\OneToMany(targetEntity="Discipline",mappedBy="parent", cascade={"remove","persist"})
     */
    private $enfants;

    /**
     * @ORM\ManyToOne(targetEntity="Discipline",inversedBy="enfants")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Publication",mappedBy="discipline", cascade={"remove","persist"})
     */
    private $publications;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->enfants = new \Doctrine\Common\Collections\ArrayCollection();
        $this->publications = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set designation
     *
     * @param string $designation
     *
     * @return Discipline
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Add enfant
     *
     * @param \AppBundle\Entity\Discipline $enfant
     *
     * @return Discipline
     */
    public function addEnfant(\AppBundle\Entity\Discipline $enfant)
    {
        $this->enfants[] = $enfant;

        return $this;
    }

    /**
     * Remove enfant
     *
     * @param \AppBundle\Entity\Discipline $enfant
     */
    public function removeEnfant(\AppBundle\Entity\Discipline $enfant)
    {
        $this->enfants->removeElement($enfant);
    }

    /**
     * Get enfants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEnfants()
    {
        return $this->enfants;
    }

    /**
     * Set parent
     *
     * @param \AppBundle\Entity\Discipline $parent
     *
     * @return Discipline
     */
    public function setParent(\AppBundle\Entity\Discipline $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \AppBundle\Entity\Discipline
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add publication
     *
     * @param \AppBundle\Entity\Publication $publication
     *
     * @return Discipline
     */
    public function addPublication(\AppBundle\Entity\Publication $publication)
    {
        $this->publications[] = $publication;

        return $this;
    }

    /**
     * Remove publication
     *
     * @param \AppBundle\Entity\Publication $publication
     */
    public function removePublication(\AppBundle\Entity\Publication $publication)
    {
        $this->publications->removeElement($publication);
    }

    /**
     * Get publications
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPublications()
    {
        return $this->publications;
    }
    
    public function __toString() {
        return $this->designation;
    }
}
