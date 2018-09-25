<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 08/02/2017
 * Time: 18:19
 */

namespace Gstay\hotelBundle\Entity;


use Doctrine\ORM\EntityRepository;

class HotelRepository extends EntityRepository
{
    public function findHotelName($x)
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT H.name FROM GstayhotelBundle:Hotel H WHERE H.id_user=:id_user")
            ->setParameter('id_user',$x);
        return $query->getResult();
    }
}