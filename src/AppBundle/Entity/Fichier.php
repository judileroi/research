<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fichier
 *
 * @ORM\Table(name="fichier")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FichierRepository")
 */
class Fichier
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
     * @ORM\Column(name="url_fichier", type="string", length=255)
     */
    private $urlFichier;


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
     * Set urlFichier
     *
     * @param string $urlFichier
     *
     * @return Fichier
     */
    public function setUrlFichier($urlFichier)
    {
        $this->urlFichier = $urlFichier;

        return $this;
    }

    /**
     * Get urlFichier
     *
     * @return string
     */
    public function getUrlFichier()
    {
        return $this->urlFichier;
    }
}
