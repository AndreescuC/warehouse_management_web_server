#!/usr/bin/env bash
docker-php-entrypoint && php /var/www/html/bin/console worker:start