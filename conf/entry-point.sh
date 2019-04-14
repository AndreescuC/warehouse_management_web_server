#!/usr/bin/env bash
php /var/www/html/bin/console worker:start && apache2-foreground