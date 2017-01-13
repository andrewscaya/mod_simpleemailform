#!/usr/bin/env bash
cd /tmp
wget https://downloads.joomla.org/cms/joomla3/3-6-4/joomla_3-6-4-stable-full_package-zip?format=zip
mv joomla_3-6-4-stable-full_package-zip\?format\=zip joomla_3-6-4-stable-full_package.zip
git clone https://github.com/andrewscaya/mod_simpleemailform
cd mod_simpleemailform
git fetch --all
git checkout 2.0-dev
cd /tmp
wget http://selenium-release.storage.googleapis.com/2.53/selenium-server-standalone-2.53.1.jar
java -Xms40m -Xmx256m -jar /tmp/selenium-server-standalone-2.53.1.jar > /dev/null 2>&1 &
mkdir joomla
cd joomla
unzip ../joomla_3-6-4-stable-full_package.zip
(php -S localhost:8181 > /dev/null 2>&1) &