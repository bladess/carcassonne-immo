<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Annonce
 *
 * @ORM\Table(name="ann_annonce")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AnnonceRepository")
 */

class Annonce
{
    /**
     * @var int
     *
     * @ORM\Column(name="ann_oid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ann_titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="ann_description", type="text")
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="ann_nb_pieces", type="integer")
     */
    private $nbPieces;

    /**
     * @var int
     *
     * @ORM\Column(name="ann_prix", type="float")
     */
    private $prix;
    
    /**
     * @var string
     *
     * @ORM\Column(name="ann_photo", type="string", length=255)
     * @Assert\NotBlank(message="Veuilly utiliser un fichier jpg ou png svp.")
     * @Assert\File(mimeTypes={ "image/jpeg","image/jpg", "image/png" })
     */
    private $photo;


    /**
     * @ORM\ManyToOne(targetEntity="TypeAnnonce", inversedBy="annonces")
     * @ORM\JoinColumn(name="tpa_oid", referencedColumnName="tpa_oid")
     */
    private $typeAnnonce;

    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="annonces")
     * @ORM\JoinColumn(name="cli_oid", referencedColumnName="cli_oid")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="Administrateur", inversedBy="annonces")
     * @ORM\JoinColumn(name="adm_oid", referencedColumnName="adm_oid")
     */
    private $administrateur;
    

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
     * Set titre
     *
     * @param string $titre
     *
     * @return Annonce
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     *
     * @return string
     * Get titre
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Annonce
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set nbPieces
     *
     * @param integer $nbPieces
     *
     * @return Annonce
     */
    public function setNbPieces($nbPieces)
    {
        $this->nbPieces = $nbPieces;

        return $this;
    }

    /**
     * Get nbPieces
     *
     * @return int
     */
    public function getNbPieces()
    {
        return $this->nbPieces;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Annonce
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set typeAnnonce
     *
     * @param \AppBundle\Entity\TypeAnnonce $typeAnnonce
     *
     * @return Annonce
     */
    public function setTypeAnnonce(\AppBundle\Entity\TypeAnnonce $typeAnnonce = null)
    {
        $this->typeAnnonce = $typeAnnonce;

        return $this;
    }

    /**
     * Get typeAnnonce
     *
     * @return \AppBundle\Entity\TypeAnnonce
     */
    public function getTypeAnnonce()
    {
        return $this->typeAnnonce;
    }

    /**
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     *
     * @return Annonce
     */
    public function setClient(\AppBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AppBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set administrateur
     *
     * @param \AppBundle\Entity\Administrateur $administrateur
     *
     * @return Annonce
     */
    public function setAdministrateur(\AppBundle\Entity\Administrateur $administrateur = null)
    {
        $this->administrateur = $administrateur;

        return $this;
    }

    /**
     * Get administrateur
     *
     * @return \AppBundle\Entity\Administrateur
     */
    public function getAdministrateur()
    {
        return $this->administrateur;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Annonce
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }
}
