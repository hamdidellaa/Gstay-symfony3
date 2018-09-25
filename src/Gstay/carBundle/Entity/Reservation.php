<?php
/**
 * Created by PhpStorm.
 * User: Zarkouna
 * Date: 19/02/2017
 * Time: 18:56
 */

namespace Gstay\carBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Reservation
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id ;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $id_user ;

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
    public function getIdCabine()
    {
        return $this->id_cabine;
    }

    /**
     * @param mixed $id_cabine
     */
    public function setIdCabine($id_cabine)
    {
        $this->id_cabine = $id_cabine;
    }

    /**
     * @return mixed
     */
    public function getNbrCabine()
    {
        return $this->nbr_cabine;
    }

    /**
     * @param mixed $nbr_cabine
     */
    public function setNbrCabine($nbr_cabine)
    {
        $this->nbr_cabine = $nbr_cabine;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }
    /**
     * @ORM\ManyToOne(targetEntity="Cabine",inversedBy="Reservation")
     * @ORM\JoinColumn(name="id_cabine", referencedColumnName="id")
     */
    public $id_cabine;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $nbr_cabine ;
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $keyy;

    /**
     * @return mixed
     */
    public function getKeyy()
    {
        return $this->keyy;
    }

    /**
     * @param mixed $keyy
     */
    public function setKeyy($keyy)
    {
        $this->keyy = $keyy;
    }
}