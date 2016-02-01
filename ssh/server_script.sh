#!/bin/sh

DOCUMENT_ROOT_ZEND="/var/www/zf/public";

sudo apt-get update;
echo "############ Instalando apache ############";
sudo apt-get install -y apache2;
echo "############ Instalando git ############";
sudo apt-get install -y git;
echo "############ Instalando curl ############";
sudo apt-get install -y curl;
echo "############ Instalando php-cli ############";
sudo apt-get install -y php5-cli;
echo "############ Instalando php ############";
sudo apt-get install -y php5;
echo "############ Instalando php-intl php5-mysql############";
sudo apt-get install -y php5-intl php5-mysql;
echo "############ Instalando libapache2-mod-php5 ############";
sudo apt-get install -y libapache2-mod-php5;

echo "############ Criando VirtualHost Apache ############"
echo "
<VirtualHost *:80>
    ServerName skeleton-zf.local
    DocumentRoot $DOCUMENT_ROOT_ZEND
    <Directory $DOCUMENT_ROOT_ZEND>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
" > /etc/apache2/sites-available/skeleton-zf.conf;

echo "############ Habilitando Rewrite Mode ############"
a2enmod rewrite;
echo "############ Desabiliando VirtualHost padrão ############"
a2dissite 000-default;
echo "############ Habilitando VirtualHost do projeto ############"
a2ensite skeleton-zf;
echo "############ Reiniciando servidor Apache ############"
service apache2 restart;
echo "############ Entra no diretório do projeto ############"
cd /var/www/zf;
echo "############ Baixa o composer utilizando o Curl ############"
curl -Ss https://getcomposer.org/installer | php;
sudo mv composer.phar /usr/bin/composer;
echo "############ Executa o composer do projeto ############"
php composer.phar install --no-progress;
echo "############ Instalando Mysql-Server ############"
export DEBIAN_FRONTEND=noninteractive;
sudo -E apt-get -q -y install mysql-server;
sudo service mysql restart;
echo "############ Trocando a senha do Mysql ############"
sudo mysqladmin -uroot password root
echo "############ Criando banco do projeto ############"
mysql -uroot -proot;
CREATE DATABASE zf2_base DEFAULT CHARACTER SET utf8;
exit;
echo "############ Doctrine ORM annotations para importação do banco ############"
echo "############ Doctrine ORM data Fixture para importar dados de teste ############"
./vendor/bin/doctrine-module orm:validate-schema;
./vendor/bin/doctrine-module orm:schema-tool:create;



echo "** [ZEND] http://zf2doc.local:8085 **";
