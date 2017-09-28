<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneAuteur
 *
 * @ORM\Table(name="ligne_auteur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LigneAuteurRepository")
 */
class LigneAuteur
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
     * @ORM\Column(name="participation", type="string", length=20, nullable=true)
     */
    private $participation;

    /**
     * @var int
     *
     * @ORM\Column(name="ordre", type="integer", nullable=true)
     */
    private $ordre;

    /**
     * @ORM\ManyToOne(targetEntity="Auteurs",inversedBy="ligneauteurs")
     */
    private $auteur;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Publication",inversedBy="ligneauteurs")
     */
    private $publication;
    


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
     * Set participation
     *
     * @param string $participation
     *
     * @return LigneAuteur
     */
    public function setParticipation($participation)
    {
        $this->participation = $participation;

        return $this;
    }

    /**
     * Get participation
     *
     * @return string
     */
    public function getParticipation()
    {
        return $this->participation;
    }

    /**
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return LigneAuteur
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return integer
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * Set auteur
     *
     * @param \AppBundle\Entity\Auteurs $auteur
     *
     * @return LigneAuteur
     */
    public function setAuteur(\AppBundle\Entity\Auteurs $auteur = null)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return \AppBundle\Entity\Auteurs
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set publication
     *
     * @param \AppBundle\Entity\Publication $publication
     *
     * @return LigneAuteur
     */
    public function setPublication(\AppBundle\Entity\Publication $publication = null)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return \AppBundle\Entity\Publication
     */
    public function getPublication()
    {
        return $this->publication;
    }
}
