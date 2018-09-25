<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 15/02/2017
 * Time: 19:29
 */

namespace Gstay\hotelBundle\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class reservationHotel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="promoHotel")
     * @ORM\JoinColumn(name="id_promo", referencedColumnName="id")
     */
    private $idpromo ;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $id_user ;
    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $checkin;
    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $checkout;
    /**
     * @ORM\Column(type="string",length=500,nullable=true)
     */
    private $keygen;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $nbticket;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $payement;
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdpromo()
    {
        return $this->idpromo;
    }

    /**
     * @param mixed $idpromo
     */
    public function setIdpromo($idpromo)
    {
        $this->idpromo = $idpromo;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getNbticket()
    {
        return $this->nbticket;
    }

    /**
     * @param mixed $nbticket
     */
    public function setNbticket($nbticket)
    {
        $this->nbticket = $nbticket;
    }
    /**
     *  @ORM\PrePersist
     */
    public function doStuffOnPrePersist()
    {
        $this->createdAt = date('Y-m-d H:i:s');
    }

    /**
     * @return mixed
     */
    public function getCheckin()
    {
        return $this->checkin;
    }

    /**
     * @param mixed $checkin
     */
    public function setCheckin($checkin)
    {
        $this->checkin = $checkin;
    }

    /**
     * @return mixed
     */
    public function getCheckout()
    {
        return $this->checkout;
    }

    /**
     * @param mixed $checkout
     */
    public function setCheckout($checkout)
    {
        $this->checkout = $checkout;
    }

    /**
     * @return mixed
     */
    public function getKeygen()
    {
        return $this->keygen;
    }

    /**
     * @param mixed $keygen
     */
    public function setKeygen($keygen)
    {
        $this->keygen = $keygen;
    }

    /**
     * @return mixed
     */
    public function getPayement()
    {
        return $this->payement;
    }

    /**
     * @param mixed $payement
     */
    public function setPayement($payement)
    {
        $this->payement = $payement;
    }

}