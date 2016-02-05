<?php

namespace User\Form;

use Zend\InputFilter\InputFilter;

class UserFilter extends InputFilter
{
    public function __construct()
    {
        // $this->add(array(
        //     'name' => 'nome',
        //     'required' => true,
        //     'filters' => array(
        //         array('name' => 'StripTags'),
        //         array('name' => 'Stringtrim'),
        //     ),
        //     'validators' => array(
        //         array('name'=>'NotEmpty','options'=>array('messages'=>array('isEmpty'=>'Nao pode estar em branco')))
        //     )
        // ));
        $this->add(array(
            'name' =>'nome',
            'required' => true,
            'filters' => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim')
            ),
            'validator' => array(
                array('name' => 'NotEmpty',
                    'options'=> array(
                        'message' => array(
                            'isEmpty' => 'Não pode ficar em branco'
                        )
                    )
                )
            )
        ));

        $this->add(array(
            'name' =>'password',
            'required' => true,
            'filters' => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim')
            ),
            'validator' => array(
                array('name' => 'NotEmpty',
                    'options'=> array(
                        'message' => array(
                            'isEmpty' => 'Não pode ficar em branco'
                        )
                    )
                )
            )
        ));

        $this->add(array(
            'name' =>'confirmation',
            'required' => true,
            'filters' => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim')
            ),
            'validator' => array(
                array(
                    'name' => 'NotEmpty',
                    'options'=> array(
                        'message' => array(
                            'isEmpty' => 'Não pode ficar em branco'
                        )
                    ),
                    'name' => 'Identical', 'options'=>array('token'=>'password')
                )
            )
        ));
    }
}
