<?php

// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255,nullable=true)
     * @Assert\NotBlank(message="Le champ nom ne peut être vide ! .")

     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenoms", type="string", length=255,nullable=true)
     * @Assert\NotBlank(message="Le champ prenom ne peut être vide ! .")

     * 
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255,nullable=true)
     * @Assert\NotBlank(message="Le champ titre ne peut être vide ! .")

     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=1,nullable=true)
     * @Assert\NotBlank(message="Le champ sexe ne peut être vide ! .")

     */
    private $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="integer")
     * @Assert\NotBlank(message="Le champ telephone ne peut être vide ! .")

     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="text",nullable=true)
     * @Assert\Image(
     *     minWidth = 200,
     *     maxWidth = 1000,
     *     minHeight = 200,
     *     maxHeight = 1000
     * )
     */
    private $avatar;



    /**
     * @ORM\ManyToMany(targetEntity="Publication",mappedBy="user")
     */
    private $publications;

    /**
     * @ORM\ManyToMany(targetEntity="entite", inversedBy="users", cascade={"remove","persist"})
     */
    private $entites;

   


    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return User
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return User
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set telephone
     *
     * @param integer $telephone
     *
     * @return User
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return integer
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     *
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Add publication
     *
     * @param \AppBundle\Entity\Publication $publication
     *
     * @return User
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

    /**
     * Add entite
     *
     * @param \AppBundle\Entity\entite $entite
     *
     * @return User
     */
    public function addEntite(\AppBundle\Entity\entite $entite)
    {
        $this->entites[] = $entite;

        return $this;
    }

    /**
     * Remove entite
     *
     * @param \AppBundle\Entity\entite $entite
     */
    public function removeEntite(\AppBundle\Entity\entite $entite)
    {
        $this->entites->removeElement($entite);
    }

    /**
     * Get entites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntites()
    {
        return $this->entites;
    }
}
