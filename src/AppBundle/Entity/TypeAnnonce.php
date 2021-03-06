<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TypeAnnonce
 *
 * @ORM\Table(name="tpa_type_annonce")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TypeAnnonceRepository")
 */
class TypeAnnonce
{
    /**
     * @var int
     *
     * @ORM\Column(name="tpa_oid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tpa_intitule", type="string", length=255)
     */
    private $intitule;

    /**
     * @ORM\OneToMany(targetEntity="Annonce", mappedBy="typeAnnonce")
     */
    private $annonces;

    public function __construct()
    {
        $this->annonces = new ArrayCollection();
    }
    public function __toString(){
        return $this->getIntitule();
    }
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
     * Set intitule
     *
     * @param string $intitule
     *
     * @return TypeAnnonce
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Add annonce
     *
     * @param \AppBundle\Entity\Annonce $annonce
     *
     * @return TypeAnnonce
     */
    public function addAnnonce(\AppBundle\Entity\Annonce $annonce)
    {
        $this->annonces[] = $annonce;

        return $this;
    }

    /**
     * Remove annonce
     *
     * @param \AppBundle\Entity\Annonce $annonce
     */
    public function removeAnnonce(\AppBundle\Entity\Annonce $annonce)
    {
        $this->annonces->removeElement($annonce);
    }

    /**
     * Get annonces
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnnonces()
    {
        return $this->annonces;
    }
}
