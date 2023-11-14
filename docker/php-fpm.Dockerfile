FROM php:8.1-fpm

RUN apt-get update && docker-php-ext-install pdo pdo_mysql

# Install cron
RUN apt-get update && apt-get -y install zip unzip runit cron

COPY ./../ /var/www/patreon

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www/patreon

RUN chown -R www-data:www-data /var/www/patreon

RUN composer install --ignore-platform-reqs;

RUN echo "* * * * * cd /var/www/patreon && /usr/local/bin/php artisan app:release-contents >> /var/log/cron.log 2>&1" > /etc/cron.d/laravel-scheduler

# Give execution permission to the cron job
RUN chmod 0644 /etc/cron.d/laravel-scheduler

# Apply cron job
RUN crontab /etc/cron.d/laravel-scheduler

# Create runit service directories
RUN mkdir -p /etc/sv/php-fpm /etc/sv/cron

# Copy runit service scripts
COPY /docker/sv/php-fpm /etc/sv/php-fpm/run
COPY /docker/sv/cron /etc/sv/cron/run

# Make the run scripts executable
RUN chmod +x /etc/sv/php-fpm/run /etc/sv/cron/run

# Set up the runit service directories
RUN ln -s /etc/sv/php-fpm /etc/service/php-fpm
RUN ln -s /etc/sv/cron /etc/service/cron

CMD ["runsvdir", "/etc/service"]

