#!/bin/bash

# Install DataGrip
sudo snap install -y datagrip --classic

# Install Krita
sudo apt-get install -y krita

# Install Google Chrome
wget https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb
sudo dpkg -i google-chrome-stable_current_amd64.deb
sudo apt-get install -f

# Install WPS Office
wget https://wdl1.pcfg.cache.wpscdn.com/wpsdl/wpsoffice/download/linux/9719/wps-office_11.1.0.9719.XA_amd64.deb
sudo dpkg -i wps-office_11.1.0.9719.XA_amd64.deb
sudo apt-get install -f

# Install additional packages
sudo apt-get install -y network-manager-openconnect-gnome \
flameshot \
telegram-desktop

# POSTMAN
sudo apt-get install snapd
sudo snap install -y postman --edge

# vlc

sudo apt install -y vlc

# Add group docker
sudo groupadd docker
sudo gpasswd -a $USER docker
newgrp docker

# UPdate ports
sudo nano /etc/apache2/ports.conf
#sudo systemctl restart apache2
