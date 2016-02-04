<?php

namespace User\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\Tests\Common\Annotations\Ticket\Doctrine\ORM\Mapping\Entity;
use Zend\Stdlib\Hydrator;

abstract class AbstractService
{
    /**
     * @var EntityManager
     */
     protected $em;
    /**
     * @var Entity
     */
     protected $entity;

    /**
     * AbstractService constructor.
     * @param EntityManager $em
     */
     public function __construct(EntityManager $em)
     {
         $this->em = $em;
     }

    /**
     * @param array $data
     * @return mixed
     */
     public function insert(array $data)
     {
         $entity = new $this->entity($data);

         $this->em->persist($entity);
         $this->em->flush();

         return $entity;
     }

    /**
     * @param array $data
     * @return bool|\Doctrine\Common\Proxy\Proxy|null|object
     * @throws \Doctrine\ORM\ORMException
     */
     public function update(array $data)
     {
         $entity = $this->em->getReference($this->entity, $data['id']);
         (new Hydrator\ClassMethods())->hydrate($data, $entity);

         $this->em->persist($entity);
         $this->em->flush();

         return $entity;
     }

    /**
     * @param $id
     * @return mixed
     * @throws \Doctrine\ORM\ORMException
     */
     public function delete($id)
     {
         $entity = $this->em->getReference($this->entity, $id);

         if($entity) {
             $this->em->remove($entity);
             $this->em->flush();

             return $id;
         }
     }
}