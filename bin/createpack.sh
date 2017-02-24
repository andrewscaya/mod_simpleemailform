#!/bin/bash
if [ -z "$1" ]
then
    echo "*** Please add the version number ***"
    echo "USAGE: createpack.sh versionnumber"
    exit 1
fi
DIR="$( dirname "$( readlink -f "$0" )" )"
BASENAME="$( basename "$DIR" )"
if [ "$DIR" != "$PWD" ]
then
    cd $DIR
fi
rm composer.json composer.phar phpcs.xml phpunit.xml.dist README.md .travis.yml .gitignore createpack.sh
rm -rf .git/
rm -rf test/
cd ..
tar -czvf mod_simpleemailform_"$1".tar.gz "$BASENAME"
echo "OUTPUT FILE: "$PWD"/mod_simpleemailform_"$1".tar.gz"
exit 0
