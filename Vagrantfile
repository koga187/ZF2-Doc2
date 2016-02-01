# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = '2'

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = 'bento/ubuntu-14.04'
  config.vm.network "forwarded_port", guest: 80, host: 8085
  config.vm.hostname = "skeleton-zf.local"
  config.vm.synced_folder '.', '/var/www/zf'
  config.vm.provision "shell", path: "ssh/server_script.sh"

  config.vm.provider "virtualbox" do |vb|
    vb.customize ["modifyvm", :id, "--memory", "1024"]
  end

end
