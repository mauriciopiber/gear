FROM registry.piber.network/dev-php:v1.0.3 as builder

WORKDIR /var/www/
COPY ./composer.json /var/www/composer.json
COPY ./composer.lock /var/www/composer.lock
RUN composer install --no-dev -o


RUN git clone git@bitbucket.org:mauriciopiber/gear.git && cd gear && git pull origin master
RUN mv /var/www/vendor /var/www/gear/vendor
WORKDIR /var/www/gear
RUN composer install --no-dev -o
RUN rm -R /var/www/gear/.git

#RUN npm run build


FROM registry.piber.network/php:v1.0.3
COPY --from=builder /var/www/gear /var/www/module
COPY ./entrypoint.sh /usr/bin/entrypoint.sh
RUN chmod +x /usr/bin/entrypoint.sh
ENV PHINX_ENVIRONMENT PRODUCTION
ENTRYPOINT ["/usr/bin/entrypoint.sh"***REMOVED***
