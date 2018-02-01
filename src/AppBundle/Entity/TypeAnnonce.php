<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
}

