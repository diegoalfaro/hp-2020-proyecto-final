#!/bin/bash

resolve_composer_dependencies() {
    if [[ ! -d /app/vendor ]]; then
        composer install
        echo "Dependencies installed"
    elif [[ "${SKIP_COMPOSER_UPDATE:-false}" != "true" ]]; then
        composer update
        echo "Dependencies updated"
    fi
}

setup_db() {
    echo "Configuring the database"
    php artisan migrate --force
}

resolve_composer_dependencies
setup_db

exec tini -- "$@"