#!/bin/bash
cd "$( dirname "${BASH_SOURCE[0]}" )"
cd ..

# run test repository server
cd ./vendor/wolnosciowiec/wolnosciowiec-image-repository/
composer install --dev
composer dump-autoload -o
cd ./web
php -S 0.0.0.0:8005 ./index_dev.php &
cd ../../../../

composer dump-autoload -o
./vendor/bin/phpunit "$@"

killall php