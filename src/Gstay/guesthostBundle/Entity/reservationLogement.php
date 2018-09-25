<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 16/02/2017
 * Time: 01:51
 */

namespace Gstay\guesthostBundle\Entity;
use Doctrine\ORM\Mapping as ORM ;

/**
 * @ORM\Entity
 */


class reservationLogement
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */

    private $idreservation;


    /**
     * @ORM\ManyToOne(targetEntity="Logement", inversedBy="reservationLogement")
     * @ORM\JoinColumn(name="idreservationlogement", referencedColumnName="idlogement")
     */

    private $idreservationlogement;

    /**
     * @return mixed
     */
    public function getIdguest()
    {
        return $this->idguest;
    }

    /**
     * @param mixed $idguest
     */
    public function setIdguest($idguest)
    {
        $this->idguest = $idguest;
    }

    /**
     * @ORM\ManyToOne(targetEntity="hostguest", inversedBy="reservationLogement")
     * @ORM\JoinColumn(name="idguest", referencedColumnName="id")
     */

    private $idguest;


    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $datedebut;

    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $datefin;

    /**
     *@ORM\Column(type="integer", nullable=true)
     */

    private $nbrchambrereserver;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prixreservation;

    /**
     * @return mixed
     */
    public function getIdreservation()
    {
        return $this->idreservation;
    }

    /**
     * @param mixed $idreservation
     */
    public function setIdreservation($idreservation)
    {
        $this->idreservation = $idreservation;
    }

    /**
     * @return mixed
     */
    public function getIdreservationlogement()
    {
        return $this->idreservationlogement;
    }

    /**
     * @param mixed $idreservationlogement
     */
    public function setIdreservationlogement($idreservationlogement)
    {
        $this->idreservationlogement = $idreservationlogement;
    }

    /**
     * @return mixed
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * @param mixed $datedebut
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;
    }

    /**
     * @return mixed
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * @param mixed $datefin
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;
    }

    /**
     * @return mixed
     */
    public function getNbrchambrereserver()
    {
        return $this->nbrchambrereserver;
    }

    /**
     * @param mixed $nbrchambrereserver
     */
    public function setNbrchambrereserver($nbrchambrereserver)
    {
        $this->nbrchambrereserver = $nbrchambrereserver;
    }

    /**
     * @return mixed
     */
    public function getPrixreservation()
    {
        return $this->prixreservation;
    }

    /**
     * @param mixed $prixreservation
     */
    public function setPrixreservation($prixreservation)
    {
        $this->prixreservation = $prixreservation;
    }






}