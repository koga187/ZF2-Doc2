# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = '2'

@script = <<SCRIPT
DOCUMENT_ROOT_ZEND="/var/www/zf/public"
apt-get update
apt-get install -y apache2 git curl php5-cli php5 php5-intl libapache2-mod-php5 mysql-server-5.5
echo "
<VirtualHost *:80>
    ServerName zf.local
    DocumentRoot $DOCUMENT_ROOT_ZEND
    <Directory $DOCUMENT_ROOT_ZEND>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
" > /etc/apache2/sites-available/zf.conf
a2enmod rewrite
a2dissite 000-default
a2ensite zf.conf
service apache2 restart
echo "** [ZEND] Visit http://localhost in your browser for to view the application **"
mysqladmin -uroot password root

SCRIPT

Vagrant.configure(VAGRANTFILE_API_VERSION) do |zf2doc2|
  zf2doc2.vm.box = 'bento/ubuntu-14.04'
  zf2doc2.vm.network :private_network, ip: "192.168.34.20"
  #zf2doc2.vm.network "forwarded_port", guest: 80, host: 8085
  #zf2doc2.vm.network "forwarded_port", guest: 3306, host: 3306
  zf2doc2.vm.hostname = "zf.local"
  zf2doc2.vm.synced_folder '.', '/var/www/zf'
  zf2doc2.vm.provision 'shell', inline: @script

  zf2doc2.vm.provider "virtualbox" do |vb|
    vb.customize ["modifyvm", :id, "--memory", "1024"]
  end

end
