<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 08/02/2017
 * Time: 17:53
 */

namespace Gstay\hotelBundle\Entity;

use Gstay\hotelBundle\Entity\Hotel;
use Doctrine\ORM\EntityRepository;

class promoHotelRepository extends EntityRepository
{

    public function findHotelName()
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT H FROM GstayhotelBundle:Hotel H WHERE H.id_user=( SELECT P.id_hotel FROM GstayhotelBundle:promoHotel P)")
            ;
        return $query->getResult();
    }
}