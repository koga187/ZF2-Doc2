<?php

return array(
    'doctrine' => array(
       'conection' => array(
           'orm_default' => array(//Nome Conexão
               'driverClass' => 'Doctrine\DBAL\Driver\PDOMysql\Driver',
               'params' => array(
                   'host' => '127.0.0.1',
                   'port' => '3306',
                   'user' => 'root',
                   'password' => 'root',
                   'dbname' => 'zf2_base',
                   'driverOptions' => array(
                       'PDO::MYSQL_ATTR_INIT_COMMAND' => "SET NAMES 'UTF8'"
                   )
               )
           )
       ) 
    )
);
