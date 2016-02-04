<?php

/**
 * Created by PhpStorm.
 * User: koga
 * Date: 04/02/16
 * Time: 20:41
 */

namespace Base\Mail;

use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mime\Message;
use Zend\Mime\Part;
use Zend\View\Model\ViewModel;

class Mail
{
    /**
     * @var SmtpTransport
     */
    protected $transport;
    protected $view;
    protected $body;
    protected $message;
    protected $subject;
    protected $to;
    protected $data;
    protected $page;

    public function __construct(SmtpTransport $transport, $view, $page)
    {
        $this->transport = $transport;
        $this->view = $view;
        $this->page = $page;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function renderView($page, array $data)
    {
        $model = new ViewModel;
        $model->setTemplate("mailer/{$page}.phtml");
        $model->setOption('has_parent', true);
        $model->setVariables($data);

        return $this->view->render($model);
    }

    public function prepare()
    {
        $html = new Part($this->renderView($this->page, $this->data));
        $html->type = 'text/html';

        $body = new Message(array($html));
        $this->body = $body;

        $config = $this->transport->getOptions()->toArray();

        $this->message = new \Zend\Mail\Message();
        $this->message->addFrom($config['connection_config']['from'])
            ->addTo($this->to)
            ->setSubject($this->subject)
            ->setBody($this->body);

        return $this;
    }

    public function send()
    {
        $this->transport->send($this->message);
    }
}