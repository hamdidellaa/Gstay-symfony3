<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 02/02/2017
 * Time: 23:18
 */

namespace Gstay\hotelBundle\Entity;
use Appbundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Gstay\hotelBundle\Entity\promoHotelRepository;
/**
 * @ORM\Entity(repositoryClass="Gstay\hotelBundle\Entity\promoHotelRepository")
 */
class promoHotel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="Hotel")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $id_hotel ;
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $name;
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $description;
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $youtube;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $pourcentage;
    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $date_begin;
    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $date_end;
    /**
     * @ORM\ManyToOne(targetEntity="Gstay\hotelBundle\Entity\room", )
     * @ORM\JoinColumn(name="roomConcerned", referencedColumnName="id")
     */
    private $roomConcerned;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $maxplace;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $status;

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }


    /**
     * @return mixed
     */
    public function getMaxplace()
    {
        return $this->maxplace;
    }

    /**
     * @param mixed $maxplace
     */
    public function setMaxplace($maxplace)
    {
        $this->maxplace = $maxplace;
    }

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
    public function getIdHotel()
    {
        return $this->id_hotel;
    }

    /**
     * @param mixed $id_hotel
     */
    public function setIdHotel($id_hotel)
    {
        $this->id_hotel = $id_hotel;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getPourcentage()
    {
        return $this->pourcentage;
    }

    /**
     * @param mixed $pourcentage
     */
    public function setPourcentage($pourcentage)
    {
        $this->pourcentage = $pourcentage;
    }

    /**
     * @return mixed
     */
    public function getDateBegin()
    {
        return $this->date_begin;
    }

    /**
     * @param mixed $date_begin
     */
    public function setDateBegin($date_begin)
    {
        $this->date_begin = $date_begin;
    }

    /**
     * @return mixed
     */
    public function getDateEnd()
    {
        return $this->date_end;
    }

    /**
     * @param mixed $date_end
     */
    public function setDateEnd($date_end)
    {
        $this->date_end = $date_end;
    }

    /**
     * @return mixed
     */
    public function getRoomConcerned()
    {
        return $this->roomConcerned;
    }

    /**
     * @param mixed $roomConcerned
     */
    public function setRoomConcerned($roomConcerned)
    {
        $this->roomConcerned = $roomConcerned;
    }

    /**
     * @return mixed
     */
    public function getYoutube()
    {
        return $this->youtube;
    }

    /**
     * @param mixed $youtube
     */
    public function setYoutube($youtube)
    {
        $this->youtube = $youtube;
    }



}