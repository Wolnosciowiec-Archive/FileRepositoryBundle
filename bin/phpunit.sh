#!/bin/bash
cd "$( dirname "${BASH_SOURCE[0]}" )"
cd ..
BASE_DIR=$(pwd)

if [[ ! -d /tmp/wolnosciowiec-image-repository ]]; then
    git clone https://github.com/Wolnosciowiec/image-repository /tmp/wolnosciowiec-image-repository
fi

# run test repository server
cd /tmp/wolnosciowiec-image-repository
composer install --dev > /dev/null 2>&1
composer dump-autoload -o > /dev/null 2>&1
cd ./web
php -S 0.0.0.0:8005 ./index.php > /dev/null 2>&1 &
PID=$!
cd $BASE_DIR

composer dump-autoload -o > /dev/null 2>&1
./vendor/bin/phpunit "$@"

kill -9 $PID
