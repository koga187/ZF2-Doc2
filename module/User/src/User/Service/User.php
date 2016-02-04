<?php
/**
 * Created by PhpStorm.
 * User: koga
 * Date: 04/02/16
 * Time: 21:13
 */

namespace User\Service;


use Base\Mail\Mail;
use DoctrineORMModule\Options\EntityManager;
use Zend\Mail\Transport\Smtp;

class User extends AbstractService
{
    protected $transport;
    protected $view;

    /**
     * User constructor.
     * @param EntityManager $em
     * @param Smtp $transport
     * @param $view
     */
    public function __construct(EntityManager $em, Smtp $transport, $view)
    {
        parent::__construct($em);
        $this->entity = 'User\Entity\User';
        $this->transport = $transport;
        $this->view = $view;
    }

    public function insert(array $data)
    {
        $entity = parent::insert($data);

        $dataEmail = array('nome' => $data['nome'], 'activationKey'=> $entity->getActivationKey());

        if($entity) {
            $mail = new Mail($this->transport, $this->view, 'add-user');
            $mail->setSubject('Confirmação de cadastro')
                ->setTo($data['email'])
                ->setData($dataEmail)
                ->prepare()
                ->send();

            return $entity;
        }
    }
}