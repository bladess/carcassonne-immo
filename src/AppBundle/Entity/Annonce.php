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
     * @var string
     *
     * @ORM\Column(name="ann_photo", type="string", length=255)
     * @Assert\NotBlank(message="Veuilly utiliser un fichier jpg ou png svp.")
     * @Assert\File(mimeTypes={ "application/jpg", "application/png" })
     */
    private $photo;


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
}

