<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Publication
 *
 * @ORM\Table(name="publication")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublicationRepository")
 * @UniqueEntity("titreFr") // c'est ici que je declare le champs unique
 */
class Publication {

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
     * @ORM\Column(name="titreFr", type="string", length=255,nullable=true,unique=true)
     * @Assert\NotBlank(message="Le champ titre ne peut être vide ! .")

     */
    private $titreFr;

    /**
     * @var string
     *
     * @ORM\Column(name="motCle", type="text", length=255,nullable=true)

     */
    private $motCle;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="resume", type="text",nullable=true)
     */
    private $resume;

    /**
     * @var string
     *
     * @ORM\Column(name="doi", type="string",nullable=true)
     */
    private $doi;

    /**
     * @var string
     *
     * @ORM\Column(name="conference", type="string",nullable=true)
     */
    private $conference;

    /**
     * @var string
     *
     * @ORM\Column(name="lieuConference", type="string",nullable=true)
     */
    private $lieuConference;

    /**
     * @var string
     *
     * @ORM\Column(name="affiliation", type="string",nullable=true)
     */
    private $affiliation;

    /**
     * @var integer
     *
     * @ORM\Column(name="volumeConference", type="integer",nullable=true)
     */
    private $volumeConference;

    /**
     * @var integer
     *
     * @ORM\Column(name="volumeLivre", type="integer",nullable=true)

     */
    private $volumeLivre;

    /**
     * @var string
     *
     * @ORM\Column(name="serieLivre", type="string",nullable=true)

     */
    private $serieLivre;

    /**
     * @var integer
     *
     * @ORM\Column(name="debutPageLivre", type="integer",nullable=true)

     */
    private $debutPageLivre;

    /**
     * @var integer
     *
     * @ORM\Column(name="finPageLivre", type="integer",nullable=true)

     */
    private $finPageLivre;

    /**
     * @var string
     *
     * @ORM\Column(name="publisher", type="string",nullable=true)
     */
    private $publisher;

    /**
     * @var string
     *
     * @ORM\Column(name="editor", type="string",nullable=true)
     */
    private $editor;

    /**
     * @var string
     *
     * @ORM\Column(name="edition", type="string",nullable=true)
     */
    private $edition;

    /**
     * @var integer
     *
     * @ORM\Column(name="montant", type="integer",nullable=true)
     */
    private $montant;

    /**
     * @var string
     *
     * @ORM\Column(name="isbn", type="string",nullable=true)

     */
    private $isbn;

    /**
     * @var string
     *
     * @ORM\Column(name="datePubli", type="string",nullable=true)
     */
    private $datePubli;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text",nullable=true)
     */
    private $commentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="fichier", type="text",nullable=true)
     * @Assert\File(groups={"fichier"},mimeTypes={ "application/pdf" })
     * @Assert\NotBlank(groups={"fichier"},message="Le fichier à joindre  ne peut être vide ! .")
     */
    private $fichier;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="text",nullable=true)
     * 
     */
    private $auteur;

    /**
     * @var string
     *
     * @ORM\Column(name="revue", type="string",nullable=true)
     */
    private $revue;

    /**
     * @var string
     *
     * @ORM\Column(name="revueCategorie", type="string",nullable=true)

     */
    private $revueCategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="revueQualite", type="string",nullable=true)

     */
    private $revueQualite;

    /**
     * @var float
     *
     * @ORM\Column(name="revueValeur", type="float",nullable=true)
     */
    private $revueValeur = 0;
    
    
    /**
     * @ORM\OneToMany(targetEntity="LigneAuteur",mappedBy="publication", cascade={"remove","persist"})
     */
    private $ligneauteurs;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="dureeProjet", type="integer",nullable=true)
     */
    private $dureeProjet = 0;
    
    /**
     * @var string
     *
     * @ORM\Column(name="financeProjet", type="string",nullable=true)
     */
    private $financeProjet ;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string",nullable=true)
     */
    private $type;

    /** Ajouté par Ignace AZONHOUMON 20/07/2017
     * @ORM\ManyToOne(targetEntity="Type")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=true)
     */
    private $typeId;

    /**
     * @ORM\ManyToOne(targetEntity="Discipline",inversedBy="publications")
     * @ORM\JoinColumn(name="discipline_id", referencedColumnName="id", nullable=true)
     */
    private $discipline;

    /**
     * @ORM\ManyToMany(targetEntity="User",inversedBy="publications")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="entite",inversedBy="publications")
     */
    private $entite;

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ligneauteurs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set titreFr
     *
     * @param string $titreFr
     *
     * @return Publication
     */
    public function setTitreFr($titreFr)
    {
        $this->titreFr = $titreFr;

        return $this;
    }

    /**
     * Get titreFr
     *
     * @return string
     */
    public function getTitreFr()
    {
        return $this->titreFr;
    }

    /**
     * Set motCle
     *
     * @param string $motCle
     *
     * @return Publication
     */
    public function setMotCle($motCle)
    {
        $this->motCle = $motCle;

        return $this;
    }

    /**
     * Get motCle
     *
     * @return string
     */
    public function getMotCle()
    {
        return $this->motCle;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Publication
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set resume
     *
     * @param string $resume
     *
     * @return Publication
     */
    public function setResume($resume)
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * Get resume
     *
     * @return string
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * Set doi
     *
     * @param string $doi
     *
     * @return Publication
     */
    public function setDoi($doi)
    {
        $this->doi = $doi;

        return $this;
    }

    /**
     * Get doi
     *
     * @return string
     */
    public function getDoi()
    {
        return $this->doi;
    }

    /**
     * Set conference
     *
     * @param string $conference
     *
     * @return Publication
     */
    public function setConference($conference)
    {
        $this->conference = $conference;

        return $this;
    }

    /**
     * Get conference
     *
     * @return string
     */
    public function getConference()
    {
        return $this->conference;
    }

    /**
     * Set lieuConference
     *
     * @param string $lieuConference
     *
     * @return Publication
     */
    public function setLieuConference($lieuConference)
    {
        $this->lieuConference = $lieuConference;

        return $this;
    }

    /**
     * Get lieuConference
     *
     * @return string
     */
    public function getLieuConference()
    {
        return $this->lieuConference;
    }

    /**
     * Set affiliation
     *
     * @param string $affiliation
     *
     * @return Publication
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
     * Set volumeConference
     *
     * @param integer $volumeConference
     *
     * @return Publication
     */
    public function setVolumeConference($volumeConference)
    {
        $this->volumeConference = $volumeConference;

        return $this;
    }

    /**
     * Get volumeConference
     *
     * @return integer
     */
    public function getVolumeConference()
    {
        return $this->volumeConference;
    }

    /**
     * Set volumeLivre
     *
     * @param integer $volumeLivre
     *
     * @return Publication
     */
    public function setVolumeLivre($volumeLivre)
    {
        $this->volumeLivre = $volumeLivre;

        return $this;
    }

    /**
     * Get volumeLivre
     *
     * @return integer
     */
    public function getVolumeLivre()
    {
        return $this->volumeLivre;
    }

    /**
     * Set serieLivre
     *
     * @param string $serieLivre
     *
     * @return Publication
     */
    public function setSerieLivre($serieLivre)
    {
        $this->serieLivre = $serieLivre;

        return $this;
    }

    /**
     * Get serieLivre
     *
     * @return string
     */
    public function getSerieLivre()
    {
        return $this->serieLivre;
    }

    /**
     * Set debutPageLivre
     *
     * @param integer $debutPageLivre
     *
     * @return Publication
     */
    public function setDebutPageLivre($debutPageLivre)
    {
        $this->debutPageLivre = $debutPageLivre;

        return $this;
    }

    /**
     * Get debutPageLivre
     *
     * @return integer
     */
    public function getDebutPageLivre()
    {
        return $this->debutPageLivre;
    }

    /**
     * Set finPageLivre
     *
     * @param integer $finPageLivre
     *
     * @return Publication
     */
    public function setFinPageLivre($finPageLivre)
    {
        $this->finPageLivre = $finPageLivre;

        return $this;
    }

    /**
     * Get finPageLivre
     *
     * @return integer
     */
    public function getFinPageLivre()
    {
        return $this->finPageLivre;
    }

    /**
     * Set publisher
     *
     * @param string $publisher
     *
     * @return Publication
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * Get publisher
     *
     * @return string
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * Set editor
     *
     * @param string $editor
     *
     * @return Publication
     */
    public function setEditor($editor)
    {
        $this->editor = $editor;

        return $this;
    }

    /**
     * Get editor
     *
     * @return string
     */
    public function getEditor()
    {
        return $this->editor;
    }

    /**
     * Set edition
     *
     * @param string $edition
     *
     * @return Publication
     */
    public function setEdition($edition)
    {
        $this->edition = $edition;

        return $this;
    }

    /**
     * Get edition
     *
     * @return string
     */
    public function getEdition()
    {
        return $this->edition;
    }

    /**
     * Set montant
     *
     * @param integer $montant
     *
     * @return Publication
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return integer
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set isbn
     *
     * @param string $isbn
     *
     * @return Publication
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get isbn
     *
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set datePubli
     *
     * @param string $datePubli
     *
     * @return Publication
     */
    public function setDatePubli($datePubli)
    {
        $this->datePubli = $datePubli;

        return $this;
    }

    /**
     * Get datePubli
     *
     * @return string
     */
    public function getDatePubli()
    {
        return $this->datePubli;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Publication
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set fichier
     *
     * @param string $fichier
     *
     * @return Publication
     */
    public function setFichier($fichier)
    {
        $this->fichier = $fichier;

        return $this;
    }

    /**
     * Get fichier
     *
     * @return string
     */
    public function getFichier()
    {
        return $this->fichier;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     *
     * @return Publication
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set revue
     *
     * @param string $revue
     *
     * @return Publication
     */
    public function setRevue($revue)
    {
        $this->revue = $revue;

        return $this;
    }

    /**
     * Get revue
     *
     * @return string
     */
    public function getRevue()
    {
        return $this->revue;
    }

    /**
     * Set revueCategorie
     *
     * @param string $revueCategorie
     *
     * @return Publication
     */
    public function setRevueCategorie($revueCategorie)
    {
        $this->revueCategorie = $revueCategorie;

        return $this;
    }

    /**
     * Get revueCategorie
     *
     * @return string
     */
    public function getRevueCategorie()
    {
        return $this->revueCategorie;
    }

    /**
     * Set revueQualite
     *
     * @param string $revueQualite
     *
     * @return Publication
     */
    public function setRevueQualite($revueQualite)
    {
        $this->revueQualite = $revueQualite;

        return $this;
    }

    /**
     * Get revueQualite
     *
     * @return string
     */
    public function getRevueQualite()
    {
        return $this->revueQualite;
    }

    /**
     * Set revueValeur
     *
     * @param float $revueValeur
     *
     * @return Publication
     */
    public function setRevueValeur($revueValeur)
    {
        $this->revueValeur = $revueValeur;

        return $this;
    }

    /**
     * Get revueValeur
     *
     * @return float
     */
    public function getRevueValeur()
    {
        return $this->revueValeur;
    }

    /**
     * Set dureeProjet
     *
     * @param integer $dureeProjet
     *
     * @return Publication
     */
    public function setDureeProjet($dureeProjet)
    {
        $this->dureeProjet = $dureeProjet;

        return $this;
    }

    /**
     * Get dureeProjet
     *
     * @return integer
     */
    public function getDureeProjet()
    {
        return $this->dureeProjet;
    }

    /**
     * Set financeProjet
     *
     * @param string $financeProjet
     *
     * @return Publication
     */
    public function setFinanceProjet($financeProjet)
    {
        $this->financeProjet = $financeProjet;

        return $this;
    }

    /**
     * Get financeProjet
     *
     * @return string
     */
    public function getFinanceProjet()
    {
        return $this->financeProjet;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Publication
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * @param mixed $typeId
     * @return Publication
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;
        return $this;
    }


    /**
     * Add ligneauteur
     *
     * @param \AppBundle\Entity\LigneAuteur $ligneauteur
     *
     * @return Publication
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

    /**
     * Set discipline
     *
     * @param \AppBundle\Entity\Discipline $discipline
     *
     * @return Publication
     */
    public function setDiscipline(\AppBundle\Entity\Discipline $discipline = null)
    {
        $this->discipline = $discipline;

        return $this;
    }

    /**
     * Get discipline
     *
     * @return \AppBundle\Entity\Discipline
     */
    public function getDiscipline()
    {
        return $this->discipline;
    }

    /**
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Publication
     */
    public function addUser(\AppBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $user
     */
    public function removeUser(\AppBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set entite
     *
     * @param \AppBundle\Entity\entite $entite
     *
     * @return Publication
     */
    public function setEntite(\AppBundle\Entity\entite $entite = null)
    {
        $this->entite = $entite;

        return $this;
    }

    /**
     * Get entite
     *
     * @return \AppBundle\Entity\entite
     */
    public function getEntite()
    {
        return $this->entite;
    }
}
