<?php


namespace User\Form;

use Zend\Form\Form;

class User extends Form
{
    public function __construct($name = null, array $options = array())
    {
        parent::__construct('user', $options);

        $this->setInputFilter(new UserFilter);

        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);

        $nome = new \Zend\Form\Element\Text('nome');
        $nome->setLabel('Nome: ')
            ->setAttribute('placeholder', 'Entre com o nome');
        $this->add($nome);

        $email = new \Zend\Form\Element\Text('email');
        $email->setLabel('Email: ')
            ->setAttribute('placeholder', 'Entre com o email');
        $this->add($email);

        $password = new \Zend\Form\Element\Password('password');
        $password->setLabel('Senha: ')
            ->setAttribute('placeholder', 'Entre com a senha');
        $this->add($password);

        $confirmation = new \Zend\Form\Element\Password('confirmation');
        $confirmation->setLabel('Redigite a senha: ')
            ->setAttribute('placeholder', 'Entre com a senha');
        $this->add($confirmation);

        $submit = new \Zend\Form\Element\Submit('submit');
        $submit->setValue('Salvar')
            ->setName('Salvar')
            ->setAttribute('class', 'btn-success');
        $this->add($submit);

        //Garantindo que o usuário esta  vondo da página anterior com Cross site request forgery
        $csrf = new \Zend\Form\Element\Csrf('security');
        $this->add($csrf);
    }
}
