<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Auteurs
 *
 * @ORM\Table(name="auteurs")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AuteursRepository")
 */
class Auteurs
{
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenoms", type="string", length=255)
     */
    private $prenoms;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="affiliation", type="string", length=255)
     */
    private $affiliation;

    
    
    /**
     * @ORM\OneToMany(targetEntity="LigneAuteur",mappedBy="auteur", cascade={"remove","persist"})
     */
    private $ligneauteurs;
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Auteurs
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenoms
     *
     * @param string $prenoms
     *
     * @return Auteurs
     */
    public function setPrenoms($prenoms)
    {
        $this->prenoms = $prenoms;

        return $this;
    }

    /**
     * Get prenoms
     *
     * @return string
     */
    public function getPrenoms()
    {
        return $this->prenoms;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Auteurs
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set affiliation
     *
     * @param string $affiliation
     *
     * @return Auteurs
     */
    public function setAffiliation($affiliation)
    {
        $this->affiliation = $affiliation;

        return $this;
    }

    /**
     * Get affiliation
     *
     * @return string
     */
    public function getAffiliation()
    {
        return $this->affiliation;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ligneauteurs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ligneauteur
     *
     * @param \AppBundle\Entity\LigneAuteur $ligneauteur
     *
     * @return Auteurs
     */
    public function addLigneauteur(\AppBundle\Entity\LigneAuteur $ligneauteur)
    {
        $this->ligneauteurs[] = $ligneauteur;

        return $this;
    }

    /**
     * Remove ligneauteur
     *
     * @param \AppBundle\Entity\LigneAuteur $ligneauteur
     */
    public function removeLigneauteur(\AppBundle\Entity\LigneAuteur $ligneauteur)
    {
        $this->ligneauteurs->removeElement($ligneauteur);
    }

    /**
     * Get ligneauteurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLigneauteurs()
    {
        return $this->ligneauteurs;
    }
}
