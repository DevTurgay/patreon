FROM nginx

ADD docker/nginx/custom_vhost.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www/patreon

