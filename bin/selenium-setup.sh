#!/usr/bin/env bash
cd /tmp
#wget http://selenium-release.storage.googleapis.com/2.53/selenium-server-standalone-2.53.1.jar
#java -Xms40m -Xmx256m -jar /tmp/selenium-server-standalone-2.53.1.jar > /dev/null 2>&1 &
wget -O joomla_3-8-5-stable-full_package.zip https://downloads.joomla.org/cms/joomla3/3-8-5/Joomla_3-8-5-Stable-Full_Package.zip?format=zip
wget -O mod_simpleemailform-latest.tar.gz https://codeload.github.com/andrewscaya/mod_simpleemailform/tar.gz/latest
mkdir joomla
cd joomla
unzip ../joomla_3-8-5-stable-full_package.zip
mysql -uroot -e "CREATE DATABASE joomlatest;"
(php -S localhost:8181 > /dev/null 2>&1) &
exit 0