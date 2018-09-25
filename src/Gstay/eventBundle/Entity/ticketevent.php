<?php
/**
 * Created by PhpStorm.
 * User: HD_EXECUTION
 * Date: 15/02/2017
 * Time: 16:54
 */

namespace Gstay\eventBundle\Entity;
use DateTime;
use Doctrine\ORM\Mapping as ORM ;

/**
 * @ORM\Entity
 * @ORM\Table(name="ticketevent")
 */
class ticketevent
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
 private  $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="ticketevent")
     * @ORM\JoinColumn(name="iduser", referencedColumnName="id")
     */
    private $iduser ;

    /**
     * @ORM\ManyToOne(targetEntity="evenement")
     * @ORM\JoinColumn(name="idevent", referencedColumnName="id")
     */
    private $idevent;
    /**
     * @ORM\ManyToOne(targetEntity="tour")
     * @ORM\JoinColumn(name="idtour", referencedColumnName="id")
     */
private $idtour;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $nbticket;


    /**
     * @ORM\Column(type="string",length=255 , nullable=true)
     */
    private $refticket ;

    /**
     * @ORM\Column(type="datetime" )
     */
    private $date  ;

    /**
     * ticketevent constructor.
     * @param $date
     */
    public function __construct()
    {
        $this->date = new \DateTime('now');
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
    public function getRefticket()
    {
        return $this->refticket;
    }

    /**
     * @param mixed $refticket
     */
    public function setRefticket($refticket)
    {
        $this->refticket = $refticket;
    }



    /**
     * @return mixed
     */
    public function getIdevent()
    {
        return $this->idevent;
    }

    /**
     * @param mixed $idevent
     */
    public function setIdevent($idevent)
    {
        $this->idevent = $idevent;
    }

    /**
     * @return mixed
     */
    public function getIdtour()
    {
        return $this->idtour;
    }

    /**
     * @param mixed $idtour
     */
    public function setIdtour($idtour)
    {
        $this->idtour = $idtour;
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
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * @param mixed $iduser
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
    }




}