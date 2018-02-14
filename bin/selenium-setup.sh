#!/usr/bin/env bash
cd /tmp
wget -O joomla_3-8-5-stable-full_package.zip https://downloads.joomla.org/cms/joomla3/3-8-5/Joomla_3-8-5-Stable-Full_Package.zip?format=zip
git clone https://github.com/andrewscaya/mod_simpleemailform
cd mod_simpleemailform
git fetch --all
git checkout stable
cd /tmp
mkdir joomla
cd joomla
unzip ../joomla_3-8-5-stable-full_package.zip
mysql -uroot -e "CREATE DATABASE joomlatest;"
(php -S localhost:8181 > /dev/null 2>&1) &
exit 0